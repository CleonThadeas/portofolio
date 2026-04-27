@extends('layouts.admin')
@section('title', 'Edit Skill')

@section('content')
<div class="max-w-xl">
    <div class="mb-6"><a href="{{ route('admin.skills.index') }}" class="text-sm text-slate-400 hover:text-white transition">&larr; Back to Skills</a></div>
    <div class="bg-slate-900 rounded-xl border border-slate-800/50 p-6">
        <h2 class="text-xl font-bold text-white mb-6">Edit Skill</h2>
        <form method="POST" action="{{ route('admin.skills.update', $skill) }}" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label for="name" class="block text-sm font-medium text-slate-400 mb-1.5">Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $skill->name) }}" required class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
            </div>
            <div>
                <label for="category" class="block text-sm font-medium text-slate-400 mb-1.5">Category</label>
                <input type="text" id="category" name="category" value="{{ old('category', $skill->category) }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
            </div>
            <div>
                <label for="level" class="block text-sm font-medium text-slate-400 mb-1.5">Level (1-100) *</label>
                <input type="number" id="level" name="level" value="{{ old('level', $skill->level) }}" min="1" max="100" required class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
            </div>
            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">Update Skill</button>
                <a href="{{ route('admin.skills.index') }}" class="px-6 py-2.5 rounded-lg bg-slate-800 text-slate-400 text-sm hover:text-white transition">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
