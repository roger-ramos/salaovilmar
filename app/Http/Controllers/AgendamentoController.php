<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use PhpParser\Node\Stmt\Return_;
use function Sodium\compare;
use Symfony\Component\Routing\Route;
use Validator;
use Storage;
use Auth;
use Redirect;
use App\Servico;
use App\Cabeleireiro;
use App\Agendamento;

class AgendamentoController extends Controller
{
    public function paginaAgenda()
    {
        $servicos = Servico::all();
        $cabeleireiros = Cabeleireiro::all();
        return view('efetuaragendamento')->with('servicos', $servicos)->with('cabeleireiros', $cabeleireiros);
    }

    public function agendamentoSubmit(Request $request)
    {
        //dd($request)->all();
        //tem que estar autenticado
        if (!Auth::check()) {
            return Redirect::to('/login');
        }
        //dd($request->servico);
        $servicos = Servico::all();
        foreach ($servicos as $servico)
        {
            if($request->servico == $servico->tipo_servico){
                $idservico = $servico->id;
            }
        }

        $cabeleireiros = Cabeleireiro::all();
        foreach ($cabeleireiros as $cabeleireiro)
        {
            if($request->cabeleireiro == $cabeleireiro->nome){
                $idcabeleireiro = $cabeleireiro->id;
            }
        }
        $dataatual = date('y/m/d');
       // dd($request->data);
        //dd($dataatual);
//        if($request->data < date('y/m/d'))
//        {
//            $messages = [
//                'erro' => 'Essa data não pode ser escolhida!',
//            ];
//            //$validate = Validator($messages);
//            return redirect()->route('home.agendar')->withErrors($messages)->withInput();
//        }
//
//        if($request->data) < strtotime($dataatual))
//        {
//            $messages = [
//                'erro' => 'Essa data não pode ser escolhida!',
//            ];
//            //$validate = Validator($messages);
//            return redirect()->route('home.agendar')->withErrors($messages)->withInput();
//        }

        $agendamentos = Agendamento::all();
        foreach ($agendamentos as $agendamento)
        {
            if($agendamento->data == $request->data)
            {
                if( $agendamento->hora == $request->hora and $agendamento->cabeleireiro_id == $idcabeleireiro)
                {
                    $messages = [
                        'erro' => 'O cabeleireiro selecionado já possui um agendamento nesse dia e horário! Por favor escolha 
                        outro dia ou horário.',
                    ];
                    //$validate = Validator($messages);
                    return redirect()->route('home.agendar')->withErrors($messages)->withInput();

                }
            }
        }


        Validator::make($request->all(), [
            'data' => 'required',
            'hora' => 'required'
        ])->validate();
        $agendamentoCreated = Agendamento::create([
            'data' => $request->get('data'),
            'hora' => $request->get('hora'),
            'nomecliente' => null,
            'servico_id' => $idservico,
            'cabeleireiro_id' => $idcabeleireiro,
            'cliente_id' => Auth::id(),
        ]);
        return Redirect::to('/');
    }

    public function paginaEditarAgendamento($id)
    {
        $servicos = Servico::all();
        $cabeleireiros = Cabeleireiro::all();
        $ag = Agendamento::where('id', $id)->first();
        return view('editaragendamento')->with('servicos', $servicos)->with('cabeleireiros', $cabeleireiros)->with('ag', $ag);
    }

    public function editarAgendamento(Request $request, $id)
    {
        $servicos = Servico::all();
        $cabeleireiros = Cabeleireiro::all();

        foreach ($servicos as $servico)
        {
            if($request->servico == $servico->tipo_servico){
                $idservico = $servico->id;
            }
        }

        foreach ($cabeleireiros as $cabeleireiro)
        {
            if($request->cabeleireiro == $cabeleireiro->nome){
                $idcabeleireiro = $cabeleireiro->id;
            }
        }

        $agendamentos = Agendamento::all();
        foreach ($agendamentos as $agendamento)
        {
            if($agendamento->data == $request->data)
            {
                if( $agendamento->hora == $request->hora and $agendamento->cabeleireiro_id == $idcabeleireiro)
                {
                    $messages = [
                        'erro' => 'O cabeleireiro selecionado já possui um agendamento nesse dia e horário! Por favor escolha 
                        outro dia ou horário.',
                    ];
                    //$validate = Validator($messages);
                    return back()->withInput()->withErrors($messages);
                    //return redirect('/agendamento/editar/{id}')->withErrors($messages)->with('id',$id);

                   // return redirect()->route('home.editar'withErrors($messages);

                }
            }
        }


        $agendamento = Agendamento::where('id', $id)->find($id);
//        Validator::make($request->all(), [
//            'title' => 'required|max:255|unique:posts,id,'.$post->id,
//            'text' => 'required',
//            'image' => 'nullable|image'
//        ])->validate();

            $agendamento->data = $request->get('data');
            $agendamento->hora = $request->get('hora');
            $agendamento->servico_id = $idservico;
            $agendamento->cabeleireiro_id = $idcabeleireiro;
            $agendamento->save();

        return Redirect::to('/home');
    }

