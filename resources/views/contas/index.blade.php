@extends('leyouts.admin')

@section('conteudo')

<div class="card mt-3 mb-4 border-light shadow">
    <div class="card-header d-flex justify-content-between">
        <span>Pesquisar</span>
    </div>

    <div class="card body">
        <form action="{{ route('conta.index') }}">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="" placeholder="Pesquisar com um nome" value="{{ $nome }}" />
                </div>
                <div class="col-md-3 col-sm-12">
                    <label for="data_inicio" class="form-label">Data Inicio</label>
                    <input type="date" name="data_inicio" id="data_inicio" class="form-control" placeholder="Pesquisar com um nome" value="{{ $data_inicio }}" />
                </div>
                <div class="col-md-3 col-sm-12">
                    <label for="data_fim" class="form-label">Data Fim</label>
                    <input type="date" name="data_fim" id="data_fim" class="form-control" placeholder="Pesquisar com um nome" value="{{ $data_fim }}" />
                </div>
                <div class="col-md-3 col-sm-12 mt-3 pt-4">
                    <button type="submit" class="btn btn-info btn-sm">Pesquisar</button>
                    <a href="{{ route('conta.index') }}" class="btn btn-warning btn-sm">Limpar</a>
                </div>
            </div>
        </form>
    </div>
</div>
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span>Listar Contas</span>
            <span>    
                <a href="{{ route('conta.create') }}" class="btn btn-success btn-sm">Cadastar</a>
                {{--<a href="{{ route('conta.gerarPdf') }}" class="btn btn-warning btn-sm">Gerar PDF</button></a>--}}
                <a href="{{ url('gerar-pdf-conta?' . request()->getQueryString()) }}" class="btn btn-warning btn-sm">Gerar PDF</a>
            </span>
        </div>
    </div>
    

        <x-alert />
 
    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Valor</th>
                <th scope="col">Vencimento</th>
                <th scope="col" class="text-center">Opcoes de acoes</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($contas as $conta)
                <tr>
                    <th>{{ $conta->id }}</th>
                    <td>{{ $conta->nome }}</td>
                    <td>{{ number_format($conta->valor, 2, ',', '.') .'Kz' }}</td>
                    <td>{{ \Carbon\Carbon::parse($conta->vencimento)->tz('America/Sao_Paulo')->format('d-m-y') }}</td>
                    <td class="d-md-flex justify-content-center">
                        <a href="{{ route('conta.show', ['conta'=>$conta->id]) }}" class="btn btn-primary btn-sm m-1">Visualizar</button></a>
                        <a href="{{ route('conta.edit', ['conta'=> $conta->id]) }}" class="btn btn-warning btn-sm m-1">Editar</button></a>
                        <form id="formExluir{{$conta->id}}" action="{{ route('conta.destroy', ['conta'=>$conta->id ]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-sm m-1" onclick="confirmarExclusao(event, {{ $conta->id }})">Apagar</button>    
                        </form>
                    </td>
                  </tr>
                @empty
                    <p>Nenhum Registro</p>
                @endforelse
            </tbody>
        </table>
        {{ $contas->onEachSide(2)->links() }}
    </div>
   
    @endsection
