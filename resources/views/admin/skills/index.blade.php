@extends('layouts.admin')
@section('title', 'Manage Skills')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-white">Skills</h2>
    <a href="{{ route('admin.skills.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Skill
    </a>
</div>

<div class="bg-slate-900 rounded-xl border border-slate-800/50 overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-800/50">
            <tr>
                <th class="text-left px-4 py-3 text-slate-400 font-medium">Name</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium">Category</th>
                <th class="text-left px-4 py-3 text-slate-400 font-medium">Level</th>
                <th class="text-right px-4 py-3 text-slate-400 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-800/50">
            @forelse ($skills as $skill)
                <tr class="hover:bg-slate-800/30 transition">
                    <td class="px-4 py-3 text-white font-medium">{{ $skill->name }}</td>
                    <td class="px-4 py-3"><span class="text-xs px-2 py-0.5 rounded bg-slate-800 text-slate-400">{{ $skill->category ?? 'Uncategorized' }}</span></td>
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-2">
                            <div class="w-24 h-2 bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-500 rounded-full" style="width: {{ $skill->level }}%"></div>
                            </div>
                            <span class="text-xs text-slate-400">{{ $skill->level }}%</span>
                        </div>
                    </td>
                    <td class="px-4 py-3">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.skills.edit', $skill) }}" class="text-blue-400 hover:text-blue-300 text-xs">Edit</a>
                            <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" onsubmit="return confirm('Delete this skill?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300 text-xs">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-4 py-8 text-center text-slate-500">No skills yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $skills->links() }}</div>
@endsection
