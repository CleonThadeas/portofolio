@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
{{-- Stats Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @php
        $cards = [
            ['label' => 'Projects', 'value' => $stats['projects'], 'sub' => $stats['published_projects'] . ' published', 'color' => 'blue', 'route' => 'admin.projects.index'],
            ['label' => 'Skills', 'value' => $stats['skills'], 'sub' => 'total skills', 'color' => 'violet', 'route' => 'admin.skills.index'],
            ['label' => 'Certificates', 'value' => $stats['certificates'], 'sub' => 'earned', 'color' => 'emerald', 'route' => 'admin.certificates.index'],
            ['label' => 'Messages', 'value' => $stats['messages'], 'sub' => 'unread', 'color' => 'amber', 'route' => 'admin.messages.index'],
        ];
    @endphp

    @foreach ($cards as $card)
        <a href="{{ route($card['route']) }}" class="bg-slate-900 rounded-xl border border-slate-800/50 p-5 hover:border-{{ $card['color'] }}-500/30 transition group">
            <p class="text-sm text-slate-400 mb-1">{{ $card['label'] }}</p>
            <p class="text-3xl font-bold text-white">{{ $card['value'] }}</p>
            <p class="text-xs text-slate-500 mt-1">{{ $card['sub'] }}</p>
        </a>
    @endforeach
</div>

{{-- Quick Actions --}}
<div class="mb-8">
    <h2 class="text-lg font-semibold text-white mb-4">Quick Actions</h2>
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600/20 text-blue-400 text-sm hover:bg-blue-600/30 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Project
        </a>
        <a href="{{ route('admin.skills.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-violet-600/20 text-violet-400 text-sm hover:bg-violet-600/30 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Skill
        </a>
        <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-emerald-600/20 text-emerald-400 text-sm hover:bg-emerald-600/30 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Certificate
        </a>
        <a href="{{ route('admin.experiences.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-amber-600/20 text-amber-400 text-sm hover:bg-amber-600/30 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Experience
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Recent Messages --}}
    <div class="bg-slate-900 rounded-xl border border-slate-800/50 p-5">
        <h3 class="text-base font-semibold text-white mb-4">Recent Messages</h3>
        @forelse ($recentMessages as $msg)
            <a href="{{ route('admin.messages.show', $msg) }}" class="flex items-start gap-3 py-3 border-b border-slate-800/50 last:border-0 hover:bg-slate-800/30 -mx-2 px-2 rounded transition">
                <div class="w-8 h-8 rounded-full bg-{{ $msg->is_read ? 'slate' : 'blue' }}-600/20 flex items-center justify-center text-xs font-bold text-{{ $msg->is_read ? 'slate' : 'blue' }}-400 shrink-0 mt-0.5">
                    {{ strtoupper(substr($msg->name, 0, 1)) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ $msg->subject ?: 'No Subject' }}</p>
                    <p class="text-xs text-slate-500">{{ $msg->name }} &middot; {{ $msg->created_at->diffForHumans() }}</p>
                </div>
            </a>
        @empty
            <p class="text-sm text-slate-500">No messages yet.</p>
        @endforelse
    </div>

    {{-- Recent Projects --}}
    <div class="bg-slate-900 rounded-xl border border-slate-800/50 p-5">
        <h3 class="text-base font-semibold text-white mb-4">Recent Projects</h3>
        @forelse ($recentProjects as $project)
            <a href="{{ route('admin.projects.edit', $project) }}" class="flex items-center justify-between py-3 border-b border-slate-800/50 last:border-0 hover:bg-slate-800/30 -mx-2 px-2 rounded transition">
                <div class="min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ $project->title }}</p>
                    <p class="text-xs text-slate-500">{{ $project->created_at->diffForHumans() }}</p>
                </div>
                <span class="text-xs px-2 py-1 rounded-full {{ $project->is_published ? 'bg-emerald-500/10 text-emerald-400' : 'bg-slate-700 text-slate-400' }}">
                    {{ $project->is_published ? 'Published' : 'Draft' }}
                </span>
            </a>
        @empty
            <p class="text-sm text-slate-500">No projects yet.</p>
        @endforelse
    </div>
</div>
@endsection
