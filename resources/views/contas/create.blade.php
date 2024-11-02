@extends('leyouts.admin')

@section('conteudo')
    <div class="card mt-4 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <span>Visualizar Conta</span>
            <span>    
                <a href="{{ route('conta.index') }}" class="btn btn-info btn-sm me-1">Principal</button></a>
            </span>
        </div>
    </div>

    {{-- @if (@session('Error'))
    <div class="alert alert-danger m-3" role="alert">
        {{ session('Error') }}
    </div>                
    @endif  --}} 

        <x-alert />
 
    <div class="card-body">
        <form action="{{ route('conta.store') }}" method="POST">
            @csrf

            <div class="col-12">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da conta">
            </div>

            <div class="col-12">
                <label for="valor" class="form-label">Valor</label>
                <input type="text" class="form-control" name="valor" id="valor" placeholder="valor da conta">
            </div>

            <div class="col-12">
                <label for="vancimento" class="form-label">vencimento</label>
                <input type="date" class="form-control" name="vencimento" id="vencimento">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-warning btn-sm">Cadastrar</button>
            </div>

        </form>        
    </div>
   
    @endsection
