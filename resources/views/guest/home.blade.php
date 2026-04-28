@extends('layouts.guest')
@section('title', 'Home')

@section('content')
<style>
    /* CSS Animations & Micro-interactions */
    
    /* 1. Button Hover Glitch/Glow */
    .btn-glitch {
        position: relative;
        overflow: hidden;
        transition: transform 0.4s var(--ease-premium), box-shadow 0.4s var(--ease-premium), background-color 0.4s;
    }
    .btn-glitch:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 25px -5px rgba(59, 130, 246, 0.5);
    }
    .btn-glitch::after {
        content: '';
        position: absolute; inset: 0;
        background: repeating-linear-gradient(90deg, transparent, transparent 10%, rgba(34, 211, 238, 0.2) 10%, rgba(34, 211, 238, 0.2) 20%);
        mix-blend-mode: overlay;
        opacity: 0;
        z-index: 10;
        pointer-events: none;
    }
    .btn-glitch:hover::after {
        animation: glitch-anim 0.2s steps(3) infinite;
        opacity: 1;
    }
    @keyframes glitch-anim {
        0% { transform: translateX(0); }
        50% { transform: translateX(4px); }
        100% { transform: translateX(-4px); }
    }

    /* 2. Pixel Card Accent & Lift */
    .clean-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-soft);
        transition: transform 0.5s var(--ease-premium), box-shadow 0.5s var(--ease-premium), border-color 0.4s;
        position: relative;
    }
    .clean-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.05);
        border-color: rgba(59, 130, 246, 0.3);
    }
    .dark .clean-card:hover {
        box-shadow: 0 15px 35px -5px rgba(0, 0, 0, 0.3);
    }

    .pixel-corner {
        position: absolute;
        top: -1px; right: -1px;
        width: 12px; height: 12px;
        background: var(--primary);
        opacity: 0; transition: opacity 0.3s;
        clip-path: polygon(100% 0, 0 0, 100% 100%);
    }
    .clean-card:hover .pixel-corner { opacity: 1; }

    /* 3. Project Card Standout */
    .project-card {
        background: var(--bg-surface);
        border: 1px solid var(--border-soft);
        overflow: hidden;
        transition: all 0.5s var(--ease-premium);
        position: relative;
    }
    .project-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.15);
        border-color: var(--accent);
    }
    .project-card img {
        transition: transform 0.7s var(--ease-premium);
    }
    .project-card:hover img {
        transform: scale(1.04);
    }
    
    .project-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(15,23,42,0.9) 0%, rgba(15,23,42,0.2) 60%, transparent 100%);
        opacity: 0;
        transition: opacity 0.5s var(--ease-premium);
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 2rem;
        color: white;
    }
    .project-card:hover .project-overlay {
        opacity: 1;
    }

    .project-glitch-layer {
        position: absolute; inset: 0; pointer-events: none; opacity: 0; z-index: 20;
        background: repeating-linear-gradient(45deg, transparent, transparent 10px, rgba(34,211,238,0.1) 10px, rgba(34,211,238,0.1) 20px);
    }
    .project-card:hover .project-glitch-layer {
        animation: glitch-flash 0.15s steps(2);
        animation-fill-mode: forwards;
    }
    @keyframes glitch-flash {
        0% {opacity:0} 50% {opacity:1} 100% {opacity:0}
    }

    /* 4. Animated Gradient Progress Bar */
    .progress-bar-bg {
        background-color: var(--bg-base);
        border: 1px solid var(--border-soft);
        border-radius: 2px;
        overflow: hidden;
        height: 6px;
        width: 100%;
    }
    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), var(--accent), var(--primary));
        background-size: 200% 100%;
        animation: grad-shift 3s linear infinite;
        transform-origin: left;
    }
    @keyframes grad-shift { 100% { background-position: 200% 0; } }

    /* 5. Timeline styling */
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

    /* 6. Transparent Achievement Card Option A */
    .transparent-card {
        background: transparent;
        border: 1px solid var(--border-soft);
        border-radius: 12px;
        transition: all 0.4s var(--ease-premium);
    }
    .dark .transparent-card {
        background: rgba(255, 255, 255, 0.01);
        border: 1px solid rgba(255, 255, 255, 0.08);
    }
    .transparent-card:hover {
        transform: translateY(-4px);
        border-color: var(--primary);
        box-shadow: 0 0 20px -5px rgba(59, 130, 246, 0.2);
    }

    /* 7. Input focus glow */
    .input-glow:focus {
        border-color: var(--accent);
        box-shadow: 0 0 0 4px rgba(34, 211, 238, 0.15);
        outline: none;
    }
