<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index(Request $request, Machine $machine)
    {
        $user = $request->user();

        if ($user->role === 'formateur' && $machine->filiere !== $user->filiere) {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        $maintenances = $machine->maintenances()->latest()->get();

        return response()->json($maintenances);
    }
    public function store(Request $request, Machine $machine)
    {
        $user = $request->user();

        if ($user->role === 'formateur' && $machine->filiere !== $user->filiere) {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'description' => 'required|string|max:500',
        ]);

        $maintenance = $machine->maintenances()->create($validated);

        return response()->json($maintenance, 201);
    }
}
