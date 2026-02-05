<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'raft_driver_id',
        'boat_id',
        'verifier_id',
        'trip_date',
        'verified_at',
        'entry_point'
    ];

    // Ensure trip_date is treated as a date object
    protected $casts = [
        'trip_date' => 'date',
        'verified_at' => 'datetime',
    ];

    public function driver()
    {
        return $this->belongsTo(RaftDriver::class, 'raft_driver_id');
    }

    public function boat()
    {
        return $this->belongsTo(Boat::class);
    }

    public function verifier()
    {
        return $this->belongsTo(User::class, 'verifier_id');
    }
}