</style>

{{-- HERO SECTION --}}
<section id="hero" class="min-h-[80vh] flex flex-col justify-center items-center text-center px-6">
    <div class="gsap-hero mb-10 relative">
        @if ($profile && $profile->photo)
            <div class="w-32 h-32 md:w-40 md:h-40 rounded-xl overflow-hidden border-2 border-[var(--border-soft)] shadow-2xl relative z-10 bg-white inline-block">
                <img src="{{ asset('storage/' . $profile->photo) }}" alt="{{ $profile->name }}" class="w-full h-full object-cover">
            </div>
        @else
            <div class="w-32 h-32 md:w-40 md:h-40 rounded-xl bg-[var(--bg-surface)] border-2 border-[var(--border-soft)] flex items-center justify-center shadow-2xl z-10 relative">
                <span class="text-4xl font-heading font-black text-[var(--primary)] notranslate">{{ strtoupper(substr($profile->name ?? 'A', 0, 1)) }}</span>
            </div>
        @endif
        {{-- Hero geometric accent --}}
        <div class="absolute -bottom-4 -right-4 w-12 h-12 bg-[var(--accent)] opacity-20 blur-[15px] z-0 pointer-events-none"></div>
    </div>
    
    <p class="gsap-hero text-[var(--primary)] font-mono tracking-[0.25em] uppercase text-xs md:text-sm mb-6 font-bold">
        Hello, I am
    </p>
    
    <h1 class="gsap-hero text-5xl sm:text-6xl md:text-8xl font-black font-heading tracking-tight mb-8 text-[var(--text-primary)] relative z-10 notranslate">
        {{ $profile->name ?? 'Developer' }}<span class="text-[var(--accent)]">.</span>
    </h1>
    
    <p class="gsap-hero text-lg md:text-2xl text-[var(--text-secondary)] font-light max-w-3xl leading-relaxed mb-12">
        {{ $profile->headline ?? 'Full-Stack Developer crafting high-end digital experiences pixel by pixel.' }}
    </p>
    
    <div class="gsap-hero flex flex-col sm:flex-row gap-5 items-center justify-center w-full sm:w-auto">
        <a href="#projects" class="btn-glitch px-8 py-4 bg-[var(--primary)] text-white text-sm md:text-base font-semibold rounded-none tracking-wide shadow-[0_4px_15px_rgba(59,130,246,0.3)] w-full sm:w-auto">
            Explore Work
        </a>
        <a href="#contact" class="px-8 py-4 bg-transparent border border-[var(--text-secondary)] text-[var(--text-primary)] text-sm md:text-base font-semibold rounded-none tracking-wide hover:border-[var(--accent)] transition-colors duration-400 w-full sm:w-auto">
            Contact Me
        </a>
    </div>
</section>

{{-- ABOUT SECTION --}}
<section id="about" class="py-28 px-6">
    <div class="max-w-4xl mx-auto gsap-reveal gs-stagger">
        <div class="flex items-center gap-6 mb-12">
            <h2 class="text-3xl md:text-5xl font-bold font-heading text-[var(--text-primary)] notranslate">About</h2>
            <div class="h-px flex-1 bg-[var(--border-soft)]"></div>
            <div class="w-2 h-2 bg-[var(--primary)] shrink-0"></div>
        </div>
        
        <div class="clean-card p-10 md:p-14 text-left rounded-xl">
            <div class="pixel-corner"></div>
            <p class="text-[var(--text-secondary)] text-lg md:text-xl leading-loose font-light">
                {{ $profile->bio ?? 'A passionate developer bringing ideas to life through elegant code and refined design.' }}
            </p>
        </div>
    </div>
