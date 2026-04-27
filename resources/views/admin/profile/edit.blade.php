@extends('layouts.admin')
@section('title', 'Edit Profile')

@section('content')
<div class="max-w-3xl">
    <div class="bg-slate-900 rounded-xl border border-slate-800/50 p-6">
        <h2 class="text-xl font-bold text-white mb-6">Edit Profile</h2>
        <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data" class="space-y-5">
            @csrf @method('PUT')

            @if ($profile->photo)
                <div class="flex items-center gap-4">
                    <img src="{{ asset('storage/' . $profile->photo) }}" alt="Profile" class="w-20 h-20 rounded-full object-cover">
                    <div>
                        <p class="text-sm text-slate-400">Current photo</p>
                        <p class="text-xs text-slate-600">Upload a new image below to replace</p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div><label for="name" class="block text-sm font-medium text-slate-400 mb-1.5">Name *</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $profile->name) }}" required class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
                <div><label for="headline" class="block text-sm font-medium text-slate-400 mb-1.5">Headline</label>
                    <input type="text" id="headline" name="headline" value="{{ old('headline', $profile->headline) }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
                <div class="sm:col-span-2"><label for="bio" class="block text-sm font-medium text-slate-400 mb-1.5">Bio</label>
                    <textarea id="bio" name="bio" rows="4" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition">{{ old('bio', $profile->bio) }}</textarea></div>
                <div><label for="email" class="block text-sm font-medium text-slate-400 mb-1.5">Contact Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $profile->email) }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
                <div><label for="phone" class="block text-sm font-medium text-slate-400 mb-1.5">Phone Number</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
                <div class="sm:col-span-2"><label for="photo" class="block text-sm font-medium text-slate-400 mb-1.5">Profile Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" class="w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-slate-800 file:text-slate-300 hover:file:bg-slate-700 transition"></div>
            </div>

            <hr class="border-slate-800">
            <h3 class="text-base font-semibold text-white">Social Links</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div><label for="social_github" class="block text-sm font-medium text-slate-400 mb-1.5">GitHub</label>
                    <input type="url" id="social_github" name="social_github" value="{{ old('social_github', $profile->social_links['github'] ?? '') }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
                <div><label for="social_linkedin" class="block text-sm font-medium text-slate-400 mb-1.5">LinkedIn</label>
                    <input type="url" id="social_linkedin" name="social_linkedin" value="{{ old('social_linkedin', $profile->social_links['linkedin'] ?? '') }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
                <div><label for="social_instagram" class="block text-sm font-medium text-slate-400 mb-1.5">Instagram</label>
                    <input type="url" id="social_instagram" name="social_instagram" value="{{ old('social_instagram', $profile->social_links['instagram'] ?? '') }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
                <div><label for="social_twitter" class="block text-sm font-medium text-slate-400 mb-1.5">Twitter/X</label>
                    <input type="url" id="social_twitter" name="social_twitter" value="{{ old('social_twitter', $profile->social_links['twitter'] ?? '') }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
                <div class="sm:col-span-2"><label for="social_website" class="block text-sm font-medium text-slate-400 mb-1.5">Website</label>
                    <input type="url" id="social_website" name="social_website" value="{{ old('social_website', $profile->social_links['website'] ?? '') }}" class="w-full px-4 py-2.5 rounded-lg bg-slate-800 border border-slate-700 text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition"></div>
            </div>

            <div class="pt-4">
                <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 transition">Update Profile</button>
            </div>
        </form>
    </div>
</div>
@endsection
