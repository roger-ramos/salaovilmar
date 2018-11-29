<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;
use Illuminate\Support\Facades\Redirect;
use UpdateAccount;

class ClienteController extends Controller
{
    public function mostrarConta()
    {
        return view('contacliente');
    }

    public function mostrarEditarConta()
    {
        return view('editarconta');
    }

    public function submitContaEditar(Request $request)
    {
        $id = Auth::user()->id;

        $conta = User::where('id', $id)->find($id);

        Validator::make($request->all(), [
            'name' => 'string|max:255',
            'telefone' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'password' => 'string|min:6|confirmed',
        ])->validate();
        $conta->name = $request->get('name');
        $conta->telefone = $request->get('telefone');
        $conta->email = $request->get('email');
        $conta->password = $request->get('password')->Hash::make($data['password']);
        $conta->save();
        return Redirect::to('/conta');
    }

    public function deleteCliente()
    {
        $id = Auth::user()->id;
        //buscar servico
        Auth::logout();
        $conta = User::find($id);
        if ($conta){
            //pode remover
            $conta->delete();
        }
        return Redirect::to('/');
    }

    public function update(Request $request)
    {
        $usuario = Auth::user(); // resgata o usuario

        $usuario->name = $request->get('name'); // pega o valor do input username
        $usuario->telefone = $request->get('telefone'); // pega o valor do input username
        $usuario->email = $request->get('email'); // pega o valor do input email



        $usuario->save(); // salva o usuario alterado =)


        return Redirect::to('/conta'); // redireciona pra rota que você achar melhor =)
    }

    public function updatesenha(Request $request)
    {
        $usuario = Auth::user(); // resgata o usuario
        $usuario->password = bcrypt($request->get('password')); // muda a senha do seu usuario já criptografada pela função bcrypt
        $usuario->save(); // salva o usuario alterado =)
        return Redirect::to('/conta'); // redireciona pra rota que você achar melhor =)
    }

    public function mostrarAlterarSenha()
    {
        return view('alterarsenha');
    }


}
