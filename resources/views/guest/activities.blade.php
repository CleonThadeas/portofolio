@extends('layouts.guest')
@section('title', 'Activity Archives')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center md:text-left">
    {{-- Back button --}}
    <div class="mb-12">
        <a href="{{ route('home') }}#activities" class="inline-flex items-center gap-2 text-sm text-[#475569] hover:text-[#1E3A8A] dark:text-slate-400 dark:hover:text-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Home
        </a>
    </div>

    {{-- Page Header --}}
    <div class="mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-[#1E3A8A] dark:text-white mb-4 tracking-tight font-heading transition-colors">Activity Archives</h1>
        <p class="text-xl text-[#475569] dark:text-slate-400 font-light">A transparent log of all engaged events and extracurricular activities.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
        @forelse ($activities as $activity)
            <div class="glass-card bg-[#EFF6FF] dark:bg-[#0B1220] p-8 rounded-[2.5rem] hover:shadow-2xl dark:hover:shadow-[0_10px_40px_rgba(0,0,0,0.6)] transition-all duration-500 border border-[#BFDBFE] dark:border-[#1E293B] hover:border-[#60A5FA] dark:hover:border-[#2563EB] group">
                <div class="flex items-start justify-between mb-6 gap-4">
                    <h3 class="text-2xl font-bold text-[#1E3A8A] dark:text-white">{{ $activity->title }}</h3>
                    @if ($activity->type)
                        <span class="text-xs px-4 py-1.5 rounded-full bg-[#DBEAFE] dark:bg-[#1E3A8A]/40 text-[#1D4ED8] dark:text-[#93C5FD] font-bold shrink-0 border border-[#93C5FD] dark:border-[#2563EB]/50 whitespace-nowrap">{{ $activity->type }}</span>
                    @endif
                </div>
                
                <div class="mb-6 text-sm font-mono font-bold text-[#64748B] dark:text-[#94A3B8] flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#3B82F6] dark:text-[#60A5FA]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    {{ $activity->date ? $activity->date->format('M d, Y') : 'Unknown Date' }}
                </div>
                
                @if ($activity->description)
                    <p class="text-[#475569] dark:text-slate-300 font-light leading-relaxed mb-6">{{ $activity->description }}</p>
                @endif
                
                @if ($activity->documentation && count($activity->documentation))
                    <div class="flex gap-4 overflow-x-auto pb-4 snap-x mt-6 custom-scrollbar">
                        @foreach ($activity->documentation as $doc)
                            <div class="h-32 w-48 shrink-0 rounded-[1.5rem] overflow-hidden border-2 border-[#BFDBFE] dark:border-[#1E293B] group-hover:border-[#93C5FD] snap-start bg-[#DBEAFE] dark:bg-[#0F172A] shadow-md relative">
                                <div class="absolute inset-0 bg-[#1E3A8A]/10 opacity-0 group-hover:opacity-100 transition-opacity z-10 pointer-events-none"></div>
                                <img src="{{ asset('storage/' . $doc) }}" alt="Documentation" class="w-full h-full object-cover cursor-zoom-in hover:scale-110 transition-transform duration-700">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <p class="text-[#475569] dark:text-slate-400 font-light">No activities published yet.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