</section>

{{-- SKILLS SECTION --}}
<section id="skills" class="py-28 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="gsap-reveal gs-stagger flex items-center gap-6 mb-16">
            <h2 class="text-3xl md:text-5xl font-bold font-heading text-[var(--text-primary)] notranslate">Skills</h2>
            <div class="h-px flex-1 bg-[var(--border-soft)]"></div>
            <div class="w-2 h-2 bg-[var(--accent)] shrink-0"></div>
        </div>

        @php $groupedSkills = $skills->groupBy('category'); @endphp
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($groupedSkills as $category => $categorySkills)
                <div class="clean-card p-8 rounded-xl gsap-reveal gs-stagger group">
                    <div class="pixel-corner"></div>
                    <div class="flex items-center gap-3 mb-8">
                        <span class="w-8 h-8 rounded bg-[var(--primary)] text-white flex items-center justify-center font-mono text-xs font-bold shadow-sm">
                            {{ substr($category ?: 'ALL', 0, 2) }}
                        </span>
                        <h3 class="text-sm font-bold text-[var(--text-primary)] uppercase tracking-widest">
                            {{ $category ?: 'General' }}
                        </h3>
                    </div>
                    
                    <div class="space-y-6">
                        @foreach ($categorySkills as $skill)
                            <div class="hover:-translate-y-0.5 transition-transform">
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-sm font-medium text-[var(--text-primary)]">{{ $skill->name }}</span>
                                    <span class="text-[10px] text-[var(--text-secondary)] font-mono">{{ $skill->level }}%</span>
                                </div>
                                <div class="progress-bar-bg">
                                    <div class="progress-bar-fill" style="width: {{ $skill->level }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- PROJECTS SECTION --}}
<section id="projects" class="py-28 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="gsap-reveal gs-stagger flex items-center gap-6 mb-16">
            <h2 class="text-3xl md:text-5xl font-bold font-heading text-[var(--text-primary)] notranslate">Selected Work</h2>
            <div class="h-px flex-1 bg-[var(--border-soft)]"></div>
            <a href="{{ route('projects.archive') }}" class="text-xs font-bold font-mono tracking-widest text-[var(--primary)] hover:text-[var(--accent)] uppercase transition-colors shrink-0 flex items-center gap-2">
                Archives <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            @foreach ($allProjects as $project)
                <div class="project-card min-h-[20rem] sm:min-h-[24rem] w-full rounded-2xl group gsap-reveal gs-stagger block">
                    <div class="project-glitch-layer"></div>
                    
                    @if ($project->thumbnail)
                        <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-[var(--bg-surface)] flex items-center justify-center font-mono text-[var(--text-secondary)] tracking-widest text-sm font-bold">
                            {{ strtoupper($project->title) }}
                        </div>
                    @endif
                    
                    <a href="{{ route('project.detail', $project->slug) }}" class="project-overlay text-left rounded-2xl">
                        <div class="translate-y-4 group-hover:translate-y-0 transition-transform duration-500 var(--ease-premium)">
                            <div class="flex items-center justify-between gap-4 mb-2">
                                <h3 class="text-2xl md:text-3xl font-bold font-heading text-white">{{ $project->title }}</h3>
                                @if ($project->is_featured)
                                    <span class="px-2 py-1 bg-[var(--accent)]/20 border border-[var(--accent)]/50 text-[var(--accent)] text-[10px] font-bold tracking-widest uppercase rounded-sm shrink-0">Featured</span>
                                @endif
                            </div>
                            <p class="text-slate-300 font-light mb-6 text-sm line-clamp-2">{{ $project->short_description }}</p>
                            
                            <div class="flex items-center justify-between mt-auto">
                                <div class="flex flex-wrap gap-2">
                                    @foreach (($project->tech_stack ?? []) as $tech)
                                        <span class="px-2 py-1 bg-white/10 backdrop-blur-sm border border-white/20 text-white text-[10px] font-mono tracking-wider rounded-sm">{{ $tech }}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <span class="inline-flex items-center gap-2 text-[var(--accent)] text-sm font-bold transition-transform group-hover:translate-x-2 duration-300 mt-4">
                                View Case Study <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- EXPERIENCE SECTION --}}
