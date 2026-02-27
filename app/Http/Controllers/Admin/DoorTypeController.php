<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoorType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DoorTypeController extends Controller
{
    public function index()
    {
        $doorTypes = DoorType::notDeleted()
            ->withCount(['activeDoorModels'])
            ->orderBy('name')
            ->get();

        return view('admin.door-types.index', compact('doorTypes'));
    }

    public function recycle()
    {
        // Hanya tampilkan status 1 (soft delete), status 2 tidak ditampilkan
        $doorTypes = DoorType::where('deleted_status', 1)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.door-types.recycle', compact('doorTypes'));
    }

    public function create()
    {
        return view('admin.door-types.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $base  = $validated['slug'];
        $count = 1;
        while (DoorType::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $base . '-' . $count++;
        }

        $doorType = new DoorType($validated);

        if ($request->hasFile('image')) {
            $doorType->image = $request->file('image')
                ->store('door-types', 'public');
        }

        $doorType->save();

        return redirect()->route('admin.door-types.index')
            ->with('success', 'Door type created successfully.');
    }

    public function edit(DoorType $doorType)
    {
        return view('admin.door-types.edit', compact('doorType'));
    }

    public function update(Request $request, DoorType $doorType)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'description' => 'nullable|string',
        ]);

        $newSlug = Str::slug($validated['name']);
        if ($newSlug !== $doorType->slug) {
            $base  = $newSlug;
            $count = 1;
            while (DoorType::where('slug', $newSlug)->where('id', '!=', $doorType->id)->exists()) {
                $newSlug = $base . '-' . $count++;
            }
            $validated['slug'] = $newSlug;
        }

        $doorType->update($validated);

        if ($request->hasFile('image')) {
            if ($doorType->image) {
                Storage::disk('public')->delete($doorType->image);
            }
            $doorType->image = $request->file('image')->store('door-types', 'public');
            $doorType->save();
        }

        return redirect()->route('admin.door-types.index')
            ->with('success', 'Door type updated successfully.');
    }

    public function destroy(DoorType $doorType)
    {
        $doorType->update(['deleted_status' => 1]);

        return redirect()->route('admin.door-types.index')
            ->with('success', 'Door type deleted.');
    }

    public function restore(DoorType $doorType)
    {
        $doorType->update(['deleted_status' => 0]);

        return redirect()->route('admin.door-types.recycle')
            ->with('success', 'Door type restored.');
    }

    public function forceDelete(DoorType $doorType)
    {
        $doorType->update(['deleted_status' => 2]);

        return redirect()->route('admin.door-types.recycle')
            ->with('success', 'Door type permanently deleted.');
    }
}
