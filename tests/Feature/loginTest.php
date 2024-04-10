<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_login_with_correct_credentials()
    {
        // Crear un usuario de prueba
        $user = User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('123456'),
            'token' => '1234', 
        ]);

     
        $response = $this->postJson('/api/login', [
            'email' => 'test@example.com',
            'password' => '123456', 
        ]);

       
        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Autenticacion exitosa',
                     'status' => true,
                 ]);
    }

    
    public function user_cannot_login_with_incorrect_credentials()
    {
        
        $response = $this->postJson('/api/login', [
            'email' => 'nonexistent@example.com',
            'password' => '12345678',
        ]);

       
        $response->assertStatus(401)
                 ->assertJson([
                     'message' => 'Credenciales incorrectas',
                     'status' => false,
                 ]);
    }
}
