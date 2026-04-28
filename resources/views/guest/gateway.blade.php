@extends('layouts.guest')
@section('title', 'Security Checkpoint')

@section('content')
<!-- Custom style block specifically to ensure absolute overlay hides everything else -->
<style>
    /* Hide usual layout noise globally while in gateway */
    nav, footer { display: none !important; }
    html, body { overflow: hidden !important; }
</style>

<div class="fixed inset-0 z-[9999] bg-[#0A0F1A] flex items-center justify-center flex-col overflow-hidden m-0 p-0">
    <!-- Ambient Pixel Grid & Lights -->
    <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle at 50% 0%, rgba(34, 211, 238, 0.4) 0%, transparent 65%);"></div>
    <div class="absolute inset-0 opacity-10" style="background-image: linear-gradient(to right, currentColor 1px, transparent 1px), linear-gradient(to bottom, currentColor 1px, transparent 1px); background-size: 32px 32px; color: #3b82f6;"></div>

    <div class="relative z-10 glass-card bg-[#0F172A]/80 backdrop-blur-2xl border border-blue-500/20 shadow-[0_0_50px_rgba(59,130,246,0.15)] rounded-3xl p-5 sm:p-12 flex flex-col items-center max-w-md w-[95%] sm:w-full mx-auto text-center transform hover:scale-[1.01] transition-transform duration-500">
        
        <div class="w-20 h-20 bg-blue-500/10 rounded-[1.5rem] flex items-center justify-center mb-8 border border-blue-500/30 text-blue-400 group-hover:scale-110 transition-transform duration-500">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
        </div>
        
        <h1 class="text-3xl sm:text-4xl font-black font-heading text-white mb-2 tracking-tight drop-shadow-sm">Verification Area</h1>
        <p class="text-slate-400 text-sm mb-10 leading-relaxed font-light">Checking your connection securely before granting access to <br><span class="text-cyan-400 font-bold inline-block mt-1 bg-cyan-400/10 px-2 py-0.5 rounded">andrixlab.ct.ws</span></p>

        <form action="{{ route('gateway.verify') }}" method="POST" id="verify-form" class="w-full flex flex-col items-center relative">
            @csrf
            
            @if($errors->any())
                <div class="text-rose-400 text-xs mb-6 p-4 bg-rose-500/10 rounded-xl border border-rose-500/20 w-full text-center flex items-center gap-2 justify-center font-medium">
                    <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <div class="bg-[#1E293B] p-1.5 sm:p-2.5 rounded-2xl mb-8 flex justify-center w-full overflow-hidden shadow-inner border border-slate-700/50">
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}" data-theme="dark" data-callback="onRecaptchaSuccess"></div>
            </div>

            <button type="submit" id="submit-btn" disabled class="w-full py-4 px-6 bg-slate-800/80 text-slate-500 rounded-2xl font-bold transition-all duration-500 border border-slate-700/50 cursor-not-allowed flex justify-center items-center gap-3 backdrop-blur-sm">
                <span id="btn-text">Waiting for verification...</span>
                <svg id="btn-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </form>
    </div>

    <p class="text-slate-600/80 text-xs mt-10 relative z-10 flex items-center justify-center gap-2 font-medium tracking-wide">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
        Protected by reCAPTCHA, Google Privacy Policy applies.
    </p>
</div>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    function onRecaptchaSuccess() {
        const btn = document.getElementById('submit-btn');
        btn.disabled = false;
        btn.classList.remove('bg-slate-800/80', 'text-slate-500', 'border-slate-700/50', 'cursor-not-allowed');
        btn.classList.add('bg-gradient-to-r', 'from-blue-600', 'to-cyan-600', 'text-white', 'border-none', 'hover:scale-[1.02]', 'shadow-[0_0_20px_rgba(37,99,235,0.4)]');
        document.getElementById('btn-text').innerText = 'Proceed to Portfolio View';
        document.getElementById('btn-icon').classList.remove('hidden');
        
        // Auto submit for seamless experience
        setTimeout(() => document.getElementById('verify-form').submit(), 800);
    }
</script>
@endsection
