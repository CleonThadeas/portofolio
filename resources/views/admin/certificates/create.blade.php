@extends('layouts.admin')
@section('title', 'Create Certificate')

@section('content')
<div class="max-w-xl">
    <div class="mb-6"><a href="{{ route('admin.certificates.index') }}" class="text-sm text-slate-400 hover:text-white transition">&larr; Back to Certificates</a></div>
    <div class="bg-slate-900 rounded-xl border border-slate-800/50 p-6">
        <h2 class="text-xl font-bold text-white mb-6">Create New Certificate</h2>
        <form method="POST" action="{{ route('admin.certificates.store') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-slate-400 mb-1.5">Certificate Name *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
            </div>
            <div>
                <label for="issuer" class="block text-sm font-medium text-slate-400 mb-1.5">Issuer</label>
                <input type="text" id="issuer" name="issuer" value="{{ old('issuer') }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
            </div>
            <div>
                <label for="date" class="block text-sm font-medium text-slate-400 mb-1.5">Date</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-slate-400 mb-1.5">Description</label>
                <textarea id="description" name="description" rows="3" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">{{ old('description') }}</textarea>
            </div>
            <div>
                <label for="file" class="block text-sm font-medium text-slate-400 mb-1.5">File (Image or PDF)</label>
                <input type="file" id="file" name="file" accept="image/*,.pdf" class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-800 file:text-slate-300 hover:file:bg-slate-700 transition">
            </div>
            <div class="flex items-center gap-3 pt-4">
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">Create Certificate</button>
                <a href="{{ route('admin.certificates.index') }}" class="px-6 py-2.5 rounded-lg bg-slate-800 text-slate-400 text-sm hover:text-white transition">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
