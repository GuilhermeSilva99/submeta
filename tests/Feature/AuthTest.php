<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        // Desativa o middleware CSRF para todos os testes nesta classe
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class); 
    }

    public function testUsuarioComCredenciaisValidasPodeAutenticar()
    {
        $user = factory(User::class)->create([
            'tipo' => 'participante',
            'email' => 'usuario@exemplo.com',
            'password' => bcrypt('senha123'),
        ]);

        $credentials = [
            'email' => 'usuario@exemplo.com',
            'password' => 'senha123',
        ];
        $this->actingAs($user);
        $response = $this->post('/login', $credentials);

        $response->assertRedirect('/home');
        $this->assertAuthenticated();
    }

    public function testUsuarioComCredenciaisInvalidasNaoPodeAutenticar()
    {
        $user = factory(User::class)->create([
            'tipo' => 'participante',
            'email' => 'usuario@exemplo.com',
            'password' => bcrypt('senha123'),
        ]);

        $credentials = [
            'email' => 'usuario@exemplo.com',
            'password' => 'senha_incorreta',
        ];


        $response = $this->post('/login', $credentials);
        // dump(session()->all());
        $this->assertGuest();
        $response->assertSessionHasErrors([
            'email' => 'As informações de login não foram encontradas.'
        ]);
        
    }
}
