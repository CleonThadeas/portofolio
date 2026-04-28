<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="Portfolio of {{ $profile->name ?? 'Developer' }}">
    <title>{{ $profile->name ?? 'Portfolio' }} - @yield('title', 'Home')</title>
    
    <link rel="icon" href="{{ asset('storage/logo/logo.svg') }}" type="image/svg+xml">
    <link rel="icon" href="{{ asset('storage/logo/logo.png') }}" type="image/png">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- High-Performance Engine Libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://unpkg.com/@studio-freight/lenis@1.0.34/dist/lenis.min.js"></script>

    <script>
        // Init theme early to prevent flash
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <style>
        :root {
            --bg-base: #f5f5f5;
            --bg-surface: #e5e7eb;
            --primary: #3b82f6;
            --accent: #22d3ee;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-soft: rgba(0,0,0,0.05);
            --ease-premium: cubic-bezier(0.22, 1, 0.36, 1);
        }

        .dark {
            --bg-base: #0f172a;
            --bg-surface: #1e293b;
            --primary: #3b82f6;
            --accent: #22d3ee;
            --text-primary: #f8fafc;
            --text-secondary: #94a3b8;
            --border-soft: rgba(255,255,255,0.05);
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-base);
            color: var(--text-primary);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Prevent system scroll bounce for smooth Lenis scrolling */
        html.lenis { height: auto; }
        .lenis.lenis-smooth { scroll-behavior: auto !important; }
        .lenis.lenis-smooth [data-lenis-prevent] { overscroll-behavior: contain; }
        .lenis.lenis-stopped { overflow: hidden; }

        ::-webkit-scrollbar {
            display: none;
        }
        
        *, *::before, *::after {
            -ms-overflow-style: none;
            scrollbar-width: none;
            backface-visibility: hidden;
        }

        /* Custom Cursor Base Styles */
        @media (pointer: fine) {
            *, *::before, *::after {
                cursor: none !important;
            }
        }
        
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Poppins', sans-serif;
        }

        /* 1. Loading Screen Optimization */
        #page-loader {
            position: fixed; inset: 0; z-index: 9999;
            background-color: var(--bg-base);
            display: flex; align-items: center; justify-content: center;
            transform: translateZ(0); /* GPU */
            transition: opacity 0.5s var(--ease-premium), visibility 0.5s, transform 0.5s var(--ease-premium);
        }
        .loader-circle {
            width: 140px; height: 140px;
            border-radius: 50%;
            border: 2px solid var(--border-soft);
            position: relative; overflow: hidden;
            display: flex; align-items: center; justify-content: center;
        }
        .loader-water {
            position: absolute;
            width: 250%; 
            height: 250%;
            left: -75%;
            top: 100%; /* completely hidden below */
            border-radius: 40%; /* Creates wavy top as it spins */
            z-index: 0;
            filter: drop-shadow(0 0 10px rgba(59, 130, 246, 0.5));
        }
        .water-back {
            background: linear-gradient(180deg, var(--accent) 0%, rgba(34,211,238,0.5) 100%);
            opacity: 0.5;
            animation: waterRise 1.5s cubic-bezier(0.8, 0, 0.2, 1) forwards, waterSpin 3.5s linear infinite;
        }
        .water-front {
            background: linear-gradient(180deg, var(--accent) 0%, var(--primary) 100%);
            animation: waterRise 1.5s cubic-bezier(0.8, 0, 0.2, 1) forwards 0.2s, waterSpin 2.5s linear infinite;
        }
        @keyframes waterRise {
            0% { top: 100%; }
            100% { top: -20%; } /* Push pass top to fully submerge */
        }
        @keyframes waterSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* 2. Background System (No Canvas, Max 15 Nodes) */
        .bg-system {
            position: fixed; inset: 0; z-index: -1;
            pointer-events: none; overflow: hidden;
            transform: translateZ(0);
        }
        .pixel-grid-overlay {
            position: absolute; inset: 0; opacity: 0.03;
            background-image: linear-gradient(to right, currentColor 1px, transparent 1px),
                              linear-gradient(to bottom, currentColor 1px, transparent 1px);
            background-size: 32px 32px;
        }
        .bg-radial {
            position: absolute; inset: 0;
            background: radial-gradient(circle at 50% 0%, rgba(59, 130, 246, 0.08) 0%, transparent 60%);
        }
        .dark .bg-radial {
            background: radial-gradient(circle at 50% 0%, rgba(59, 130, 246, 0.15) 0%, transparent 60%);
        }
        .ambient-pixel {
            position: absolute; width: 4px; height: 4px;
            background-color: var(--primary);
            will-change: transform, background-color;
            transition: background-color 0.4s;
            border-radius: 1px;
            top: 0; left: 0; /* Base CSS coords */
        }
        .ambient-pixel.particle-active {
            background-color: var(--accent);
            box-shadow: 0 0 10px var(--accent);
        }

        /* 3. Pixel Wave Theme Grid */
        #theme-wave-container {
            position: fixed; inset: -5px; z-index: 9998;
            pointer-events: none;
            display: grid;
        }
        .theme-block {
            background-color: var(--primary);
            transform: translateY(105vh) translateZ(0); /* out of view */
            opacity: 1; /* solid override */
        }
        .global-transition-overlay {
            position: fixed; inset: 0; z-index: 9997;
            background: linear-gradient(to bottom, var(--primary), var(--accent));
            opacity: 0; pointer-events: none;
        }

        /* Nav & Structure */
        .nav-glass {
            background: var(--bg-base); /* Disabled heavy blur backdrop-filter for perf */
            border-bottom: 1px solid var(--border-soft);
            transition: box-shadow 0.3s var(--ease-premium), transform 0.3s, background-color 0s;
        }
        .nav-scrolled { box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05); }
        .hover-underline { position: relative; padding-bottom: 4px; }
        .hover-underline::after {
            content: ''; position: absolute; left: 0; bottom: 0; width: 0; height: 2px;
            background-color: var(--primary); transition: width 0.3s var(--ease-premium);
        }
        .hover-underline:hover::after { width: 100%; }

        main { flex: 1; position: relative; z-index: 10; transform: translateZ(0); }
        footer { margin-top: auto; position: relative; z-index: 10; }
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-base); }
        ::-webkit-scrollbar-thumb { background: var(--text-secondary); border-radius: 4px; }
    </style>