<section id="experience" class="py-28 px-6 overflow-hidden relative">
    <div class="max-w-6xl mx-auto relative z-10">
        <div class="gsap-reveal gs-stagger flex items-center gap-6 mb-20">
            <h2 class="text-3xl md:text-5xl font-bold font-heading text-[var(--text-primary)] notranslate">Experience</h2>
            <div class="h-px flex-1 bg-[var(--border-soft)]"></div>
             <a href="{{ route('experiences.archive') }}" class="text-xs font-bold font-mono tracking-widest text-[var(--primary)] hover:text-[var(--accent)] uppercase transition-colors shrink-0 flex items-center gap-2">
                All Timeline <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
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
</section>

{{-- ACHIEVEMENTS SECTION (Seamless Background / Option A Cards) --}}
<section id="activities" class="py-28 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="gsap-reveal gs-stagger flex flex-col md:flex-row items-center justify-between gap-6 mb-16">
            <h2 class="text-3xl md:text-5xl font-bold font-heading text-[var(--text-primary)] text-center md:text-left notranslate">Achievements</h2>
            <div class="flex gap-4">
                <a href="{{ route('certificates.archive') }}" class="px-5 py-2 text-xs font-bold uppercase tracking-wider border border-[var(--border-soft)] hover:border-[var(--primary)] transition-colors rounded-none">Certificates</a>
                <a href="{{ route('activities.archive') }}" class="px-5 py-2 text-xs font-bold uppercase tracking-wider border border-[var(--border-soft)] hover:border-[var(--primary)] transition-colors rounded-none">Activities</a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Activities Preview -->
            <div class="space-y-6">
                @foreach ($activities->take(3) as $activity)
                    <div class="transparent-card p-8 gsap-reveal gs-stagger">
                        <div class="flex justify-between items-start mb-4 gap-4">
                            <h3 class="font-bold text-[var(--text-primary)] text-xl font-heading">{{ $activity->title }}</h3>
                            <span class="text-[10px] uppercase font-mono tracking-widest text-[var(--primary)] shrink-0 bg-[var(--primary)]/10 px-2 py-1 rounded-sm">{{ $activity->date ? $activity->date->format('M Y') : 'N/A' }}</span>
                        </div>
                        <p class="text-[var(--text-secondary)] font-light leading-relaxed line-clamp-3">{{ $activity->description }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Certificates Preview -->
            <div class="space-y-6">
                @foreach ($certificates->take(3) as $cert)
                    <div class="transparent-card p-8 gsap-reveal gs-stagger group flex flex-col sm:flex-row items-start gap-6">
                        <div class="w-12 h-12 shrink-0 border border-[var(--border-soft)] flex items-center justify-center rounded-lg bg-[var(--bg-surface)] group-hover:bg-[var(--primary)]/10 group-hover:border-[var(--primary)]/30 transition-colors">
                            <svg class="w-6 h-6 text-[var(--primary)] group-hover:text-[var(--accent)] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="font-bold text-[var(--text-primary)] text-lg font-heading mb-1">{{ $cert->name }}</h3>
                            <p class="text-xs text-[var(--text-secondary)] font-mono uppercase tracking-widest mb-3">{{ $cert->issuer }}</p>
                            @if ($cert->file_path)
                                <a href="{{ asset('storage/' . $cert->file_path) }}" target="_blank" class="text-xs font-bold text-[var(--primary)] hover:text-[var(--accent)] transition-colors inline-block group-hover:translate-x-1 duration-300">View Credential &rarr;</a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- CONTACT SECTION --}}
