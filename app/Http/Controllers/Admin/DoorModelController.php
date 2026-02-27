<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DoorModel;
use App\Models\DoorType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DoorModelController extends Controller
{
    public function index()
    {
        $doorModels = DoorModel::notDeleted()
            ->with('doorType')
            ->orderBy('door_base_name')
            ->orderBy('handle_code')
            ->paginate(20);

        return view('admin.door-models.index', compact('doorModels'));
    }

    public function recycle()
    {
        // Hanya tampilkan status 1 (soft delete), status 2 tidak ditampilkan
        $doorModels = DoorModel::where('deleted_status', 1)
            ->with('doorType')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.door-models.recycle', compact('doorModels'));
    }

    public function create()
    {
        $doorTypes = DoorType::notDeleted()->orderBy('name')->get();
        return view('admin.door-models.create', compact('doorTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'door_type_id'    => 'required|exists:door_types,id',
            'door_base_name'  => 'required|string|max:255',
            'handle_name'     => 'required|string|max:255',
            'handle_code'     => 'required|string|max:20',
            'model_file'      => 'required|file|max:102400',
            'catalog_image'   => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'viewer_thumbnail'=> 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'model_complexity'=> 'required|in:low,medium,high',
            'description'     => 'nullable|string',
            'status'          => 'required|boolean',
        ]);

        $validated['slug'] = DoorModel::generateSlug(
            $validated['door_base_name'],
            $validated['handle_name'],
            $validated['handle_code']
        );

        $doorModel = new DoorModel($validated);

        // Upload 3D model
        if ($request->hasFile('model_file')) {
            $file                       = $request->file('model_file');
            $ext                        = $file->getClientOriginalExtension() ?: 'glb';
            $filename                   = \Illuminate\Support\Str::random(40) . '.' . $ext;
            $doorModel->model_file      = $file->storeAs('door-models/3d', $filename, 'public');
            $doorModel->model_file_size = $file->getSize();
        }

        // Upload catalog image
        if ($request->hasFile('catalog_image')) {
            $doorModel->catalog_image = $request->file('catalog_image')
                ->store('door-models/catalog', 'public');
        }

        // Upload viewer thumbnail (fallback ke catalog image)
        if ($request->hasFile('viewer_thumbnail')) {
            $doorModel->viewer_thumbnail = $request->file('viewer_thumbnail')
                ->store('door-models/thumbnails', 'public');
        } else {
            $doorModel->viewer_thumbnail = $doorModel->catalog_image;
        }

        $doorModel->save();

        return redirect()->route('admin.door-models.index')
            ->with('success', 'Door model created successfully.');
    }

    public function edit(DoorModel $doorModel)
    {
        $doorTypes = DoorType::notDeleted()->orderBy('name')->get();
        return view('admin.door-models.edit', compact('doorModel', 'doorTypes'));
    }

    public function update(Request $request, DoorModel $doorModel)
    {
        $validated = $request->validate([
            'door_type_id'    => 'required|exists:door_types,id',
            'door_base_name'  => 'required|string|max:255',
            'handle_name'     => 'required|string|max:255',
            'handle_code'     => 'required|string|max:20',
            'model_file'      => 'nullable|file|max:102400',
            'catalog_image'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'viewer_thumbnail'=> 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'model_complexity'=> 'required|in:low,medium,high',
            'description'     => 'nullable|string',
            'status'          => 'required|boolean',
        ]);

        // Regenerate slug, exclude self
        $base  = \Illuminate\Support\Str::slug("{$validated['door_base_name']} {$validated['handle_name']} {$validated['handle_code']}");
        $slug  = $base;
        $count = 1;
        while (DoorModel::where('slug', $slug)->where('id', '!=', $doorModel->id)->exists()) {
            $slug = $base . '-' . $count++;
        }
        $validated['slug'] = $slug;

        $doorModel->update($validated);

        // Replace 3D model
        if ($request->hasFile('model_file')) {
            if ($doorModel->model_file) {
                Storage::disk('public')->delete($doorModel->model_file);
            }
            $file                       = $request->file('model_file');
            $ext                        = $file->getClientOriginalExtension() ?: 'glb';
            $filename                   = \Illuminate\Support\Str::random(40) . '.' . $ext;
            $doorModel->model_file      = $file->storeAs('door-models/3d', $filename, 'public');
            $doorModel->model_file_size = $file->getSize();
        }

        // Replace catalog image
        if ($request->hasFile('catalog_image')) {
            if ($doorModel->catalog_image) {
                Storage::disk('public')->delete($doorModel->catalog_image);
            }
            $doorModel->catalog_image = $request->file('catalog_image')
                ->store('door-models/catalog', 'public');
        }

        // Replace viewer thumbnail
        if ($request->hasFile('viewer_thumbnail')) {
            if ($doorModel->viewer_thumbnail && $doorModel->viewer_thumbnail !== $doorModel->catalog_image) {
                Storage::disk('public')->delete($doorModel->viewer_thumbnail);
            }
            $doorModel->viewer_thumbnail = $request->file('viewer_thumbnail')
                ->store('door-models/thumbnails', 'public');
        }

        $doorModel->save();

        return redirect()->route('admin.door-models.index')
            ->with('success', 'Door model updated successfully.');
    }

    public function destroy(DoorModel $doorModel)
    {
        $doorModel->update(['deleted_status' => 1]);

        return redirect()->route('admin.door-models.index')
            ->with('success', 'Door model deleted.');
    }

    public function restore(DoorModel $doorModel)
    {
        $doorModel->update(['deleted_status' => 0]);

        return redirect()->route('admin.door-models.recycle')
            ->with('success', 'Door model restored.');
    }

    public function forceDelete(DoorModel $doorModel)
    {
        $doorModel->update(['deleted_status' => 2]);

        return redirect()->route('admin.door-models.recycle')
            ->with('success', 'Door model permanently deleted.');
    }
}
