@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 100px;">

  <div class="container" >
    <div class="row" >
      <div class="col-sm-1" style="text-align: left; flaot:left;">
        <a href="{{ route('proponente.index') }}" class="btn btn-secondary" style="position:relative; float: right;">Voltar</a>
      </div>
      <div class="col-sm-7" style="text-align: center;">
        <div class="row">
          <div class="col-md-4">
          </div>
          <div class="col-md-8">
            <h4 class="titulo-table">Editais</h4>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="row">
          <div class="col-sm-2">
            <button class="btn" onclick="buscarEdital(this.parentElement.parentElement.children[1].children[0])">
              <img src="{{asset('img/icons/logo_lupa.png')}}" alt="">
            </button>
          </div>
          <div class="col-sm-10">
            <input type="text" class="form-control form-control-edit" placeholder="Digite o nome do edital" onkeyup="buscarEdital(this)">
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th scope="col">Edital</th>
          <th scope="col" style="text-align: center;">Inicio da Submissão</th>
          <th scope="col" style="text-align: center;">Fim da Submissão</th>
          <th scope="col" style="text-align: center;">Data do Resultado</th>
          <th scope="col" style="text-align: center;">Baixar Edital</th>
          <th scope="col">Opção</th>
        </tr>
      </thead>
      <tbody id="eventos">
        @foreach ($eventos as $evento)
          <tr>
            <td>
              <a href="{{  route('evento.visualizar',['id'=>$evento->id])  }}" class="visualizarEvento">
                  {{ $evento->nome }}
              </a>
            </td>
            <td style="text-align: center;">{{ date('d/m/Y', strtotime($evento->inicioSubmissao)) }}</td>
            <td style="text-align: center;">{{ date('d/m/Y', strtotime($evento->fimSubmissao)) }}</td>
            <td style="text-align: center;">{{ date('d/m/Y', strtotime($evento->created_at)) }}</td>
            <td style="text-align: center">
              <a href="{{ route('baixar.edital', ['id' => $evento->id]) }}">
                <img src="{{asset('img/icons/file-download-solid.svg')}}" width="15px">
              </a>
            </td>
            <td>
              <div class="btn-group dropright dropdown-options">
                  <a id="options" class="dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <img src="{{asset('img/icons/ellipsis-v-solid.svg')}}" style="width:8px">
                  </a>
                  <div class="dropdown-menu">
                      <a href="{{ route('proponente.projetosEdital', ['id' => $evento->id]) }}" class="dropdown-item" style="text-align: center">
                        Projetos submetidos
                      </a>
                      @if($evento->inicioSubmissao <= $hoje && $hoje <= $evento->fimSubmissao)
                        <hr class="dropdown-hr">
                        <a href="{{ route('trabalho.index', ['id' => $evento->id] )}}" class="dropdown-item" style="text-align: center">
                          Criar projeto
                        </a>
                      @endif
                      {{-- <a href="" class="dropdown-item" style="text-align: center">
                        Visualizar resultado
                      </a> --}}
                      {{-- <a href="" class="dropdown-item" style="text-align: center">
                        Recurso ao resultado
                      </a>
                      <a href="" class="dropdown-item" style="text-align: center">
                        Resultado preeliminar
                      </a>
                      <a href="" class="dropdown-item" style="text-align: center">
                        Resultado final
                      </a> --}}
                  </div>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

</div>

@endsection

@section('javascript')
<script>
  function buscarEdital(input) {
    var editais = document.getElementById('eventos').children;
    if(input.value.length > 2) {      
      for(var i = 0; i < editais.length; i++) {
        var nomeEvento = editais[i].children[0].children[0].textContent;
        if(nomeEvento.substr(0).indexOf(input.value) >= 0) {
          editais[i].style.display = "";
        } else {
          editais[i].style.display = "none";
        }
      }
    } else {
      for(var i = 0; i < editais.length; i++) {
        editais[i].style.display = "";
      }
    }
  }
</script>
@endsection
