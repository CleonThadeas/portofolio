@extends('layouts.admin')
@section('title', 'View Message')

@section('content')
<div class="max-w-2xl">
    <div class="mb-6"><a href="{{ route('admin.messages.index') }}" class="text-sm text-slate-400 hover:text-white transition">&larr; Back to Messages</a></div>

    <div class="bg-slate-900 rounded-xl border border-slate-800/50 p-6">
        <div class="flex items-start justify-between mb-6">
            <div>
                <h2 class="text-xl font-bold text-white">{{ $message->subject ?: 'No Subject' }}</h2>
                <p class="text-sm text-slate-400 mt-1">From <span class="text-white">{{ $message->name }}</span> &lt;{{ $message->email }}&gt;</p>
                <p class="text-xs text-slate-500 mt-1">{{ $message->created_at->format('M d, Y \a\t H:i') }}</p>
            </div>
            <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-400 hover:text-red-300 text-sm transition">Delete</button>
            </form>
        </div>

        <hr class="border-slate-800 mb-4">

        <div class="text-slate-300 leading-relaxed whitespace-pre-wrap">{{ $message->body }}</div>

        <hr class="border-slate-800 my-6">

        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l9-6 9 6-9 6-9-6zm0 0v6l9 6 9-6v-6"/></svg>
            Reply via Email
        </a>
    </div>
</div>
@endsection
