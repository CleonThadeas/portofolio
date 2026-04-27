@extends('layouts.admin')
@section('title', 'Manage Projects')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-xl font-bold text-white">Projects</h2>
    <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white text-sm hover:bg-blue-700 transition">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Project
    </a>
</div>

<div class="bg-slate-900 rounded-xl border border-slate-800/50 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-800/50">
                <tr>
                    <th class="text-left px-4 py-3 text-slate-400 font-medium">Title</th>
                    <th class="text-left px-4 py-3 text-slate-400 font-medium hidden sm:table-cell">Tech Stack</th>
                    <th class="text-center px-4 py-3 text-slate-400 font-medium">Status</th>
                    <th class="text-center px-4 py-3 text-slate-400 font-medium">Featured</th>
                    <th class="text-right px-4 py-3 text-slate-400 font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/50">
                @forelse ($projects as $project)
                    <tr class="hover:bg-slate-800/30 transition">
                        <td class="px-4 py-3">
                            <p class="text-white font-medium">{{ $project->title }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ Str::limit($project->short_description, 60) }}</p>
                        </td>
                        <td class="px-4 py-3 hidden sm:table-cell">
                            <div class="flex flex-wrap gap-1">
                                @foreach (($project->tech_stack ?? []) as $tech)
                                    <span class="text-xs px-2 py-0.5 rounded bg-slate-800 text-slate-400">{{ $tech }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <form method="POST" action="{{ route('admin.projects.toggle-publish', $project) }}" class="inline">
                                @csrf @method('PATCH')
                                <button type="submit" class="text-xs px-2.5 py-1 rounded-full {{ $project->is_published ? 'bg-emerald-500/10 text-emerald-400' : 'bg-slate-700 text-slate-400' }} hover:opacity-80 transition">
                                    {{ $project->is_published ? 'Published' : 'Draft' }}
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if ($project->is_featured)
                                <span class="text-amber-400">★</span>
                            @else
                                <span class="text-slate-600">☆</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.projects.edit', $project) }}" class="text-blue-400 hover:text-blue-300 transition text-xs">Edit</a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Delete this project?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-300 transition text-xs">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">No projects yet. Create your first project!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $projects->links() }}
</div>
@endsection
