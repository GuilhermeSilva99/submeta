<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SegurancaTest extends TestCase
{
    
    public function test_usuarios_nao_autenticados_nao_acessam_home()
    {
        $response = $this->get('/home');

        $response->assertRedirect('/login');
    }

    public function test_usuarios_nao_autenticados_acessam_login()
    {
        $response = $this->get('/login');

        $response->assertStatus(200); 
        $response->assertSee('Entrar'); 
    }

    // public function test_usuario_sem_permissao_nao_acessa_painel_admin()
    // {
    //     $user = User::factory()->create(['role' => 'user']);

    //     $this->actingAs($user)
    //         ->get('/areaTematica/nova')
    //         ->assertForbidden();
    // }

    public function test_sql_injection_no_login()
    {
        $response = $this->post('/login', [
            'email' => "' OR 1=1 --",
            'password' => 'qualquercoisa',
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_requisicao_post_sem_csrf_falha()
    {
        $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class);

        $response = $this->post('/login');

        $response->assertStatus(419);
    }


}
