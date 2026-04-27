@extends('layouts.admin')
@section('title', 'Messages')

@section('content')
<h2 class="text-xl font-bold text-white mb-6">Messages</h2>

<div class="bg-slate-900 rounded-xl border border-slate-800/50 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-800/50">
            <tr>
                <th class="text-left px-4 py-3 text-slate-400 font-medium">From</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium hidden sm:table-cell">Subject</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium hidden sm:table-cell">Date</th>
                <th class="text-center px-4 py-3 text-slate-400 font-medium">Status</th>
                <th class="text-right px-4 py-3 text-slate-400 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800/50">
            @forelse ($messages as $msg)
                <tr class="hover:bg-slate-800/30 transition {{ !$msg->is_read ? 'bg-blue-500/5' : '' }}">
                    <td class="px-4 py-3">
                        <p class="text-white font-medium {{ !$msg->is_read ? 'font-bold' : '' }}">{{ $msg->name }}</p>
                        <p class="text-xs text-slate-500">{{ $msg->email }}</p>
                    </td>
                    <td class="px-4 py-3 text-slate-400 hidden sm:table-cell">{{ Str::limit($msg->subject ?: 'No Subject', 40) }}</td>
                    <td class="px-4 py-3 text-slate-400 text-xs hidden sm:table-cell">{{ $msg->created_at->diffForHumans() }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="text-xs px-2 py-0.5 rounded-full {{ $msg->is_read ? 'bg-slate-700 text-slate-400' : 'bg-blue-500/10 text-blue-400' }}">
                            {{ $msg->is_read ? 'Read' : 'New' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.messages.show', $msg) }}" class="text-blue-400 hover:text-blue-300 text-xs">View</a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" onsubmit="return confirm('Delete this message?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-xs">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">No messages yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $messages->links() }}</div>
@endsection
