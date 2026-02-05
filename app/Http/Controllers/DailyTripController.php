<?php

namespace App\Http\Controllers;

use App\Models\DailyTrip;
use App\Models\RaftDriver;
use App\Models\Boat;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DailyTripController extends Controller
{
    // Step 1: Verify Driver and Get Color Status
    public function verifyDriver(Request $request)
    {
        $driver = RaftDriver::where('dept_id', $request->dept_id)->firstOrFail();
        
        // Count trips done TODAY
        $tripCount = DailyTrip::where('raft_driver_id', $driver->id)
            ->whereDate('trip_date', Carbon::today())
            ->count();

        $maxTrips = 3; // This should ideally come from your Settings/Config table
        
        // Color Logic
        $statusColor = 'green';
        if ($tripCount >= $maxTrips) $statusColor = 'red';
        elseif ($tripCount == $maxTrips - 1) $statusColor = 'orange';
        elseif ($tripCount >= 1) $statusColor = 'yellow';

        return view('verifier.check-driver', compact('driver', 'tripCount', 'statusColor'));
    }

    // Step 2: Finalize Trip (After Boat is also scanned)
    public function store(Request $request)
    {
        $request->validate([
            'raft_driver_id' => 'required|exists:raft_drivers,id',
            'boat_id' => 'required|exists:boats,id',
        ]);

        DailyTrip::create([
            'raft_driver_id' => $request->raft_driver_id,
            'boat_id' => $request->boat_id,
            'verifier_id' => auth()->id(),
            'trip_date' => Carbon::today(),
            'verified_at' => now(),
        ]);

        return redirect()->route('verifier.dash')->with('success', 'Trip Authorized Successfully!');
    }
}