@extends('layouts.guest')
@section('title', 'Repository Archives')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    {{-- Back button --}}
    <div class="mb-12">
        <a href="{{ route('home') }}#projects" class="inline-flex items-center gap-2 text-sm text-[#475569] hover:text-[#1E3A8A] dark:text-slate-400 dark:hover:text-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Home
        </a>
    </div>

    {{-- Page Header --}}
    <div class="mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-[#1E3A8A] dark:text-white mb-4 tracking-tight font-heading transition-colors">Repository Archives</h1>
        <p class="text-xl text-[#475569] dark:text-slate-400 font-light">A comprehensive collection of all my published projects and applications.</p>
    </div>

    {{-- Universal Projects Grid (Identical sizing to home components) --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse ($allProjects as $project)
            <a href="{{ route('project.detail', $project->slug) }}" class="group block relative">
                <div class="absolute -inset-2 bg-gradient-to-br from-[#93C5FD] dark:from-[#1E3A8A]/50 to-[#E3F2FD] dark:to-[#06B6D4]/30 rounded-[2.5rem] blur-xl opacity-0 group-hover:opacity-40 dark:group-hover:opacity-100 transition duration-500"></div>
                <div class="relative glass-card bg-[#EFF6FF] dark:bg-[#0B1220] p-2 rounded-[2rem] overflow-hidden flex flex-col h-full border border-[#BFDBFE] dark:border-[#1E293B] shadow-sm group-hover:border-[#93C5FD] dark:group-hover:border-[#1E3A8A] transition-all hover:-translate-y-1">
                    @if ($project->thumbnail)
                        <div class="h-56 overflow-hidden rounded-[1.5rem] relative bg-[#DBEAFE] dark:bg-[#020617]">
                            <div class="absolute inset-0 bg-[#2563EB]/10 dark:bg-[#020617]/50 group-hover:bg-transparent transition-colors z-10"></div>
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover transform group-hover:scale-[1.05] transition-transform duration-700 ease-out">
                        </div>
                    @else
                        <div class="h-56 rounded-[1.5rem] bg-[#DBEAFE] dark:bg-[#0F172A] border border-[#BFDBFE] dark:border-[#1E293B] flex items-center justify-center relative overflow-hidden">
                            <span class="text-[#60A5FA] dark:text-[#475569] font-mono tracking-widest text-sm z-10 font-bold">{{ strtoupper(Str::limit($project->title, 15)) }}</span>
                        </div>
                    @endif
                    
                    <div class="p-6 flex-1 flex flex-col">
                        <div class="flex items-start justify-between gap-4 mb-3">
                            <h3 class="text-xl font-bold text-[#1E3A8A] dark:text-white group-hover:text-[#2563EB] dark:group-hover:text-cyan-400 transition-colors">{{ $project->title }}</h3>
                            @if ($project->is_featured)
                                <span class="w-7 h-7 rounded-full bg-[#DBEAFE] dark:bg-[#1E3A8A]/40 flex items-center justify-center shrink-0 border border-[#93C5FD] dark:border-[#2563EB]/50" title="Featured">
                                    <svg class="w-3.5 h-3.5 text-[#2563EB] dark:text-cyan-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                </span>
                            @endif
                        </div>
                        <p class="text-[#475569] dark:text-slate-400 text-sm leading-relaxed mb-6 flex-1 font-light">{{ Str::limit($project->short_description, 90) }}</p>
                        
                        <div class="flex flex-wrap gap-2 mt-auto">
                            @foreach (($project->tech_stack ?? []) as $tech)
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold bg-[#E3F2FD] dark:bg-[#1E293B] text-[#1D4ED8] dark:text-cyan-300 border border-[#BFDBFE] dark:border-[#0F172A]">{{ $tech }}</span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full py-20 text-center">
                <div class="inline-flex w-16 h-16 rounded-full bg-[#DBEAFE] dark:bg-[#1E293B] items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-[#93C5FD] dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <h3 class="text-xl font-bold text-[#1E3A8A] dark:text-slate-300 mb-2">No Projects Published</h3>
                <p class="text-[#475569] dark:text-slate-400 font-light">Check back later for new updates and repositories.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