<section id="contact" class="py-28 px-6 mb-10">
    <div class="max-w-2xl mx-auto">
        <div class="text-center mb-16 gsap-reveal gs-stagger">
            <h2 class="text-3xl md:text-5xl font-bold font-heading text-[var(--text-primary)] mb-6 notranslate">Let's Talk</h2>
            <p class="text-[var(--text-secondary)] font-light text-lg">Interested in working together or just wanted to say hi?</p>
        </div>

        <div class="clean-card p-8 md:p-14 rounded-2xl gsap-reveal gs-stagger relative shadow-xl">
            <div class="pixel-corner"></div>
            @if (session('success'))
                <div class="mb-8 p-4 bg-[var(--accent)] bg-opacity-10 border-l-2 border-[var(--accent)] text-[var(--primary)] text-sm font-bold flex gap-3">
                    <svg class="w-5 h-5 text-[var(--accent)]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="text-[10px] font-mono tracking-widest text-[var(--text-secondary)] uppercase block">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="input-glow w-full bg-[var(--bg-base)] border border-[var(--border-soft)] py-4 px-5 text-sm font-medium text-[var(--text-primary)] placeholder-[var(--text-secondary)] transition-all rounded-lg outline-none">
                    </div>
                    <div class="space-y-2">
                        <label class="text-[10px] font-mono tracking-widest text-[var(--text-secondary)] uppercase block">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="input-glow w-full bg-[var(--bg-base)] border border-[var(--border-soft)] py-4 px-5 text-sm font-medium text-[var(--text-primary)] placeholder-[var(--text-secondary)] transition-all rounded-lg outline-none">
                    </div>
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-mono tracking-widest text-[var(--text-secondary)] uppercase block">Subject</label>
                    <input type="text" name="subject" value="{{ old('subject') }}" class="input-glow w-full bg-[var(--bg-base)] border border-[var(--border-soft)] py-4 px-5 text-sm font-medium text-[var(--text-primary)] placeholder-[var(--text-secondary)] transition-all rounded-lg outline-none">
                </div>
                <div class="space-y-2">
                    <label class="text-[10px] font-mono tracking-widest text-[var(--text-secondary)] uppercase block">Message</label>
                    <textarea name="body" rows="4" required class="input-glow w-full bg-[var(--bg-base)] border border-[var(--border-soft)] py-4 px-5 text-sm font-medium text-[var(--text-primary)] placeholder-[var(--text-secondary)] transition-all resize-none rounded-lg outline-none">{{ old('body') }}</textarea>
                </div>
                <button type="submit" class="btn-glitch w-full py-5 bg-[var(--text-primary)] text-[var(--bg-base)] dark:text-gray-900 border border-[var(--text-primary)] dark:border-transparent text-xs font-bold tracking-widest uppercase mt-4 rounded-lg">
                    Send Message
                </button>
            </form>
        </div>
    </div>
</section>

