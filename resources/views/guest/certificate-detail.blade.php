@extends('layouts.guest')
@section('title', $certificate->name)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    {{-- Back button --}}
    <div class="mb-8">
        <a href="{{ route('certificates.archive') }}" class="inline-flex items-center gap-2 text-sm text-[#475569] hover:text-[#1E3A8A] dark:text-slate-400 dark:hover:text-white transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Certificates
        </a>
    </div>

    {{-- Certificate Image Preview --}}
    @if ($certificate->file_path)
        @php
            $isPdf = pathinfo($certificate->file_path, PATHINFO_EXTENSION) === 'pdf';
        @endphp
        <div class="rounded-xl overflow-hidden mb-8 border border-[#93C5FD] dark:border-slate-800/50 shadow-sm dark:shadow-none bg-[#DBEAFE]/30 dark:bg-[#0B1220] flex justify-center items-center p-4">
            @if($isPdf)
                <div class="flex flex-col items-center justify-center p-12 py-24 text-center">
                    <svg class="w-20 h-20 text-[#3B82F6] dark:text-[#60A5FA] mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    <h3 class="text-xl font-bold text-[#1E3A8A] dark:text-white mb-2">PDF Document</h3>
                    <p class="text-[#475569] dark:text-slate-400 mb-6 font-light">This certificate is in PDF format.</p>
                    <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#1E3A8A] text-white text-sm font-medium hover:bg-[#1e40af] transition shadow-lg shadow-blue-500/25">
                        View Full PDF
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
            @else
                <img src="{{ asset('storage/' . $certificate->file_path) }}" alt="{{ $certificate->name }}" class="max-w-full h-auto max-h-[600px] object-contain cursor-zoom-in rounded shadow-lg border border-slate-200 dark:border-slate-800">
            @endif
        </div>
    @endif

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-3">
            <h1 class="text-3xl sm:text-4xl font-bold text-[#1E3A8A] dark:text-white">{{ $certificate->name }}</h1>
        </div>
        <p class="text-xl text-[#2563EB] dark:text-[#60A5FA] font-semibold">{{ $certificate->issuer }}</p>
        <p class="text-sm font-mono text-[#64748B] dark:text-slate-400 mt-2">{{ $certificate->date ? $certificate->date->format('F d, Y') : 'Date Unspecified' }}</p>
    </div>

    {{-- Description --}}
    @if ($certificate->description)
        <div class="bg-[#EFF6FF]/70 border border-[#BFDBFE] dark:bg-slate-900/50 dark:border-slate-800/50 p-6 sm:p-8 rounded-2xl shadow-sm dark:shadow-none backdrop-blur-sm">
            <h2 class="text-lg font-semibold text-[#1E3A8A] dark:text-white mb-4">Description</h2>
            <div class="text-[#475569] dark:text-slate-300 leading-relaxed whitespace-pre-wrap font-light text-lg">{{ $certificate->description }}</div>
        </div>
    @endif
</div>
@endsection
