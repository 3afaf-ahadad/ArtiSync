<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $query = Machine::query();

        if ($user->role === 'formateur') {
            $query->where('filiere', $user->filiere);
        }

        $kpis = [
            'total' => (clone $query)->count(),
            'en_panne' => (clone $query)->where('status', 'broken')->count(),
            'en_maintenance' => (clone $query)->where('status', 'maintenance')->count(),
        ];

        $machines = $query->latest()->simplePaginate(10);

        return response()->json([
            'kpis' => $kpis,
            'machines' => $machines
        ]);
    }
}