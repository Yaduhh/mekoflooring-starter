<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DoorType extends Model
{
    use HasFactory;

    protected $table = 'door_types';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'description',
        'deleted_status',
    ];

    protected $casts = [
        'deleted_status' => 'integer',
    ];

    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', 0);
    }

    public function doorModels()
    {
        return $this->hasMany(DoorModel::class, 'door_type_id');
    }

    public function activeDoorModels()
    {
        return $this->hasMany(DoorModel::class, 'door_type_id')
            ->where('status', true)
            ->where('deleted_status', 0);
    }

    public function getImageUrl()
    {
        if ($this->image) {
            return Storage::url($this->image);
        }
        return asset('images/placeholder-door.png');
    }

    public function getGroupedModels()
    {
        return $this->activeDoorModels()
            ->orderBy('door_base_name')
            ->orderBy('handle_code')
            ->get()
            ->groupBy('door_base_name');
    }
}
