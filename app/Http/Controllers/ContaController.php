<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Http\Requests\ContaRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {   
        //Ordenar Dados
        $contas = Conta::when($request->has('nome'), function($whenQuery) use ($request){
            $whenQuery->where('nome', 'like', '%'. $request->nome.'%');
        })
        ->when($request->filled('data_inicio'), function($whenQuery) use ($request){
            $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('y-m-d'));
        })
        ->when($request->filled('data_fim'), function($whenQuery) use ($request){
            $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('y-m-d'));
        })
        ->orderByDesc('id')
        ->paginate(5)
        ->withQueryString();
        //Chamar views
        return view('contas.index', [
            'contas' => $contas,
            'nome' => $request->nome,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContaRequest $request)
    {

        //Validar formulario
        $request->validated();

        try{
        $conta = Conta::create([
            'nome' => $request->nome,
            'valor' =>str_replace(',', '.', str_replace('.', '', $request->valor)),
            'vencimento' => $request->vencimento,
        ]);
        
        Log::info('Conta cadastrada com sucesso', ['id' => $conta->id, 'Conta' => $conta]);
        
        return redirect()->route('conta.show', ['conta' => $conta->id])->with('sucess', 'Conta Cadastrada com sucesso');
        
    }catch( Exception $e){
            Log::alert('Erro au Cadastar', ['Error' => $e->getMessage()]);
            
            return back()->withInput()->with('Error', 'Conta nao cadastrada');

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Conta $conta)
    {
        return view('contas.show', ['conta'=> $conta]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conta $conta)
    {
        return view('contas.edit', ['conta' => $conta]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ContaRequest $request, Conta $conta)
    {
        $request->validated();

        try{

        $conta->update([
            'nome' => $request->nome,
            'valor' =>str_replace(',', '.', str_replace('.', '', $request->valor)),
            'vencimento' => $request->vencimento,
        ]);

        Log::info('Conta Atualizada com sucesso',  ['id' => $conta->id, 'conta' => $conta]);

        return redirect()->route('conta.show', ['conta' => $conta->id ])->with('sucess', 'Conta Atualizado com sucesso');
    } catch (Exception $e){

        Log::warning('Conta nao editada', ['error' => $e->getMessage()]);
        return back()->withInput()->with('Error', 'Conta nao editada');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conta $conta)
    {
        $conta->delete();

       return redirect()->route('conta.index')->with('sucess', 'Conta eliminada com sucesso'); 
    }

    public function gerarPdf(Request $request){

        //$contas = Conta::orderByDesc('id')->get();
        $contas = Conta::when($request->has('nome'), function($whenQuery) use ($request){
            $whenQuery->where('nome', 'like', '%'. $request->nome.'%');
        })
        ->when($request->filled('data_inicio'), function($whenQuery) use ($request){
            $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('y-m-d'));
        })
        ->when($request->filled('data_fim'), function($whenQuery) use ($request){
            $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('y-m-d'));
        })
        ->orderByDesc('id')
        ->get();

        $totalValor = $contas->sum('valor');


        $pdf = PDF::loadView('contas.gerar-pdf', [
            'contas' => $contas,
            'totalValor' => $totalValor,
            ])->setPaper('a4', 'portrait');

        return $pdf->download('Listar_contas_pdf.pdf');
     }
}
