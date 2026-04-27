<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Activity;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageReceived;

class PageController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $projects = Project::published()->featured()->orderBy('sort_order')->take(4)->get();
        $allProjects = Project::published()->orderBy('sort_order')->get();
        $skills = Skill::orderBy('category')->orderBy('level', 'desc')->get();
        $certificates = Certificate::latest('date')->take(4)->get();
        $experiences = Experience::latest('start_date')->take(4)->get();
        $activities = Activity::latest('date')->take(4)->get();

        return view('guest.home', compact(
            'profile', 'projects', 'allProjects', 'skills',
            'certificates', 'experiences', 'activities'
        ));
    }

    public function projectDetail($slug)
    {
        $project = Project::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $profile = Profile::first();
        return view('guest.project-detail', compact('project', 'profile'));
    }

    public function projectsArchive()
    {
        $profile = Profile::first();
        $allProjects = Project::published()->orderBy('sort_order')->get();
        return view('guest.projects', compact('allProjects', 'profile'));
    }

    public function experiencesArchive()
    {
        $profile = Profile::first();
        $experiences = Experience::latest('start_date')->get();
        return view('guest.experiences', compact('experiences', 'profile'));
    }

    public function certificatesArchive()
    {
        $profile = Profile::first();
        $certificates = Certificate::latest('date')->get();
        return view('guest.certificates', compact('certificates', 'profile'));
    }

    public function activitiesArchive()
    {
        $profile = Profile::first();
        $activities = Activity::latest('date')->get();
        return view('guest.activities', compact('activities', 'profile'));
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'body' => 'required|string|max:5000',
        ]);

        $message = Message::create($validated);

        $profile = Profile::first();
        if ($profile && $profile->email) {
            try {
                Mail::to($profile->email)->send(new ContactMessageReceived($message));
            } catch (\Exception $e) {
                // Log error but don't stop the user experience if mail fails
                \Illuminate\Support\Facades\Log::error('Failed to send contact email: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Message sent successfully! I will get back to you soon.');
    }
}
