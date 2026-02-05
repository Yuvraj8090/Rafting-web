<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boat extends Model
{
    use HasFactory;

    protected $fillable = [
        'boat_dept_id',
        'boat_image',
        'capacity',
        'owner_name',
        'owner_mobile',
        'status',
        'uploader_id'
    ];

    /**
     * Relationship: The user who registered this boat
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    /**
     * Relationship: History of all trips this boat has completed
     */
    public function dailyTrips()
    {
        return $this->hasMany(DailyTrip::class);
    }

    /**
     * Helper: Get only active boats for the verifier scan
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}