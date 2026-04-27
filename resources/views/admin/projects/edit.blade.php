@extends('layouts.admin')
@section('title', 'Edit Project')

@section('content')
<div class="max-w-3xl">
    <div class="mb-6">
        <a href="{{ route('admin.projects.index') }}" class="text-sm text-slate-400 hover:text-white transition">&larr; Back to Projects</a>
    </div>

    <div class="bg-slate-900 rounded-xl border border-slate-800/50 p-6">
        <h2 class="text-xl font-bold text-white mb-6">Edit Project</h2>

        <form method="POST" action="{{ route('admin.projects.update', $project) }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="sm:col-span-2">
                    <label for="title" class="block text-sm font-medium text-slate-400 mb-1.5">Title *</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}" required
                           class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                </div>
                <div class="sm:col-span-2">
                    <label for="slug" class="block text-sm font-medium text-slate-400 mb-1.5">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $project->slug) }}"
                           class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                </div>
                <div class="sm:col-span-2">
                    <label for="short_description" class="block text-sm font-medium text-slate-400 mb-1.5">Short Description</label>
                    <input type="text" id="short_description" name="short_description" value="{{ old('short_description', $project->short_description) }}"
                           class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block text-sm font-medium text-slate-400 mb-1.5">Full Description</label>
                    <textarea id="description" name="description" rows="5"
                              class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">{{ old('description', $project->description) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label for="tech_stack" class="block text-sm font-medium text-slate-400 mb-1.5">Tech Stack (comma separated)</label>
                    <input type="text" id="tech_stack" name="tech_stack" value="{{ old('tech_stack', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : $project->tech_stack) }}"
                           class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="demo_link" class="block text-sm font-medium text-slate-400 mb-1.5">Demo Link</label>
                    <input type="url" id="demo_link" name="demo_link" value="{{ old('demo_link', $project->demo_link) }}"
                           class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                </div>
                <div>
                    <label for="repo_link" class="block text-sm font-medium text-slate-400 mb-1.5">Repository Link</label>
                    <input type="url" id="repo_link" name="repo_link" value="{{ old('repo_link', $project->repo_link) }}"
                           class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                </div>
                <div class="sm:col-span-2">
                    <label for="thumbnail" class="block text-sm font-medium text-slate-400 mb-1.5">Thumbnail</label>
                    @if ($project->thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $project->thumbnail) }}" alt="Current thumbnail" class="w-32 h-20 object-cover rounded-lg">
                        </div>
                    @endif
                    <input type="file" id="thumbnail" name="thumbnail" accept="image/*"
                           class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-800 file:text-slate-300 hover:file:bg-slate-700 transition">
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-slate-400 mb-1.5">Sort Order</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $project->sort_order) }}"
                           class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                </div>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', $project->is_published) ? 'checked' : '' }}
                           class="w-4 h-4 rounded bg-slate-800 border-slate-600 text-blue-500 focus:ring-blue-500">
                    <span class="text-sm text-slate-400">Publish</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                           class="w-4 h-4 rounded bg-slate-800 border-slate-600 text-amber-500 focus:ring-amber-500">
                    <span class="text-sm text-slate-400">Featured</span>
                </label>
            </div>

            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">Update Project</button>
                <a href="{{ route('admin.projects.index') }}" class="px-6 py-2.5 rounded-lg bg-slate-800 text-slate-400 text-sm hover:text-white transition">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
