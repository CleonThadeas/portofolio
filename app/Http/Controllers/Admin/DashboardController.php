<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Message;
use App\Models\Skill;
use App\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'skills' => Skill::count(),
            'certificates' => Certificate::count(),
            'experiences' => Experience::count(),
            'activities' => Activity::count(),
            'messages' => Message::where('is_read', false)->count(),
            'published_projects' => Project::where('is_published', true)->count(),
        ];

        $recentMessages = Message::latest()->take(5)->get();
        $recentProjects = Project::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'recentProjects'));
    }
}
