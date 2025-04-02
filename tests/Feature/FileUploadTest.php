<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\User;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Desativa o middleware CSRF para todos os testes nesta classe
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class); 
    }

    public function testUploadDeArquivoComTipoInvalido()
    {

        $user = factory(User::class)->create([
            'tipo' => 'administrador',
        ]);

        $this->actingAs($user);

        Storage::fake('local');

        $file = UploadedFile::fake()->create('script.exe', 100);

        $response = $this->post('/evento/criar', [
            "nome" => "teste",
            "descricao" => "descrção teste",
            "tipo" => "CONTINUO",
            "natureza" => "1",
            "inicioSubmissao" => "2025-04-02",
            "fimSubmissao" => "2025-04-04",
            "inicioRevisao" => null,
            "fimRevisao" => null,
            "resultado_final" => null,
            "resultado_preliminar" => null,
            "inicio_recurso" => null,
            "fim_recurso" => null,
            "numMaxTrabalhos" => null,
            "numMaxCoautores" => null,
            "numParticipantes" => "2",
            "hasResumo" => null,
            "criador_id" => 1,
            "coordenador_id" => "1",
            "pdfEdital" => $file,
            "modeloDocumento" => null,
            "anexosStatus" => "final",
            "consu" => false,
            "dt_inicioRelatorioParcial" => null,
            "dt_fimRelatorioParcial" => null,
            "dt_inicioRelatorioFinal" => "2025-04-01",
            "dt_fimRelatorioFinal" => "2025-04-04",
            "formAvaliacaoExterno" => null,
            "formAvaliacaoInterno" => null,
            "cotaDoutor" => false,
            "inicioProjeto" => null,
            "fimProjeto" => null,
            "formAvaliacaoRelatorio" => "pdfFormAvalRelatorio/2/formulario de avaliação do relatorio.pdf",
            "docTutorial" => null,
            "nome_docExtra" => null,
            "obrigatoriedade_docExtra" => false,
            "tipoAvaliacao" => "form",
        ]);

        $response->assertSessionHasErrors([
            'pdfEdital' => 'Pdf edital deve ser um arquivo do tipo: pdf.'
        ]);
    }
}
