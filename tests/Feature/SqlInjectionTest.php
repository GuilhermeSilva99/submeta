<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SegurancaTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        // Desativa o middleware CSRF para todos os testes nesta classe
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class); 
    }

    public function test_sql_injection_no_email_do_login()
    {
        $response = $this->post('/login', [
            'email' => "' OR 1=1 --",
            'password' => 'qualquercoisa',
        ]);

        $response->assertSee('Entrar'); 

    }

    public function test_sql_injection_na_senha_do_login()
    {
        $response = $this->post('/login', [
            'email' => 'teste@example.com', // Use um email real do banco de testes
            'password' => "' OR 1=1 --",
        ]);

        $response->assertSee('Entrar'); 

    }

}
