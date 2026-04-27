@extends('layouts.guest')
@section('title', 'Experience Archives')

@section('content')
<style>
    /* Timeline styling mapping to Guest View clean UI */
    .timeline-line {
        position: absolute;
        left: 50%;
        top: 0; bottom: 0;
        width: 2px;
        background-image: linear-gradient(to bottom, var(--text-secondary) 50%, transparent 50%);
        background-size: 2px 12px; /* dashed line */
        transform: translateX(-50%);
        opacity: 0.2;
        z-index: 0;
    }

    /* Refined Timeline Card */
    .clean-timeline-card {
        background: transparent;
        border: 1px solid var(--border-soft);
        border-radius: 16px;
        transition: all 0.4s var(--ease-premium);
        position: relative;
        z-index: 10;
        padding: 24px;
    }
    .dark .clean-timeline-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.06);
    }
    .clean-timeline-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 30px -5px rgba(59, 130, 246, 0.15);
        border-color: rgba(59, 130, 246, 0.4);
    }
</style>

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center md:text-left relative z-10">
    {{-- Back button --}}
    <div class="mb-12">
        <a href="{{ route('home') }}#experience" class="inline-flex items-center gap-2 text-sm font-bold tracking-widest uppercase text-[var(--primary)] hover:text-[var(--accent)] transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Home
        </a>
    </div>

    {{-- Page Header --}}
    <div class="mb-20">
        <h1 class="text-4xl md:text-5xl font-bold font-heading text-[var(--text-primary)] mb-4 tracking-tight">Experience Archives</h1>
        <p class="text-xl text-[var(--text-secondary)] font-light">Complete timeline of my professional journey.</p>
    </div>

    <div class="relative w-full">
        <!-- Timeline Center Line -->
        <div class="hidden md:block timeline-line"></div>
        <!-- Mobile Line -->
        <div class="md:hidden absolute left-4 top-0 bottom-0 w-[2px] bg-gradient-to-b from-[var(--text-secondary)] to-transparent opacity-20 dashed bg-[size:2px_12px] z-0"></div>

        <div class="space-y-12 relative z-10">
            @foreach ($experiences as $index => $exp)
                <!-- CSS Grid exactly matches 1fr auto 1fr -->
                <div class="w-full gsap-reveal gs-stagger grid grid-cols-1 md:grid-cols-[1fr_auto_1fr] md:gap-12 items-center relative gap-4 pl-10 md:pl-0">
                    
                    <!-- Mobile Marker (Absolute to timeline) -->
                    <span class="md:hidden absolute left-[17px] top-8 w-3 h-3 rounded-none bg-[var(--primary)] transform -translate-x-1/2 -translate-y-1/2 rotate-45 border border-[var(--bg-base)] z-20"></span>

                    @if ($index % 2 == 0)
                        <!-- Left Block -->
                        <div class="md:col-start-1 clean-timeline-card text-left md:text-right">
                            <h3 class="text-xl md:text-2xl font-bold font-heading text-[var(--text-primary)] mb-1">{{ $exp->position }}</h3>
                            <p class="text-[var(--primary)] font-semibold text-sm mb-3">{{ $exp->organization }}</p>
                            <p class="text-xs font-mono text-[var(--text-secondary)] mb-4 uppercase tracking-wider">{{ $exp->start_date->format('M Y') }} — {{ $exp->is_current ? 'Present' : ($exp->end_date ? $exp->end_date->format('M Y') : '-') }}</p>
                            
                            @php
                                $badgeColors = [
                                    'work' => 'bg-transparent text-[var(--primary)] border-[var(--primary)] text-[10px]',
                                    'organization' => 'bg-transparent text-[var(--accent)] border-[var(--accent)] text-[10px]',
                                    'study' => 'bg-transparent text-indigo-400 border-indigo-400 text-[10px]'
                                ][$exp->type] ?? 'bg-transparent text-slate-400 border-slate-400 text-[10px]';
                            @endphp
                            <div class="mb-4">
                                <span class="px-2 py-0.5 border {{ $badgeColors }} font-mono uppercase tracking-widest">{{ ucfirst($exp->type) }}</span>
                            </div>

                            @if ($exp->description)
                                <p class="text-[var(--text-secondary)] font-light text-sm leading-relaxed">{{ $exp->description }}</p>
                            @endif
                        </div>
                        
                        <!-- Center Marker -->
                        <div class="hidden md:flex flex-col items-center justify-center md:col-start-2 relative z-20 w-8">
                            <div class="w-4 h-4 bg-[var(--accent)] rotate-45 shadow-[0_0_15px_rgba(34,211,238,0.5)] border-2 border-[var(--bg-base)]"></div>
                        </div>
                        
                        <!-- Empty Right Block for alignment -->
                        <div class="hidden md:block md:col-start-3"></div>
                    @else
                        <!-- Empty Left Block for alignment -->
                        <div class="hidden md:block md:col-start-1"></div>
                        
                        <!-- Center Marker -->
                        <div class="hidden md:flex flex-col items-center justify-center md:col-start-2 relative z-20 w-8">
                            <div class="w-4 h-4 bg-[var(--primary)] rotate-45 shadow-[0_0_15px_rgba(59,130,246,0.5)] border-2 border-[var(--bg-base)]"></div>
                        </div>

                        <!-- Right Block -->
                        <div class="md:col-start-3 clean-timeline-card text-left">
                            <h3 class="text-xl md:text-2xl font-bold font-heading text-[var(--text-primary)] mb-1">{{ $exp->position }}</h3>
                            <p class="text-[var(--primary)] font-semibold text-sm mb-3">{{ $exp->organization }}</p>
                            <p class="text-xs font-mono text-[var(--text-secondary)] mb-4 uppercase tracking-wider">{{ $exp->start_date->format('M Y') }} — {{ $exp->is_current ? 'Present' : ($exp->end_date ? $exp->end_date->format('M Y') : '-') }}</p>
                            
                            @php
                                $badgeColors = [
                                    'work' => 'bg-transparent text-[var(--primary)] border-[var(--primary)] text-[10px]',
                                    'organization' => 'bg-transparent text-[var(--accent)] border-[var(--accent)] text-[10px]',
                                    'study' => 'bg-transparent text-indigo-400 border-indigo-400 text-[10px]'
                                ][$exp->type] ?? 'bg-transparent text-slate-400 border-slate-400 text-[10px]';
                            @endphp
                            <div class="mb-4">
                                <span class="px-2 py-0.5 border {{ $badgeColors }} font-mono uppercase tracking-widest">{{ ucfirst($exp->type) }}</span>
                            </div>

                            @if ($exp->description)
                                <p class="text-[var(--text-secondary)] font-light text-sm leading-relaxed">{{ $exp->description }}</p>
                            @endif
                        </div>
                    @endif

                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    window.addEventListener("pageAnimationsReady", () => {
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
        
        const revealElements = gsap.utils.toArray(".gsap-reveal");
        if(revealElements.length > 0) {
            gsap.set(revealElements, { opacity: 0, y: 40 });
            ScrollTrigger.batch(revealElements, {
                start: "top 85%",
                onEnter: batch => {
                    gsap.set(batch, { willChange: 'transform, opacity' });
                    gsap.to(batch, {
                        y: 0, opacity: 1, duration: 0.8, stagger: 0.1, ease: "power3.out",
                        onComplete: () => gsap.set(batch, { clearProps: "all" })
                    });
                }
            });
        }
    });
</script>
@endsection
