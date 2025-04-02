<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class CsrfProtectionTest extends TestCase
{
    use RefreshDatabase;

    
    public function testRequisicaoSemTokenCsrfFalha()
    {

        $user = factory(User::class)->create([
            'tipo' => 'administrador',
        ]);

        $this->actingAs($user);

        $response = $this->post('/naturezas/grande-area/salvar', [
            'nome'  => 'Area teste'
        ]);

        $response->assertStatus(419); // Código de status para falha de CSRF

    }
}
