@extends('layouts.guest')
@section('title', 'Certificate Archives')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center md:text-left">
    {{-- Back button --}}
    <div class="mb-12">
        <a href="{{ route('home') }}#certificates" class="inline-flex items-center gap-2 text-sm text-[#475569] hover:text-[#1E3A8A] dark:text-slate-400 dark:hover:text-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Home
        </a>
    </div>

    {{-- Page Header --}}
    <div class="mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-[#1E3A8A] dark:text-white mb-4 tracking-tight font-heading transition-colors">Certificate Archives</h1>
        <p class="text-xl text-[#475569] dark:text-slate-400 font-light">Comprehensive list of all my verified credentials and awards.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 text-left">
        @forelse ($certificates as $cert)
            <div class="glass-card bg-[#EFF6FF] dark:bg-[#1E293B] p-6 rounded-3xl hover:-translate-y-2 transition-all duration-500 group border border-[#BFDBFE] dark:border-[#0F172A] hover:border-[#60A5FA] dark:hover:border-[#2563EB] shadow-lg dark:shadow-none hover:shadow-2xl">
                <div class="w-14 h-14 rounded-2xl bg-[#DBEAFE] dark:bg-[#0B1220] border border-[#93C5FD] dark:border-[#1E293B] flex items-center justify-center mb-6 transition-colors group-hover:bg-[#BFDBFE] dark:group-hover:bg-[#1E3A8A]">
                    <svg class="w-7 h-7 text-[#1D4ED8] dark:text-cyan-400 group-hover:text-[#1E3A8A] dark:group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h3 class="text-lg font-bold text-[#1E3A8A] dark:text-white mb-2">{{ $cert->name }}</h3>
                <p class="text-[#2563EB] dark:text-[#60A5FA] text-sm mb-4 font-bold">{{ $cert->issuer }}</p>
                
                @if ($cert->description)
                    <p class="text-[#475569] dark:text-slate-400 text-sm font-light leading-relaxed mb-6">{{ Str::limit($cert->description, 120) }}</p>
                @endif
                
                <div class="flex items-center justify-between mt-auto">
                    <span class="text-xs text-[#64748B] dark:text-[#94A3B8] font-mono font-bold">{{ $cert->date ? $cert->date->format('M Y') : 'No Date' }}</span>
                    @if ($cert->file_path)
                        <a href="{{ asset('storage/' . $cert->file_path) }}" target="_blank" class="text-xs font-bold text-[#1E3A8A] dark:text-[#E3F2FD] bg-[#DBEAFE] dark:bg-[#0F172A] hover:bg-[#BFDBFE] dark:hover:bg-[#2563EB] border border-[#93C5FD] dark:border-[#1E293B] shadow-sm px-5 py-2.5 rounded-full transition-colors flex items-center gap-2 group-hover:border-[#60A5FA]">
                            View Credential
                        </a>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full py-20 text-center">
                <p class="text-[#475569] dark:text-slate-400 font-light">No certificates published yet.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
