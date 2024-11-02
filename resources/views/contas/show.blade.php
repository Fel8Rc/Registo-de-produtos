@extends('leyouts.admin')

@section('conteudo')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span>Visualizar Conta</span>
            <span>    
                <a href="{{ route('conta.index') }}" class="btn btn-info btn-sm me-1">Principal</button></a>
                <a href="{{ route('conta.edit', ['conta'=> $conta->id]) }}" class="btn btn-warning btn-sm me-1">Editar</button></a>
            </span>
        </div>
    </div>
    
    <x-alert />     
 
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Id</dt>
            <dd class="col-sm-9">{{ $conta->id }}</dd>

            <dt class="col-sm-3">Nome</dt>
            <dd class="col-sm-9">{{ $conta->nome }}</dd>

            <dt class="col-sm-3">Valor</dt>
            <dd class="col-sm-9">{{number_format($conta->valor, 2, ',', '.') .'Kz' }}</dd>
                
            <dt class="col-sm-3">Vencimento</dt>
            <dd class="col-sm-9">{{\Carbon\Carbon::parse($conta->vencimento)->tz('America/Sao_Paulo')->format('d-m-y') }}</dd>

            <dt class="col-sm-3">Cadastrado</dt>
            <dd class="col-sm-9">{{\Carbon\Carbon::parse($conta->created_at)->tz('America/Sao_Paulo')->format('d-m-y H:i:s') }}</dd>

            <dt class="col-sm-3">Editado</dt>
            <dd class="col-sm-9">{{\Carbon\Carbon::parse($conta->updated_a)->tz('America/Sao_Paulo')->format('d-m-y H:i:s') }}</dd>

    </div>
   
    @endsection
