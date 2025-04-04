<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    protected $table = 'relatorios';

    protected $fillable = [
        'id',
        'status',
        'inicio_projeto',
        'conclusao_projeto',
        'titulo_projeto',
        'area_tematica_principal',
        'ods',
        'captacao_recursos',
        'resumo',
        'objetivos_alcancados',
        'justificativa_objetivos_alcancados',
        'pessoas_beneficiadas',
        'alcance_publico_estimado',
        'justificativa_publico_estimado',
        'beneficios_publico_atendido',
        'impactos_tecnologicos_cientificos',
        'desafios_encontrados',
        'avaliacao_projeto_executado',
        'formulario_indicadores',
        'certificacao_adicinonal',
        'trabalho_id',
        'anexo',
        'progresso',
        'processo_sipac',
    ];

    public function setAttributes($request)
    {
        $this->status = 'em análise';
        $this->processo_sipac = $request['processo_sipac'];
        $this->inicio_projeto = $request['inicio_projeto'];
        $this->conclusao_projeto = $request['conclusao_projeto'];
        $this->titulo_projeto = $request['titulo_projeto'];
        $this->area_tematica_principal = json_encode($request['select_area_tematica']);
        $this->ods = json_encode($request['select_ods']);
        $this->captacao_recursos = false;
        $this->resumo = 'em progresso';
        $this->objetivos_alcancados = 0;
        $this->justificativa_objetivos_alcancados = 'em progresso';
        $this->pessoas_beneficiadas = 0;
        $this->alcance_publico_estimado = 0;
        $this->justificativa_publico_estimado = 'em progresso';
        $this->beneficios_publico_atendido = 'em progresso';
        $this->impactos_tecnologicos_cientificos = 'em progresso';
        $this->desafios_encontrados = 'em progresso';
        $this->avaliacao_projeto_executado = 'em progresso';
        $this->formulario_indicadores = false;
        $this->certificacao_adicinonal = false;
        $this->trabalho_id = $request['trabalho_id'];
        $this->anexo = 'em progresso';
        $this->progresso = 'parte 1';
        
        /*$this->captacao_recursos = $request['captacao_recursos'];
        $this->resumo = $request['resumo'];
        $this->objetivos_alcancados = $request['objetivos_alcancados'];
        $this->justificativa_objetivos_alcancados = $request['justificativa_objetivos_alcancados'];
        $this->pessoas_beneficiadas = $request['pessoas_beneficiadas'];
        $this->alcance_publico_estimado = $request['alcance_publico_estimado'];
        $this->justificativa_publico_estimado = $request['justificativa_publico_estimado'];
        $this->beneficios_publico_atendido = $request['beneficios_publico_atendido'];
        $this->impactos_tecnologicos_cientificos = $request['impactos_tecnologicos_cientificos'];
        $this->desafios_encontrados = $request['desafios_encontrados'];
        $this->avaliacao_projeto_executado = $request['avaliacao_projeto_executado'];
        $this->formulario_indicadores = $request['formulario_indicadores'];
        $this->certificacao_adicinonal = $request['certificacao_adicinonal'];
        $this->trabalho_id = $request['trabalho_id']; */
    }

    public function setAttributesParte3($request)
    {
        $this->resumo = $request['resumo'];
        $this->objetivos_alcancados = $request['objetivos_alcancados'];
        $this->justificativa_objetivos_alcancados = $request['justificativa_objetivos_alcancados'];
        $this->pessoas_beneficiadas = $request['pessoas_beneficiadas'];
        $this->alcance_publico_estimado = $request['alcance_publico_estimado'];
        $this->justificativa_publico_estimado = $request['justificativa_publico_estimado'];
        $this->beneficios_publico_atendido = $request['beneficios_publico_atendido'];
        $this->impactos_tecnologicos_cientificos = $request['impactos_tecnologicos_cientificos'];
        $this->desafios_encontrados = $request['desafios_encontrados'];
        $this->avaliacao_projeto_executado = $request['avaliacao_projeto_executado'];
    }

    public function trabalho(){
        return $this->belongsTo('App\Trabalho');
    }
}
