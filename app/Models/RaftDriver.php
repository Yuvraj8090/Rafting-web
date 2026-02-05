<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaftDriver extends Model
{
    use HasFactory;

    protected $fillable = [
        'dept_id',
        'name',
        'aadhaar',
        'mobile',
        'profile_image',
        'company_name',
        'status',
        'uploader_id'
    ];

    /**
     * Relationship: A driver belongs to an uploader (User)
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    /**
     * Relationship: A driver has many daily trip records
     */
    public function dailyTrips()
    {
        return $this->hasMany(DailyTrip::class);
    }

    /**
     * Scope: Only fetch approved drivers
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }
}