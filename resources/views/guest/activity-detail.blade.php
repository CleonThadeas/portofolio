@extends('layouts.guest')
@section('title', $activity->title)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    {{-- Back button --}}
    <div class="mb-8">
        <a href="{{ route('activities.archive') }}" class="inline-flex items-center gap-2 text-sm text-[#475569] hover:text-[#1E3A8A] dark:text-slate-400 dark:hover:text-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Activities
        </a>
    </div>

    {{-- Header --}}
    <div class="mb-10 border-b border-[#BFDBFE] dark:border-slate-800/50 pb-8">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-[#1E3A8A] dark:text-white">{{ $activity->title }}</h1>
            @if ($activity->type)
                <span class="inline-flex items-center self-start md:self-auto px-4 py-1.5 rounded-full bg-[#DBEAFE] dark:bg-[#1E3A8A]/40 text-[#1D4ED8] dark:text-[#93C5FD] font-bold text-sm border border-[#93C5FD] dark:border-[#2563EB]/50 whitespace-nowrap">
                    {{ $activity->type }}
                </span>
            @endif
        </div>
        
        <div class="flex items-center gap-2 text-[#64748B] dark:text-[#94A3B8] font-mono font-bold">
            <svg class="w-5 h-5 text-[#3B82F6] dark:text-[#60A5FA]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            {{ $activity->date ? $activity->date->format('F d, Y') : 'Unknown Date' }}
        </div>
    </div>

    {{-- Description --}}
    @if ($activity->description)
        <div class="prose prose-lg dark:prose-invert max-w-none mb-12 text-[#475569] dark:text-slate-300 font-light leading-relaxed whitespace-pre-wrap">
            {{ $activity->description }}
        </div>
    @endif

    {{-- Documentation Gallery --}}
    @if ($activity->documentation && count($activity->documentation) > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-[#1E3A8A] dark:text-white mb-6 font-heading">Documentation Gallery</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($activity->documentation as $doc)
                    <div class="group rounded-2xl overflow-hidden border border-[#BFDBFE] dark:border-slate-800/50 shadow-sm dark:shadow-none bg-[#EFF6FF]/50 dark:bg-slate-900/50 cursor-zoom-in relative">
                        <div class="absolute inset-0 bg-[#1E3A8A]/10 opacity-0 group-hover:opacity-100 transition-opacity z-10 pointer-events-none"></div>
                        <img src="{{ asset('storage/' . $doc) }}" alt="Activity Documentation" class="w-full h-64 object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
