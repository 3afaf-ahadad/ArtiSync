<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'status' => ['required', Rule::in(['operational', 'maintenance', 'broken'])],
            'filiere' => ['required', Rule::in(['Haute Couture', 'Bijouterie', 'Menuiserie', 'Tapisserie', 'Maroquinerie'])],
        ]);

        if ($user->role === 'formateur') {
            $validated['filiere'] = $user->filiere; // Forcer la filière du formateur
        }

        $machine = Machine::create($validated);

        return response()->json($machine, 201);
    }

    public function show(Request $request, Machine $machine)
    {
        $user = $request->user();
        if ($user->role === 'formateur' && $machine->filiere !== $user->filiere) {
            return response()->json(['message' => 'Accès refusé'], 403);
        }
        return response()->json($machine);
    }

    public function update(Request $request, Machine $machine)
    {
        $user = $request->user();

        if ($user->role === 'formateur' && $machine->filiere !== $user->filiere) {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'status' => ['sometimes', 'required', Rule::in(['operational', 'maintenance', 'broken'])],
            'filiere' => ['sometimes', 'required', Rule::in(['Haute Couture', 'Bijouterie', 'Menuiserie', 'Tapisserie', 'Maroquinerie'])],
        ]);

        if ($user->role === 'formateur' && isset($validated['filiere'])) {
            $validated['filiere'] = $user->filiere;
        }

        $machine->update($validated);

        return response()->json($machine);
    }

    public function destroy(Request $request, Machine $machine)
    {
        $user = $request->user();

        if ($user->role === 'formateur' && $machine->filiere !== $user->filiere) {
            return response()->json(['message' => 'Accès refusé'], 403);
        }

        $machine->delete();

        return response()->json(['message' => 'Machine supprimée avec succès']);
    }
}