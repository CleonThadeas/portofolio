@extends('layouts.admin')
@section('title', 'Manage Experience')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-white">Experience</h2>
    <a href="{{ route('admin.experiences.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Experience
    </a>
</div>

<div class="bg-slate-900 rounded-xl border border-slate-800/50 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-800/50">
            <tr>
                <th class="text-left px-4 py-3 text-slate-400 font-medium">Position</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium hidden sm:table-cell">Organization</th>
                <th class="text-center px-4 py-3 text-slate-400 font-medium">Type</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium hidden sm:table-cell">Period</th>
                <th class="text-right px-4 py-3 text-slate-400 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800/50">
            @forelse ($experiences as $exp)
                <tr class="hover:bg-slate-800/30 transition">
                    <td class="px-4 py-3">
                        <p class="text-white font-medium">{{ $exp->position }}</p>
                        <p class="text-xs text-slate-500 sm:hidden">{{ $exp->organization }}</p>
                    </td>
                    <td class="px-4 py-3 text-slate-400 hidden sm:table-cell">{{ $exp->organization }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="text-xs px-2 py-0.5 rounded {{ $exp->type === 'work' ? 'bg-blue-500/10 text-blue-400' : 'bg-violet-500/10 text-violet-400' }}">
                            {{ ucfirst($exp->type) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-slate-400 text-xs hidden sm:table-cell">
                        {{ $exp->start_date->format('M Y') }} - {{ $exp->is_current ? 'Present' : ($exp->end_date ? $exp->end_date->format('M Y') : '-') }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.experiences.edit', $exp) }}" class="text-blue-400 hover:text-blue-300 text-xs">Edit</a>
                            <form method="POST" action="{{ route('admin.experiences.destroy', $exp) }}" onsubmit="return confirm('Delete this experience?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-xs">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-8 text-center text-slate-500">No experiences yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $experiences->links() }}</div>
@endsection
