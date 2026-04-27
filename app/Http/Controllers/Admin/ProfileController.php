<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::first();
        return view('admin.profile.edit', compact('profile'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'headline' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'social_github' => 'nullable|url|max:255',
            'social_linkedin' => 'nullable|url|max:255',
            'social_instagram' => 'nullable|url|max:255',
            'social_twitter' => 'nullable|url|max:255',
            'social_website' => 'nullable|url|max:255',
        ]);

        $profile = Profile::first();

        if ($request->hasFile('photo')) {
            if ($profile->photo) {
                Storage::disk('public')->delete($profile->photo);
            }
            $validated['photo'] = $request->file('photo')->store('profiles', 'public');
        }

        $validated['social_links'] = array_filter([
            'github' => $request->social_github,
            'linkedin' => $request->social_linkedin,
            'instagram' => $request->social_instagram,
            'twitter' => $request->social_twitter,
            'website' => $request->social_website,
        ]);

        $profile->update($validated);

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }
}