    public function todosAgendamentos()
    {
        //pega todos os servicos e coloca em uma coleção
        $agendamentos = Agendamento::all();
        $servicos = Servico::all();
        $cabeleireiros = Cabeleireiro::all();

        return view('gerenciamentocliente')->with('agendamentos', $agendamentos)->with('servicos', $servicos)->with('cabeleireiros', $cabeleireiros);
    }

    public function cancelarAgendamento($id)
    {
        //buscar agendamento
        $agendamento = Agendamento::find($id);
        if ($agendamento){
            //pode remover
            $agendamento->delete();
        }
        return Redirect::to('/home');
    }

    public function paginaEfetuarAgendamentoAdm()
    {
        $servicos = Servico::all();
        return view('efetuaragendamento-admin')->with('servicos', $servicos);
    }

    public function agendarAdm(Request $request)
    {
        $servicos = Servico::all();
        foreach ($servicos as $servico)
        {
            if($request->servico == $servico->tipo_servico){
                $idservico = $servico->id;
            }
        }
        $idcabeleireiro = Auth::user()->id;
        $agendamentos = Agendamento::all();
        foreach ($agendamentos as $agendamento)
        {
            if($agendamento->data == $request->data)
            {
                if( $agendamento->hora == $request->hora and $agendamento->cabeleireiro_id == $idcabeleireiro)
                {
                    $messages = [
                        'erro' => 'Você já possui um agendamento nesse dia e horário! Por favor escolha 
                        outro dia ou horário.',
                    ];
                    //$validate = Validator($messages);
                    return back()->withInput()->withErrors($messages);
                    //return redirect()->route('home.agendar')->withErrors($messages)->withInput();

                }
            }
        }



        Validator::make($request->all(), [
            'data' => 'required',
            'hora' => 'required'
        ])->validate();
        $agendamentoCreated = Agendamento::create([
            'data' => $request->get('data'),
            'hora' => $request->get('hora'),
            'nomecliente' => $request->get('nomecliente'),
            'servico_id' => $idservico,
            'cabeleireiro_id' => $idcabeleireiro,
            'cliente_id' => null,
        ]);
        //return view('');
        return redirect()->route('admin.dashboard');
            //Route('admin.dashboard');
    }



    public function editarAgendamentoAdmin(Request $request, $id)
    {
        $servicos = Servico::all();
        foreach ($servicos as $servico)
        {
            if($request->servico == $servico->tipo_servico){
                $idservico = $servico->id;
            }
        }

        $idcabeleireiro = Auth::user()->id;
        $agendamentos = Agendamento::all();
        foreach ($agendamentos as $agendamento)
        {
            if($agendamento->data == $request->data)
            {
                if( $agendamento->hora == $request->hora and $agendamento->cabeleireiro_id == $idcabeleireiro)
                {
                    $messages = [
                        'erro' => 'Você já possui um agendamento nesse dia e horário! Por favor escolha 
                        outro dia ou horário.',
                    ];
                    //$validate = Validator($messages);
                    return back()->withInput()->withErrors($messages);
                    //return redirect('/agendamento/editar/{id}')->withErrors($messages)->with('id',$id);

                    // return redirect()->route('home.editar'withErrors($messages);

                }
            }
        }

        $agendamento = Agendamento::where('id', $id)->find($id);
//        Validator::make($request->all(), [
//            'title' => 'required|max:255|unique:posts,id,'.$post->id,
//            'text' => 'required',
//            'image' => 'nullable|image'
//        ])->validate();

        if ($agendamento->nomecliente == null){
            $agendamento->data = $request->get('data');
            $agendamento->hora = $request->get('hora');
            $agendamento->servico_id = $idservico;
            $agendamento->save();
        }
        else {
            $agendamento->nomecliente = $request->get('nomecliente');
            $agendamento->data = $request->get('data');
            $agendamento->hora = $request->get('hora');
            $agendamento->servico_id = $idservico;
            $agendamento->save();
        }
        return redirect()->route('admin.dashboard');
    }


    public function paginaAgendamentoEditarAdmin($id)
    {
        //dd($id);
        $servicos = Servico::all();
        $agendamentos = Agendamento::all();
        $ag = Agendamento::where('id', $id)->first();
        foreach ($agendamentos as $agendamento)
        {
            if($id == $agendamento->id)
            {
                if ($agendamento->nomecliente == null)
                {
                    return view('editaragendamento2-admin')->with('servicos', $servicos)->with('ag', $ag);
                }
                else{
                    return view('editaragendamento-admin')->with('servicos', $servicos)->with('ag', $ag);
                }
            }
        }



    }

}