</head>
<body class="selection:bg-blue-500/20 selection:text-blue-900 dark:selection:bg-cyan-400/20 dark:selection:text-cyan-100 overflow-x-hidden">
    <!-- Custom Cursor -->
    <div id="cursor-wrapper" class="fixed top-0 left-0 pointer-events-none z-[10002] hidden md:flex items-center justify-center mix-blend-difference" style="will-change: transform; transform: translate3d(-100px,-100px,0);">
        <div id="custom-cursor" class="w-2 h-2 bg-blue-500 rounded-sm transition-[width,height,background-color] duration-200 flex items-center justify-center">
            <svg id="cursor-zoom-icon" class="w-4 h-4 text-white opacity-0 transition-opacity duration-200 absolute" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
        </div>
    </div>
    <div id="cursor-trail-wrapper" class="fixed top-0 left-0 pointer-events-none z-[10001] hidden md:flex items-center justify-center" style="will-change: transform; transform: translate3d(-100px,-100px,0);">
        <div id="custom-cursor-trail" class="w-8 h-8 border-[1.5px] border-blue-400 rounded-sm transition-[width,height,opacity] duration-300"></div>
    </div>

    <!-- Loading System -->
    <div id="page-loader">
        <div class="loader-circle">
            <div class="loader-water water-back"></div>
            <div class="loader-water water-front"></div>
        </div>
    </div>

    <!-- Theme Transition Overlay Box -->
    <div id="theme-wave-container"></div>
    <div id="global-gradient" class="global-transition-overlay"></div>

    <div class="bg-system">
        <div class="pixel-grid-overlay text-gray-900 dark:text-white"></div>
        <div class="bg-radial"></div>
        <!-- Max 10 floating nodes generated via JS below -->
        <div id="ambient-container"></div>
    </div>

    {{-- Navbar --}}
    <nav id="navbar" class="fixed top-0 w-full z-50 nav-glass py-4">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex justify-between items-center text-sm font-medium">
            <a href="{{ route('home') }}" class="group flex items-center shrink-0">
                <img src="{{ asset('storage/logo/logo.svg') }}" onerror="this.onerror=null; this.src='{{ asset('storage/logo/logo.png') }}';" alt="Logo" class="h-8 md:h-10 object-contain transition-transform duration-300 transform group-hover:scale-105">
            </a>
            
            <div class="hidden md:flex items-center space-x-6">
                @foreach([ 'About', 'Skills', 'Projects', 'Experience', 'Contact' ] as $item)
                    <a href="{{ route('home') }}#{{ strtolower($item) }}" class="text-[var(--text-primary)] hover:text-[var(--primary)] hover-underline transition-colors">{{ $item }}</a>
                @endforeach
            </div>

            <div class="flex items-center gap-2">
                <div class="hidden md:block w-px h-5 bg-gray-300 dark:bg-gray-700 mx-2"></div>
                <!-- Theme Toggle -->
                <button id="theme-toggle" class="p-2 rounded focus:outline-none hover:bg-black/5 dark:hover:bg-white/5 transition-colors text-[var(--text-secondary)] hover:text-[var(--primary)] relative z-50 transform hover:scale-105" aria-label="Toggle Theme">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd"></path></svg>
                </button>
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 text-[var(--text-primary)] hover:text-[var(--primary)] transition-colors relative z-50">
                    <svg id="icon-menu" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg id="icon-close" class="w-7 h-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Container -->
    <div id="mobile-menu" class="fixed inset-0 z-40 bg-[var(--bg-base)] flex flex-col justify-center items-center transform translate-x-full transition-transform duration-500 var(--ease-premium)">
        <div class="flex flex-col space-y-8 text-center px-6 w-full">
            @foreach([ 'About', 'Skills', 'Projects', 'Experience', 'Contact' ] as $item)
                <a href="{{ route('home') }}#{{ strtolower($item) }}" class="mobile-nav-link text-3xl font-heading font-black text-[var(--text-primary)] hover:text-[var(--primary)] transition-colors var(--ease-premium)">{{ $item }}</a>
            @endforeach
        </div>
    </div>

    <main class="w-full pt-28 pb-16">
        @yield('content')
    </main>

    <footer class="w-full border-t border-gray-200 dark:border-white/10 bg-[var(--bg-surface)] pt-12 pb-6 mt-auto">
        <div class="max-w-7xl mx-auto px-6 w-full">
            <div class="flex flex-col md:flex-row justify-between items-center text-center md:text-left gap-6 text-sm">
                <div>
                    <h3 class="font-heading font-bold text-lg mb-1 text-[var(--text-primary)] notranslate">{{ $profile->name ?? 'Developer' }}</h3>
                    <p class="text-[var(--text-secondary)]">{{ $profile->headline ?? 'Full-Stack Developer' }}</p>
                </div>
                <!-- Links -->
                <div class="flex gap-6">
                    <a href="https://github.com/{{ $profile->github ?? '' }}" target="_blank" class="text-[var(--text-secondary)] hover:text-[var(--primary)] font-bold text-xs tracking-widest uppercase transition-colors">GitHub</a>
                    <a href="https://linkedin.com/in/{{ $profile->linkedin ?? '' }}" target="_blank" class="text-[var(--text-secondary)] hover:text-[var(--primary)] font-bold text-xs tracking-widest uppercase transition-colors">LinkedIn</a>
                    <a href="https://instagram.com/{{ $profile->instagram ?? '' }}" target="_blank" class="text-[var(--text-secondary)] hover:text-[var(--primary)] font-bold text-xs tracking-widest uppercase transition-colors">Instagram</a>
                </div>
            </div>
            <div class="mt-8 text-center text-xs text-[var(--text-secondary)] border-t border-gray-200 dark:border-white/5 pt-6 flex justify-between items-center">
                <span>&copy; {{ date('Y') }}. All rights reserved.</span>
                <span class="font-mono bg-[var(--bg-base)] px-2 py-1 text-[10px] rounded border border-[var(--border-soft)]">H-PERF PIXEL UI v3.0</span>
            </div>
        </div>
    </footer>

    <!-- HIGH PERFORMANCE ENGINE CORE -->
    <script>
        // 1. Lenis + GSAP RAF Synchronization
        const lenis = new Lenis({
            lerp: 0.1, // Responsively fast but smooth
            smoothWheel: true,
            wheelMultiplier: 1
        });
        lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.add((time) => { lenis.raf(time * 1000); });
        gsap.ticker.lagSmoothing(0); // Critical fix for stutter

        document.addEventListener('DOMContentLoaded', () => {
            // Loader exit logic - 1.5s minimum fill time
            setTimeout(() => {
                const loader = document.getElementById('page-loader');
                loader.style.transform = 'scale(0.9) translateZ(0)';
                loader.style.opacity = '0';
                setTimeout(() => loader.style.visibility = 'hidden', 500);
                // Trigger global "pageReady" event for views to attach their animations to
                window.dispatchEvent(new Event('pageAnimationsReady'));
            }, 1500);

            // Matrix Swarm Interactive Particles
            const ambientBox = document.getElementById('ambient-container');
            const particles = [];
            for(let i=0; i<30; i++) {
                let div = document.createElement('div');
                const size = Math.random() > 0.8 ? 8 : 4; 
                div.className = 'ambient-pixel';
                div.style.width = size + 'px';
                div.style.height = size + 'px';
                
                const vw = Math.random() * 100;
                const vh = Math.random() * 100;
                div.style.opacity = Math.random() * 0.3 + 0.1;
                ambientBox.appendChild(div);
                
                particles.push({
                    el: div, vw, vh,
                    x: vw * (window.innerWidth/100),
                    y: vh * (window.innerHeight/100),
                    vx: 0, vy: 0
                });
            }

            // Custom Cursor & Interaction variables
            let mX = -100, mY = -100;
            let tX = window.innerWidth/2, tY = window.innerHeight/2;
            const cursorWrapper = document.getElementById('cursor-wrapper');
            const trailWrapper = document.getElementById('cursor-trail-wrapper');
            const customCursor = document.getElementById('custom-cursor');
            const cursorTrail = document.getElementById('custom-cursor-trail');
            const cursorZoomIcon = document.getElementById('cursor-zoom-icon');

            window.addEventListener('mousemove', e => { 
                mX = e.clientX; 
                mY = e.clientY; 
                if(cursorWrapper) cursorWrapper.style.transform = `translate3d(${mX}px, ${mY}px, 0) translate(-50%, -50%)`;
            });

            // Hover states logic
            document.addEventListener('mouseover', (e) => {
                const target = e.target;
                const interactive = target.closest('a, button, input, textarea, select, .cursor-pointer');
                const zoomable = target.closest('.cursor-zoom-in, [src*="storage"]');
                
                if (zoomable) {
                    customCursor.classList.remove('w-2', 'h-2', 'bg-blue-500');
                    customCursor.classList.add('w-10', 'h-10', 'bg-white');
                    cursorWrapper.classList.remove('mix-blend-difference');
                    cursorZoomIcon.classList.remove('opacity-0');
                    cursorZoomIcon.style.color = '#1e3a8a';
                    cursorTrail.classList.add('opacity-0');
                } else if (interactive) {
                    customCursor.classList.remove('w-2', 'h-2');
                    customCursor.classList.add('w-8', 'h-8', 'bg-white');
                    cursorTrail.classList.remove('w-8', 'h-8');
                    cursorTrail.classList.add('w-4', 'h-4', 'opacity-50');
                }
            });

            document.addEventListener('mouseout', (e) => {
                const target = e.target;
                const interactive = target.closest('a, button, input, textarea, select, .cursor-pointer');
                const zoomable = target.closest('.cursor-zoom-in, [src*="storage"]');
                
                if (zoomable) {
                    customCursor.classList.remove('w-10', 'h-10', 'bg-white');
                    customCursor.classList.add('w-2', 'h-2', 'bg-blue-500');
                    cursorWrapper.classList.add('mix-blend-difference');
                    cursorZoomIcon.classList.add('opacity-0');
                    cursorTrail.classList.remove('opacity-0');
                } else if (interactive) {
                    customCursor.classList.add('w-2', 'h-2');
                    customCursor.classList.remove('w-8', 'h-8', 'bg-white');
                    cursorTrail.classList.add('w-8', 'h-8');
                    cursorTrail.classList.remove('w-4', 'h-4', 'opacity-50');
                }
            });

            gsap.ticker.add((time) => {
                const W = window.innerWidth / 100;
                const H = window.innerHeight / 100;
                
                particles.forEach(p => {
                    const targetX = p.vw * W;
                    const targetY = p.vh * H;
                    
                    const dx = p.x - mX;
                    const dy = p.y - mY;
                    const dist = Math.sqrt(dx*dx + dy*dy);
                    
                    if (dist < 150) {
                        const force = (150 - dist) / 150;
                        p.vx += (dx / dist) * force * 2;
                        p.vy += (dy / dist) * force * 2;
                        p.el.classList.add('particle-active');
                    } else {
                        p.vx += (targetX - p.x) * 0.02;
                        p.vy += (targetY - p.y) * 0.02;
                        p.el.classList.remove('particle-active');
                    }
                    
                    p.vx *= 0.85;
                    p.vy *= 0.85;
                    p.x += p.vx;
                    p.y += p.vy;
                    
                    const floatY = Math.sin(time + p.vw) * 20;
                    p.el.style.transform = `translate3d(${p.x}px, ${p.y + floatY}px, 0)`;
                });

                // Lerp cursor trail
                tX += (mX - tX) * 0.15;
                tY += (mY - tY) * 0.15;
                if(trailWrapper) trailWrapper.style.transform = `translate3d(${tX}px, ${tY}px, 0) translate(-50%, -50%)`;
            });

            // High Performance Adaptive Theme Grid
            const themeContainer = document.getElementById('theme-wave-container');
            const globalGrad = document.getElementById('global-gradient');
            globalGrad.style.background = 'linear-gradient(135deg, #3b82f6, #22d3ee, #8b5cf6)'; // gradient variation
            
            const themeToggleBtn = document.getElementById('theme-toggle');
            const darkIcon = document.getElementById('theme-toggle-dark-icon');
            const lightIcon = document.getElementById('theme-toggle-light-icon');
            
            const initTheme = () => {
                if (document.documentElement.classList.contains('dark')) {
                    lightIcon.classList.remove('hidden'); darkIcon.classList.add('hidden');
                } else {
                    darkIcon.classList.remove('hidden'); lightIcon.classList.add('hidden');
                }
            };
            initTheme();

            let isTransitioning = false;
            themeToggleBtn.addEventListener('click', () => {
                if(isTransitioning) return;
                isTransitioning = true;
                
                // Regenerate completely on every click
                themeContainer.innerHTML = ''; 
                const isDesktop = window.innerWidth > 768;
                const COLS = isDesktop ? 12 : 6;
                const ROWS = isDesktop ? 10 : 10;
                const TOTAL = COLS * ROWS;
                
                themeContainer.style.gridTemplateColumns = `repeat(${COLS}, 1fr)`;
                themeContainer.style.gridTemplateRows = `repeat(${ROWS}, 1fr)`;
                
                for(let i=0; i<TOTAL; i++) {
                    let d = document.createElement('div');
                    d.className = 'theme-block';
                    d.dataset.row = Math.floor(i / COLS);
                    themeContainer.appendChild(d);
                }
                const themeBlocks = document.querySelectorAll('.theme-block');
                
                // Blocks start at bottom, solid color matching the target theme
                const isGoingDark = !document.documentElement.classList.contains('dark');
                gsap.set(themeBlocks, { y: "105vh", opacity: 1, backgroundColor: isGoingDark ? '#0f172a' : '#f8fafc' });

                const tl = gsap.timeline({
                    onComplete: () => {
                        isTransitioning = false;
                        themeContainer.innerHTML = ''; // CLEAR DOM
                    }
                });

                // Wave Up
                tl.to(themeBlocks, {
                    y: "0vh",
                    duration: 0.8,
                    stagger: (index, target) => { return target.dataset.row * 0.05; },
                    ease: "power2.out",
                    onComplete: () => {
                        // Switch CSS Theme precisely midway when screen is 100% COVERED
                        document.documentElement.classList.toggle('dark');
                        localStorage.setItem('theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
                        initTheme();
                        // No background color change here! Keep it 1 solid color throughout.
                    }
                }, 0);
                
                // Wave Down (Exit)
                tl.to(themeBlocks, {
                    y: "-105vh",
                    duration: 0.8,
                    stagger: (index, target) => { return target.dataset.row * 0.05; },
                    ease: "power3.inOut"
                }, 1.3);
            });

            // Mobile menu fast toggle
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const iconMenu = document.getElementById('icon-menu');
            const iconClose = document.getElementById('icon-close');

            const toggleMobile = () => {
                mobileMenu.classList.toggle('translate-x-full');
                iconMenu.classList.toggle('hidden');
                iconClose.classList.toggle('hidden');
            };
            mobileMenuBtn.addEventListener('click', toggleMobile);

            // Smooth scroll for internal anchors via Lenis globally
            document.querySelectorAll('a[href*="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    // Avoid external # hash conflicts
                    if(href === '#') return;
                    const url = new URL(href, window.location.origin);
                    if (url.pathname === window.location.pathname && url.hash) {
                        e.preventDefault();
                        const targetEl = document.querySelector(url.hash);
                        if (targetEl) {
                            lenis.scrollTo(targetEl, { offset: -80, duration: 1.2, easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)) });
                            if (!mobileMenu.classList.contains('translate-x-full')) {
                                toggleMobile();
                            }
                        }
                    }
                });
            });

            // Navbar shadow on scroll (throttle for perf)
            const navbar = document.getElementById('navbar');
            let lastScrollY = window.scrollY;
            let ticking = false;
            window.addEventListener('scroll', () => {
                lastScrollY = window.scrollY;
                if (!ticking) {
                    window.requestAnimationFrame(() => {
                        if (lastScrollY > 10) navbar.classList.add('nav-scrolled');
                        else navbar.classList.remove('nav-scrolled');
                        ticking = false;
                    });
                    ticking = true;
                }
            }, { passive: true });

            // Global Visibility API (Pause GSAP / animations when tab changes)
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    gsap.globalTimeline.pause(); // Pause all active animations
                } else {
                    gsap.globalTimeline.play();
                }
            });

            // Global Lightbox Logic
            const lightbox = document.getElementById('global-lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxIframe = document.getElementById('lightbox-iframe');
            const lightboxLoader = document.getElementById('lightbox-loader');
            const lightboxClose = document.getElementById('lightbox-close');

            const openLightbox = (src, isImage) => {
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                
                requestAnimationFrame(() => {
                    lightbox.classList.remove('opacity-0');
                    lightbox.classList.add('opacity-100');
                });

                lightboxLoader.classList.remove('hidden');
                lightboxImg.classList.add('hidden');
                lightboxIframe.classList.add('hidden');
                lightboxImg.classList.remove('scale-100');
                lightboxIframe.classList.remove('scale-100');

                if (isImage) {
                    lightboxImg.onload = () => {
                        lightboxLoader.classList.add('hidden');
                        lightboxImg.classList.remove('hidden');
                        requestAnimationFrame(() => lightboxImg.classList.add('scale-100'));
                    };
                    lightboxImg.src = src;
                } else {
                    lightboxIframe.onload = () => {
                        lightboxLoader.classList.add('hidden');
                        lightboxIframe.classList.remove('hidden');
                        requestAnimationFrame(() => lightboxIframe.classList.add('scale-100'));
                    };
                    lightboxIframe.src = src;
                }
            };

            const closeLightboxHandler = () => {
                lightbox.classList.remove('opacity-100');
                lightbox.classList.add('opacity-0');
                lightboxImg.classList.remove('scale-100');
                lightboxIframe.classList.remove('scale-100');
                setTimeout(() => {
                    lightbox.classList.add('hidden');
                    lightbox.classList.remove('flex');
                    lightboxImg.src = '';
                    lightboxIframe.src = '';
                }, 300);
            };

            lightboxClose.addEventListener('click', closeLightboxHandler);
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox || e.target.parentElement === lightbox) {
                    closeLightboxHandler();
                }
            });

            document.addEventListener('click', (e) => {
                const img = e.target.closest('img');
                const link = e.target.closest('a');

                if (img) {
                    if (img.closest('nav') || img.classList.contains('no-lightbox')) return;
                    if (img.src && img.src.includes('storage')) {
                        e.preventDefault();
                        openLightbox(img.src, true); 
                    }
                } else if (link && link.href && link.href.includes('storage')) {
                    // Check if it's an image or other format based on URL
                    const isImage = link.href.match(/\.(jpeg|jpg|gif|png|webp|svg|bmp)$/i) != null;
                    const isPreviewable = link.href.match(/\.(pdf)$/i) != null || isImage;
                    
                    if (isPreviewable && link.target !== '_blank') {
                        e.preventDefault();
                        openLightbox(link.href, isImage);
                    }
                }
            });
        });
    </script>
    
    <div id="global-lightbox" class="fixed inset-0 z-[10000] hidden items-center justify-center bg-slate-900/95 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <button id="lightbox-close" class="absolute top-6 right-6 text-white/70 hover:text-white bg-white/10 hover:bg-white/20 p-2 rounded-full transition-colors z-[10001]">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        <div class="relative w-full max-w-5xl max-h-[90vh] mx-4 flex items-center justify-center p-4">
            <div id="lightbox-loader" class="absolute inset-0 flex items-center justify-center hidden">
                <svg class="animate-spin h-10 w-10 text-white" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                </svg>
            </div>
            <img id="lightbox-img" class="max-w-full max-h-[85vh] object-contain hidden rounded-lg shadow-2xl scale-95 transition-transform duration-300" src="" alt="Preview">
            <iframe id="lightbox-iframe" class="w-full h-[85vh] hidden bg-white rounded-lg shadow-2xl scale-95 transition-transform duration-300" src=""></iframe>
        </div>
    </div>
</body>
</html>
