<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/Style.css">
    <title>Vilmar cabeleireiro</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>

<body >

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/">Vilmar Salão</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item ">
                <a class="nav-link" href="/">Página Inicial<span class="sr-only">(current)</span></a>
            </li>
            
            <li class="nav-item">
                    <a class="nav-link" href="/efetuaragendamento-cabeleireiro">Efetuar agendamentos<span class="sr-only">(current)</span></a>
                </li>
            <li class="nav-item active">
                    <a class="nav-link" href="/admin/dashboard">Gerenciar agendamentos<span class="sr-only">(current)</span></a>
                </li>
            <li class="nav-item">
                <a class="nav-link" href="/servico">Gerenciar serviços<span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                </li>
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->nome }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/conta">
                            {{ __('Gerenciar Conta') }}
                        </a>
                        <a class="dropdown-item" href="{{ route('admin.auth.logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Sair') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>

    </div>
</nav>
<br>
<!-- Main jumbotron for a primary marketing message or call to action -->
<br>
<br>
<div class="container-fluid">
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Área Administrativa - Gerenciar Agendamentos</h1>
        <hr>
    </div>
</div>
<div class="container">

        <div class="card-body">
                <div class="row">
                            <div class="container">
                                    <div class="row">
                                        <form method="POST" action="{{ route('admin.dashboard.agenda') }}" enctype="multipart/form-data">
                                        @csrf
                                            <div class="form-group row">
                                                <h4><label for="name" class="col-md-12">{{ __('Selecione a data dos agendamentos') }}</label></h4>

                                                <div class="col-md-6">
                                                    <input class="form-control{{ $errors->has('data') ? ' is-invalid' : '' }}" name="data" type="date" value="{{ old('data') }}" id="example-date-input" required autofocus>
                                                    @if ($errors->has('data'))
                                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('data') }}</strong>
                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Buscar') }}
                                            </button>
                                            </div>
                                        </form>
                                        <br>
                                        <br>
                                        @if($dataescolhida == true)
                                                <legend>Data: {{ $data }}</legend>
                                                <table class="table table-inverse">
                                                    <thead>
                                                    <tr>
                                                        <th>Horário</th>
                                                        <th>Nome cliente</th>
                                                        <th>Serviço</th>
                                                        <th>Ações</th>
                                                    </tr>
                                                    </thead>
                                                    @foreach($agendamentos as $agendamento)
                                                        @if($agendamento->data == $data and $agendamento->cabeleireiro_id == Auth::user()->id)

                                                        <tr>

                                                        <td>{{ $agendamento->hora }} </td>
                                                        <td>
                                                            @foreach($users as $user)
                                                                @if($agendamento->cliente_id == $user->id)
                                                                    {{ $user->name }}
                                                                @elseif($agendamento->cliente_id == null)
                                                                    {{ $agendamento->nomecliente }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            @foreach($servicos as $servico)
                                                                @if($agendamento->servico_id == $servico->id)
                                                                    {{ $servico->tipo_servico }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td><a href="/agendamentoadmin/editar/{{ $agendamento->id }}" type="submit" class="btn btn-primary">Editar</a>
                                                            <a href="/agendamentoadmin/cancelar/{{ $agendamento->id }}" class="btn btn-danger" type="submit">Cancelar</a></td>
                                                    </tr>

                                                        @endif
                                                    @endforeach
                                                </table>
                                    <button type="submit" class="btn btn-warning">Gerar relatório de agendamentos do dia</button>
                                            @endif
                                    </div>
                            </div>
                            
                            
                            
                        </fieldset>


                </div>



            </div>



</div> <!-- /container -->
<hr>
<!-- FOOTER -->
<footer class="bd-footer text-muted">
    <div class="container-fluid p-3 p-md-5">
        <div class="row">
            <div class="col">
                <ul class="bd-footer-links">
                    <h5>Redes Sociais</h5>
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                </ul></div>


            <div class="col">
                <h5>Suporte</h5>
                <a href="#">Termos de Privacidade</a><br>
                <a href="#">Assistência</a><br>
            </div>
            <div class="col">
                <h5>Contato</h5>
                <b>Telefone:</b> (55) 3025-1600<br>
                <b>Endereço:</b> Estrada BR 158, KM 331 nro 968 Cerrito
                97060-490 Santa Maria (Rio Grande do Sul)<br>
            </div>

            <div class="col">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3315.0085753561034!2d-117.92116288533279!3d33.81209178067199!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80dcd7d12b3b5e6b%3A0x2ef62f8418225cfa!2sDisneyland!5e0!3m2!1spt-BR!2sbr!4v1538415797168" width="300" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-sm">
            <p>Todos os direitos reservados | Desenvolvido por <a href="http://compactjr.com/" target="_blank">Roger Ramos</a>.</p>

        </div>

    </div>
</footer>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
<script src="../../../../assets/js/vendor/popper.min.js"></script>
<script src="../../../../dist/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
