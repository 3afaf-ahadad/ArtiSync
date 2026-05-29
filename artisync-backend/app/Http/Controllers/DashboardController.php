<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = $request->user();
        $machineQuery = Machine::query();
        $maintenanceQuery = Maintenance::query();

        if ($user->role === 'formateur') {
            $machineQuery->where('filiere', $user->filiere);
            $maintenanceQuery->whereHas('machine', function ($q) use ($user) {
                $q->where('filiere', $user->filiere);
            });
        }

        return response()->json([
            'stats' => [
                'total_machines' => (clone $machineQuery)->count(),
                'operational' => (clone $machineQuery)->where('status', 'operational')->count(),
                'maintenance' => (clone $machineQuery)->where('status', 'maintenance')->count(),
                'broken' => (clone $machineQuery)->where('status', 'broken')->count(),
            ],
            'recent_maintenances' => $maintenanceQuery->with('machine')->latest()->take(5)->get()
        ]);
    }
}