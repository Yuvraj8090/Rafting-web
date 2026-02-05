<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RaftDriver;
use App\Models\Boat;
use App\Models\DailyTrip;
use App\Models\User;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_drivers' => RaftDriver::count(),
            'total_boats'   => Boat::count(),
            'trips_today'   => DailyTrip::whereDate('trip_date', Carbon::today())->count(),
            'pending_drivers' => RaftDriver::where('status', 'pending')->count(),
        ];

        return view('dashboard', compact('stats'));
    }
}