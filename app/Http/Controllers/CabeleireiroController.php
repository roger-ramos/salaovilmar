<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Cabeleireiro;
use App\Agendamento;
use App\Servico;
use Auth;
use Illuminate\Support\Facades\Redirect;

class CabeleireiroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin',['only' => 'index','edit']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agendamentos = Agendamento::all();
        $servicos = Servico::all();
        $cabeleireiros = Cabeleireiro::all();
        $users = User::all();
        $dataescolhida = false;
        $data= null;
        return view('gerenciamentoadm')->with('users', $users)->with('agendamentos', $agendamentos)->with('servicos', $servicos)->with('cabeleireiros', $cabeleireiros)->with('data', $data)->with('dataescolhida', $dataescolhida);
    }

    public function paginainicial()
    {
        return view('index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.auth.register');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'required'
        ]);
        // store in the database
        $admins = new Admin;
        $admins->name = $request->name;
        $admins->email = $request->email;
        $admins->password=bcrypt($request->password);
        $admins->save();
        return redirect()->route('admin.auth.login');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buscarAgendamentoCabeleireiro(Request $request)
    {
        $agendamentos = Agendamento::all();
        $servicos = Servico::all();
        $cabeleireiros = Cabeleireiro::all();
        $users = User::all();
        $dataescolhida = true;
       // $id = Auth::user()->id;
        //dd($request);
       $data = $request->data;
        return view('gerenciamentoadm')->with('users', $users)->with('agendamentos', $agendamentos)->with('servicos', $servicos)->with('cabeleireiros', $cabeleireiros)->with('data', $data)->with('dataescolhida',$dataescolhida);
    }

    public function cancelarAgendamento($id)
    {
        //buscar agendamento
        $agendamentos = Agendamento::all();
        $servicos = Servico::all();
        $cabeleireiros = Cabeleireiro::all();
        $users = User::all();
        $dataescolhida = false;
        $agendamento = Agendamento::find($id);
        $data = null;
        if ($agendamento){
            //pode remover
            $agendamento->delete();
        }
        return view('gerenciamentoadm')->with('users', $users)->with('agendamentos', $agendamentos)->with('servicos', $servicos)->with('cabeleireiros', $cabeleireiros)->with('data', $data)->with('dataescolhida', $dataescolhida);;
    }

    public function mostrarConta()
    {
        return view('contaadm');
    }

    public function update(Request $request)
    {
        $usuario = Auth::user(); // resgata o usuario
        //dd($usuario);
        $usuario->nome = $request->get('nome'); // pega o valor do input username
        $usuario->descricao = $request->get('descricao'); // pega o valor do input username
        $usuario->email = $request->get('email'); // pega o valor do input email



        $usuario->save(); // salva o usuario alterado =)


        return Redirect::to('/contaadmin'); // redireciona pra rota que você achar melhor =)
    }

    public function updatesenha(Request $request)
    {
        $usuario = Auth::user(); // resgata o usuario
        $usuario->password = bcrypt($request->get('password')); // muda a senha do seu usuario já criptografada pela função bcrypt
        $usuario->save(); // salva o usuario alterado =)
        return Redirect::to('/contaadmin'); // redireciona pra rota que você achar melhor =)
    }

    public function mostrarEditarConta()
    {
        return view('editarcontaadmin');
    }


    public function mostrarAlterarSenha()
    {
        return view('alterarsenhaadmin');
    }
}
