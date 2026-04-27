@extends('layouts.guest')
@section('title', $project->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    {{-- Back button --}}
    <div class="mb-8">
        <a href="{{ route('home') }}#projects" class="inline-flex items-center gap-2 text-sm text-[#475569] hover:text-[#1E3A8A] dark:text-slate-400 dark:hover:text-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Projects
        </a>
    </div>

    {{-- Thumbnail --}}
    @if ($project->thumbnail)
        <div class="rounded-xl overflow-hidden mb-8 border border-[#93C5FD] dark:border-slate-800/50 shadow-sm dark:shadow-none">
            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-64 sm:h-80 object-cover cursor-zoom-in">
        </div>
    @endif

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-3">
            <h1 class="text-3xl sm:text-4xl font-bold text-[#1E3A8A] dark:text-white">{{ $project->title }}</h1>
            @if ($project->is_featured)
                <span class="text-amber-500 dark:text-amber-400 text-xl drop-shadow-sm">★</span>
            @endif
        </div>
        @if ($project->short_description)
            <p class="text-lg text-[#475569] dark:text-slate-400">{{ $project->short_description }}</p>
        @endif
    </div>

    {{-- Tech Stack --}}
    @if ($project->tech_stack)
        <div class="flex flex-wrap gap-2 mb-8">
            @foreach ($project->tech_stack as $tech)
                <span class="text-sm px-3 py-1 rounded-lg bg-[#DBEAFE]/80 text-[#2563EB] border border-[#93C5FD]/50 dark:bg-blue-500/10 dark:text-blue-400 dark:border-blue-500/20 font-medium">{{ $tech }}</span>
            @endforeach
        </div>
    @endif

    {{-- Links --}}
    <div class="flex flex-wrap gap-3 mb-8">
        @if ($project->demo_link)
            <a href="{{ $project->demo_link }}" target="_blank"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg bg-gradient-to-r from-blue-500 to-violet-500 text-white text-sm font-medium hover:from-blue-600 hover:to-violet-600 transition shadow-lg shadow-blue-500/25">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Live Demo
            </a>
        @endif
        @if ($project->repo_link)
            <a href="{{ $project->repo_link }}" target="_blank"
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-lg border border-[#93C5FD] text-[#2563EB] hover:border-[#2563EB] hover:text-[#1E3A8A] bg-white/50 dark:bg-transparent dark:border-slate-700 dark:text-slate-300 dark:hover:border-slate-500 dark:hover:text-white transition font-medium backdrop-blur-sm">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                View Source
            </a>
        @endif
    </div>

    {{-- Description --}}
    @if ($project->description)
        <div class="bg-[#EFF6FF]/70 border border-[#BFDBFE] dark:bg-slate-900/50 dark:border-slate-800/50 p-6 rounded-xl shadow-sm dark:shadow-none backdrop-blur-sm">
            <h2 class="text-lg font-semibold text-[#1E3A8A] dark:text-white mb-4">About this project</h2>
            <div class="text-[#475569] dark:text-slate-400 leading-relaxed whitespace-pre-wrap">{{ $project->description }}</div>
        </div>
    @endif
</div>
@endsection
