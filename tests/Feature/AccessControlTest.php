<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class AccessControlTest extends TestCase
{

    use RefreshDatabase;
    
    public function testUsuarioNaoAutenticadoNaoPodeAcessarPainel()
    {

        $response = $this->get('/home'); 
        $response->assertRedirect('/login');
    }

    public function testUsuarioSemPermissaoNaoPodeAcessarRecurso()
    {


        
        $user = factory(User::class)->create([
            'tipo' => 'participante',
        ]);

        $this->actingAs($user);
        $response = $this->get('/naturezas');
        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}
