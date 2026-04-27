<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GatewayController extends Controller
{
    /**
     * Show the gateway verification page.
     */
    public function index()
    {
        if (session('recaptcha_verified')) {
            return redirect()->route('home');
        }
        return view('guest.gateway');
    }

    /**
     * Handle the reCAPTCHA submission.
     */
    public function verify(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required'
        ]);

        /** @var \Illuminate\Http\Client\Response $response */
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip(),
        ]);

        $result = $response->json();

        if ($result['success'] ?? false) {
            session(['recaptcha_verified' => true]);
            
            // Clear any lingering errors just in case
            return redirect()->route('home');
        }

        return back()->withErrors(['captcha' => 'Invalid reCAPTCHA validation. Please try again.']);
    }
}
