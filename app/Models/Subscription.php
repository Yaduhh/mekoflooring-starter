<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'status',
        'deleted_status',
    ];

    protected $casts = [
        'deleted_status' => 'boolean',
    ];

    public function scopeNotDeleted($query)
    {
        return $query->where('deleted_status', false);
    }

    public function scopeSubscribed($query)
    {
        return $query->where('status', 'subscribed');
    }
}
