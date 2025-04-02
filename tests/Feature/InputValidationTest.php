<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputValidationTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Desativa o middleware CSRF para todos os testes nesta classe
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class); 
    }
    public function testCadastroComDadosInvalidos()
    {
        $data = [
            'name' => '',
            'email' => 'email_invalido',
            'password' => '123',
            'password_confirmation' => '456',
        ];
        

        $response = $this->post('/register', $data);
        $response->assertSee('Cadastro');
        
    }
}
