<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servico;
use App\Cabeleireiro;
use App\Agendamento;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('servico')->with('servicos', $servicos);
        $agendamentos = Agendamento::all();
        $servicos = Servico::all();
        $cabeleireiros = Cabeleireiro::all();

        return view('gerenciamentocliente')->with('agendamentos', $agendamentos)->with('servicos', $servicos)->with('cabeleireiros', $cabeleireiros);

    }
}
