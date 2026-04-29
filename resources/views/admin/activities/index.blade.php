@extends('layouts.admin')
@section('title', 'Manage Activities')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-white">Activities</h2>
    <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Activity
    </a>
</div>

<div class="bg-slate-900 rounded-xl border border-slate-800/50 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-800/50">
            <tr>
                <th class="text-left px-4 py-3 text-slate-400 font-medium">Title</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium hidden sm:table-cell">Type</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium hidden sm:table-cell">Date</th>
                <th class="text-center px-4 py-3 text-slate-400 font-medium">Docs</th>
                <th class="text-right px-4 py-3 text-slate-400 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800/50">
            @forelse ($activities as $activity)
                <tr class="hover:bg-slate-800/30 transition">
                    <td class="px-4 py-3 text-white font-medium">
                        {{ $activity->title }}
                        @if($activity->is_featured)
                            <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-blue-500/20 text-blue-400 border border-blue-500/30">Featured</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 hidden sm:table-cell"><span class="text-xs px-2 py-0.5 rounded bg-slate-800 text-slate-400">{{ $activity->type ?? '-' }}</span></td>
                    <td class="px-4 py-3 text-slate-400 text-xs hidden sm:table-cell">{{ $activity->date ? $activity->date->format('M d, Y') : '-' }}</td>
                    <td class="px-4 py-3 text-center text-xs text-slate-400">{{ count($activity->documentation ?? []) }}</td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.activities.edit', $activity) }}" class="text-blue-400 hover:text-blue-300 text-xs">Edit</a>
                            <form method="POST" action="{{ route('admin.activities.destroy', $activity) }}" onsubmit="return confirm('Delete this activity?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-xs">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">No activities yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $activities->links() }}</div>
@endsection
