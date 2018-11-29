<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//acesso a tela de login
//Route::get('/login', 'LoginClienteController@mostrarLogin');

//enviar os dados do formulario
//Route::post('/login', 'LoginClienteController@submitLogin');

Route::get('/efetuaragendamento', function () {
    return view('efetuaragendamento');
});

Route::get('/efetuaragendamento-cabeleireiro', 'AgendamentoController@paginaEfetuarAgendamentoAdm')->middleware('auth:admin');

Route::post('/efetuaragendamento-cabeleireiro', 'AgendamentoController@agendarAdm')->middleware('auth:admin');

Route::get('/gerenciaragendamento', function () {
    return view('gerenciamentocliente');
});

Route::get('/agendamentocabeleireiro', function () {
    return view('gerenciamentoadm');
});

Route::get('/conta', 'ClienteController@mostrarConta')->middleware('auth');

Route::get('/contaadmin', 'CabeleireiroController@mostrarConta')->middleware('auth:admin');

Route::get('/conta/editar', 'ClienteController@mostrarEditarConta')->middleware('auth');

Route::get('/contaadmin/editar', 'CabeleireiroController@mostrarEditarConta')->middleware('auth:admin');

Route::post('/contaadmin/editar/', 'CabeleireiroController@update')->middleware('auth:admin');

Route::post('/conta/editar/', 'ClienteController@update');

Route::get('/conta/alterarsenha', 'ClienteController@mostrarAlterarSenha')->middleware('auth');

Route::get('/contaadmin/alterarsenha', 'CabeleireiroController@mostrarAlterarSenha')->middleware('auth:admin');

Route::post('/contaadmin/alterarsenha', 'CabeleireiroController@updatesenha')->middleware('auth:admin');

Route::post('/conta/alterarsenha', 'ClienteController@updatesenha');

Route::get('/conta/remover/', 'ClienteController@deleteCliente');

//mostrar tela de serviços
Route::get('/servico', 'ServicoController@todosServicos')->middleware('auth:admin');

//mostrar tela de cadastro de serviços
Route::get('/cadastrarservico', 'ServicoController@mostrarCadastroServico')->middleware('auth:admin');

//enviar os dados do servico e salva no banco
Route::post('/cadastrarservico', 'ServicoController@criarServico');

//deletar servico
Route::get('/servico/remover/{id}', 'ServicoController@deleteServico');

Route::get('/servico/editar/{id}', 'ServicoController@getServicoEditar')->middleware('auth:admin');

Route::post('/servico/editar/{id}', 'ServicoController@submitServicoEditar');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home/agendar', 'AgendamentoController@paginaAgenda')->name('home.agendar');
Route::post('/home/agendar', 'AgendamentoController@agendamentoSubmit');

Route::get('/agendamento/cancelar/{id}', 'AgendamentoController@cancelarAgendamento');

Route::get('/agendamento/editar/{id}', 'AgendamentoController@paginaEditarAgendamento');

Route::post('/agendamento/editar/{id}', 'AgendamentoController@editarAgendamento')->name('home.editar');

Route::get('/agendamentoadmin/cancelar/{id}', 'CabeleireiroController@cancelarAgendamento');

Route::get('/agendamentoadmin/editar/{id}', 'AgendamentoController@paginaAgendamentoEditarAdmin')->middleware('auth:admin');;

Route::post('/agendamentoadmin/editar/{id}', 'AgendamentoController@editarAgendamentoAdmin')->middleware('auth:admin');;

Route::post('/teste', 'CabeleireiroController@buscarAgendamentoCabeleireiro')->middleware('auth:admin');


//admin - cabeleireiro rotas
//Route::get('url', 'KamalController@index')->name('url');
Route::prefix('admin')->group(function () {
    Route::get('/', 'CabeleireiroController@index')->name('admin.dashboard');
    Route::get('dashboard', 'CabeleireiroController@index')->name('admin.dashboard');
    Route::post('dashboard', 'CabeleireiroController@buscarAgendamentoCabeleireiro')->name('admin.dashboard.agenda')->middleware('auth:admin');;
    //Route::get('teste', 'CabeleireiroController@teste')->name('admin.dashboard');
    //Route::get('register', 'CabeleireiroController@create')->name('admin.register');
    //Route::post('register', 'CabeleireiroController@store')->name('admin.register.store');
    Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
    Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');
});

