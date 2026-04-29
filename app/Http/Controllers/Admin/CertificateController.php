<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::latest('date')->paginate(10);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,webp|max:5120',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $validated['file_path'] = $file->store('certificates', 'public');
            $validated['file_type'] = $file->getClientOriginalExtension();
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        Certificate::create($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate created successfully.');
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'nullable|string|max:255',
            'date' => 'nullable|date',
            'description' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,webp|max:5120',
        ]);

        if ($request->hasFile('file')) {
            if ($certificate->file_path) {
                Storage::disk('public')->delete($certificate->file_path);
            }
            $file = $request->file('file');
            $validated['file_path'] = $file->store('certificates', 'public');
            $validated['file_type'] = $file->getClientOriginalExtension();
        }

        $validated['is_featured'] = $request->boolean('is_featured');

        $certificate->update($validated);

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate updated successfully.');
    }

    public function destroy(Certificate $certificate)
    {
        if ($certificate->file_path) {
            Storage::disk('public')->delete($certificate->file_path);
        }
        $certificate->delete();

        return redirect()->route('admin.certificates.index')->with('success', 'Certificate deleted successfully.');
    }
}
