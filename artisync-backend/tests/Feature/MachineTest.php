<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Machine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MachineTest extends TestCase
{
    use RefreshDatabase;

    public function test_chef_de_pole_can_access_all_machines()
    {
        $chef = User::factory()->create([
            'role' => 'chef',
            'filiere' => null
        ]);

        Machine::factory()->create(['filiere' => 'Menuiserie', 'name' => 'Scie']);
        Machine::factory()->create(['filiere' => 'Bijouterie', 'name' => 'Polisseuse']);

        $response = $this->actingAs($chef, 'sanctum')
            ->getJson('/api/machines');

        $response->assertStatus(200)
            ->assertJsonCount(2, 'machines.data');
    }

    public function test_formateur_can_only_access_their_filiere_machines()
    {
        $formateur = User::factory()->create([
            'role' => 'formateur',
            'filiere' => 'Menuiserie'
        ]);

        Machine::factory()->create(['filiere' => 'Menuiserie', 'name' => 'Scie']);
        Machine::factory()->create(['filiere' => 'Bijouterie', 'name' => 'Polisseuse']);

        $response = $this->actingAs($formateur, 'sanctum')
            ->getJson('/api/machines');

        $response->assertStatus(200)
            ->assertJsonCount(1, 'machines.data')
            ->assertJsonPath('machines.data.0.filiere', 'Menuiserie');
    }
}