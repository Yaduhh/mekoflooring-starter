<?php

namespace App\Http\Controllers;

use App\Models\DoorType;
use App\Models\DoorModel;
use Illuminate\Http\Request;

class DoorController extends Controller
{
    /**
     * Landing page
     */
    public function landing()
    {
        return view('door.landing');
    }

    /**
     * Browse all door types
     */
    public function index()
    {
        $doorTypes = DoorType::notDeleted()
            ->withCount(['activeDoorModels'])
            ->orderBy('name')
            ->get();

        return view('door.index', compact('doorTypes'));
    }

    /**
     * Show models inside a door type
     */
    public function showType($typeSlug)
    {
        $doorType = DoorType::where('slug', $typeSlug)
            ->notDeleted()
            ->firstOrFail();

        $groupedModels = $doorType->getGroupedModels();

        return view('door.category', compact('doorType', 'groupedModels'));
    }

    /**
     * 3D Viewer for a specific door model
     */
    public function view($typeSlug, $modelSlug)
    {
        $doorType = DoorType::where('slug', $typeSlug)
            ->notDeleted()
            ->firstOrFail();

        $doorModel = DoorModel::where('slug', $modelSlug)
            ->where('door_type_id', $doorType->id)
            ->active()
            ->firstOrFail();

        $handleVariations = $doorModel->handleVariations();

        return view('door.viewer', compact('doorType', 'doorModel', 'handleVariations'));
    }
}