<!-- GSAP Premium Animation Engine -->
<script>
    // Listen to custom event fired by the loader in guest.blade.php
    window.addEventListener("pageAnimationsReady", () => {
        if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') return;
        
        // 1. Initial Page Load Animation for Hero
        const heroElems = document.querySelectorAll(".gsap-hero");
        if(heroElems.length > 0) {
            gsap.set(heroElems, { willChange: 'transform, opacity' });
            gsap.from(heroElems, { 
                y: 40, opacity: 0, duration: 1.2, stagger: 0.15, ease: "power3.out",
                onComplete: () => gsap.set(heroElems, { clearProps: "all" })
            });
        }

        // 2. High-Performance Thieb.co Scroll Scrubbing
        const revealElements = gsap.utils.toArray(".gsap-reveal");
        if(revealElements.length > 0) {
            revealElements.forEach(el => {
                gsap.set(el, { willChange: 'transform, opacity' });
                gsap.fromTo(el, 
                    { y: 120, opacity: 0, scale: 0.96 },
                    {
                        scrollTrigger: {
                            trigger: el,
                            start: "top 95%", 
                            end: "top 60%", 
                            scrub: 1.2, 
                        },
                        y: 0, 
                        opacity: 1, 
                        scale: 1,
                        ease: "none"
                    }
                );
            });
        }

        // 4. 3D Card Interactive Tilt (Press Effect)
        const cards3D = document.querySelectorAll('.clean-card, .project-card, .clean-timeline-card');
        cards3D.forEach(card => {
            card.style.transformStyle = "preserve-3d";
            
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left; 
                const y = e.clientY - rect.top; 
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                // Tilt calculation (negative X rocks top backward when hovering top)
                const rotateX = ((y - centerY) / centerY) * -6; 
                const rotateY = ((x - centerX) / centerX) * 6;
                
                // scale3d(0.98) simulates the entire card being pushed in
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(0.98, 0.98, 0.98) translateZ(0)`;
                card.style.transition = 'transform 0.1s ease';
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1) translateZ(0)';
                card.style.transition = 'transform 0.6s cubic-bezier(0.2, 0, 0.2, 1)';
            });
        });

        // 3. Proximity-based Header Interaction (Magnetic Text Spread)
        const headers = document.querySelectorAll('h2.font-heading, h1.gsap-hero');
        
        let mouseX = -1000;
        let mouseY = -1000;
        window.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });

        headers.forEach(header => {
            let content = header.textContent.trim();
            if(!content) return;
            
            const isHero = header.tagName.toLowerCase() === 'h1';
            let pureText = isHero ? content.replace('.', '') : content;
            
            header.innerHTML = '';
            for(let i = 0; i < pureText.length; i++) {
                let span = document.createElement('span');
                span.className = 'char inline-block pointer-events-none';
                span.innerHTML = pureText[i] === ' ' ? '&nbsp;' : pureText[i];
                span.style.transition = 'transform 0.3s cubic-bezier(0.2, 0, 0.2, 1), color 0.3s';
                header.appendChild(span);
            }
            if(isHero) {
                let dot = document.createElement('span');
                dot.className = 'char inline-block text-[var(--accent)] pointer-events-none';
                dot.innerHTML = '.';
                dot.style.transition = 'transform 0.3s cubic-bezier(0.2, 0, 0.2, 1), color 0.3s';
                header.appendChild(dot);
            }

            const chars = header.querySelectorAll('.char');
            let isHovering = false;
            let rafId = null;

            function updateMagnetic() {
                if(!isHovering) return;
                
                const magnetRadius = 120; // 120px interaction circle
                const maxPush = 15; // Max displacement
                
                chars.forEach(char => {
                    const rect = char.getBoundingClientRect();
                    const cx = rect.left + rect.width / 2;
                    const cy = rect.top + rect.height / 2;
                    const dx = cx - mouseX;
                    const dy = cy - mouseY;
                    const dist = Math.sqrt(dx*dx + dy*dy);
                    
                    if (dist < magnetRadius) {
                        const force = (magnetRadius - dist) / magnetRadius;
                        const mvX = (dx / dist) * maxPush * force;
                        const mvY = (dy / dist) * maxPush * force;
                        char.style.transform = `translate(${mvX}px, ${mvY}px) scale(1.05) translateZ(0)`;
                        if (!char.classList.contains('text-[var(--accent)]')) {
                            char.style.color = 'var(--primary)';
                        }
                    } else {
                        char.style.transform = `translate(0px, 0px) scale(1) translateZ(0)`;
                        char.style.color = '';
                    }
                });
                rafId = requestAnimationFrame(updateMagnetic);
            }

            header.addEventListener('mouseenter', () => {
                isHovering = true;
                updateMagnetic();
            });

            header.addEventListener('mouseleave', () => {
                isHovering = false;
                cancelAnimationFrame(rafId);
                chars.forEach(char => {
                    char.style.transform = `translate(0px, 0px) scale(1) translateZ(0)`;
                    char.style.color = '';
                });
            });
        });
    });
</script>
@endsection
