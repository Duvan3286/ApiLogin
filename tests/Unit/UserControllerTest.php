<?php
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testRegistroUsuario()
    {
        $response = $this->postJson('/registro', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'type_users' => 1,
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Usuario registrado satisfactoriamente',
                'redirect' => 1,
            ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'type_users_id' => 1,
        ]);
    }

    public function testListadoUsuarios()
    {
        User::factory()->count(5)->create();

        $response = $this->getJson('/usuarios');

        $response->assertStatus(200);
    }

    public function testEliminarUsuario()
    {
        $user = User::factory()->create();
    
        $response = $this->deleteJson("/delete_user/{$user->id}");
    
        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    
        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
        ]);
    }
}
