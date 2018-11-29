<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Servico;

class ServicoController extends Controller
{
    public function mostrarServico()
    {
        return view('servico');
    }

    public function mostrarCadastroServico()
    {
        return view('cadastrarservico');
    }

    public function criarServico(Request $request)
    {
        //criar o servico
        $servico = Servico::create(
            [
                'tipo_servico' => $request->get('tipo_servico')
            ]
        );
        //autenticar usuário
        //Auth::login($cliente);
        return Redirect::to('/servico');
    }

    public function todosServicos()
    {
        //pega todos os servicos e coloca em uma coleção
        $servicos = Servico::all();
        
        return view('servico')->with('servicos', $servicos);
    }

    public function deleteServico($id)
    {
        //buscar servico       
        $servico = Servico::find($id);
        if ($servico){
            //pode remover
          $servico->delete();
        }
        return Redirect::to('/servico');
    }

    public function getServicoEditar($id)
    {
        $servico = Servico::find($id);
        //$servico = Post::where('slug', $slug)->first();
        return view('editarservico')->with('servico', $servico);
    }

    public function submitServicoEditar(Request $request, $id)
    {
        $servico = Servico::where('id', $id)->find($id);
        
        Validator::make($request->all(), [
            'tipo_servico' => 'required|max:255'
        ])->validate();
        $servico->tipo_servico = $request->get('tipo_servico');
        $servico->save();
        return Redirect::to('/servico');
    }

}
