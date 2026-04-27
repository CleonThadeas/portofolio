@extends('layouts.admin')
@section('title', 'Edit Experience')

@section('content')
<div class="max-w-xl">
    <div class="mb-6"><a href="{{ route('admin.experiences.index') }}" class="text-sm text-slate-400 hover:text-white transition">&larr; Back to Experience</a></div>
    <div class="bg-slate-900 rounded-xl border border-slate-800/50 p-6">
        <h2 class="text-xl font-bold text-white mb-6">Edit Experience</h2>
        <form method="POST" action="{{ route('admin.experiences.update', $experience) }}" class="space-y-5">
            @csrf @method('PUT')
            <div><label for="position" class="block text-sm font-medium text-slate-400 mb-1.5">Position *</label>
                <input type="text" id="position" name="position" value="{{ old('position', $experience->position) }}" required class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
            <div><label for="organization" class="block text-sm font-medium text-slate-400 mb-1.5">Organization *</label>
                <input type="text" id="organization" name="organization" value="{{ old('organization', $experience->organization) }}" required class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
            <div><label for="type" class="block text-sm font-medium text-slate-400 mb-1.5">Type *</label>
                <select id="type" name="type" required class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
                    <option value="work" {{ old('type', $experience->type) === 'work' ? 'selected' : '' }}>Work</option>
                    <option value="organization" {{ old('type', $experience->type) === 'organization' ? 'selected' : '' }}>Organization</option>
                    <option value="study" {{ old('type', $experience->type) === 'study' ? 'selected' : '' }}>Study</option>
                </select></div>
            <div class="grid grid-cols-2 gap-4">
                <div><label for="start_date" class="block text-sm font-medium text-slate-400 mb-1.5">Start Date *</label>
                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $experience->start_date->format('Y-m-d')) }}" required class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
                <div><label for="end_date" class="block text-sm font-medium text-slate-400 mb-1.5">End Date</label>
                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $experience->end_date?->format('Y-m-d')) }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
            </div>
            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_current" value="1" {{ old('is_current', $experience->is_current) ? 'checked' : '' }} class="w-4 h-4 rounded bg-slate-800 border-slate-600 text-blue-500 focus:ring-blue-500">
                <span class="text-sm text-slate-400">Currently working here</span>
            </label>
            <div><label for="description" class="block text-sm font-medium text-slate-400 mb-1.5">Description</label>
                <textarea id="description" name="description" rows="3" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">{{ old('description', $experience->description) }}</textarea></div>
            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">Update Experience</button>
                <a href="{{ route('admin.experiences.index') }}" class="px-6 py-2.5 rounded-lg bg-slate-800 text-slate-400 text-sm hover:text-white transition">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
