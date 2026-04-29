<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::latest('date')->paginate(10);
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'documentation.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $docs = [];
        if ($request->hasFile('documentation')) {
            foreach ($request->file('documentation') as $file) {
                $docs[] = $file->store('activities', 'public');
            }
        }
        $validated['documentation'] = $docs;

        $validated['is_featured'] = $request->boolean('is_featured');

        Activity::create($validated);

        return redirect()->route('admin.activities.index')->with('success', 'Activity created successfully.');
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.edit', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'documentation.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $docs = $activity->documentation ?? [];
        if ($request->hasFile('documentation')) {
            foreach ($request->file('documentation') as $file) {
                $docs[] = $file->store('activities', 'public');
            }
        }

        // Remove selected images
        if ($request->has('remove_docs')) {
            foreach ($request->remove_docs as $path) {
                Storage::disk('public')->delete($path);
                $docs = array_values(array_filter($docs, fn($d) => $d !== $path));
            }
        }

        $validated['documentation'] = $docs;

        $validated['is_featured'] = $request->boolean('is_featured');

        $activity->update($validated);

        return redirect()->route('admin.activities.index')->with('success', 'Activity updated successfully.');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->documentation) {
            foreach ($activity->documentation as $path) {
                Storage::disk('public')->delete($path);
            }
        }
        $activity->delete();

        return redirect()->route('admin.activities.index')->with('success', 'Activity deleted successfully.');
    }
}
