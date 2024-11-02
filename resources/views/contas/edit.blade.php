@extends('leyouts.admin')

@section('conteudo')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span>Visualizar Conta</span>
            <span>    
                <a href="{{ route('conta.index') }}" class="btn btn-info btn-sm me-1">Principal</button></a>
                <a href="{{ route('conta.show', ['conta'=>$conta->id]) }}" class="btn btn-primary btn-sm m-1">Visualizar</button></a>
            </span>
        </div>
    </div>

    <x-alert />
 
    <div class="card-body">
        <form action="{{ route('conta.update', ['conta' => $conta->id ])}}" method="POST" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-12">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" value="{{ old('nome', $conta->nome) }}" placeholder="Nome da conta">
            </div>

            <div class="col-12">
                <label for="valor" class="form-label">Valor</label>
                <input type="text" class="form-control" name="valor" id="valor" value="{{ old('valor', isset ($conta->valor) ? number_format($conta->valor, 2, ',', '.') : '')}}" placeholder="valor da conta">
            </div>

            <div class="col-12">
                <label for="vancimento" class="form-label">vencimento</label>
                <input type="date" class="form-control" name="vencimento" id="vencimento" value="{{ old('vencimento', $conta->vencimento)}}">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-warning btn-sm">Atualizar</button>
            </div>

        </form>

        
    </div>
   
    @endsection
