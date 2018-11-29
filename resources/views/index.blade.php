<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="Style.css">
    <link rel="stylesheet" href="<?php echo asset('css/style.css')?>" type="text/css">
    <!--CSS SELECT -->
    <link rel="stylesheet" type"text/css" href="bootstrap-select-1.12.4/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type"text/css" href="bootstrap-select-1.12.4/dist/css/bootstrap-select.min.css">
    <title>Vilmar Cabeleireiro</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../dist/css/bootstrap-select.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="/">Vilmar Salão</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">

        </ul>



        <form class="form-inline my-2 my-lg-0">
          <span class="navbar-text" class="logado">

          </span>



          <div class="flex-center position-ref full-height">


            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        /
                        <a href="{{ route('register') }}">Criar Conta</a>
                    @endauth
                </div>

             @elseif(Route::has('/inicio'))
              <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest('admin')
                  <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                      <span class="caret"></span>
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
              @endif
        </form>
      </div>
    </nav>
    <br>
    <br>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" id="cor2">
      <h1 class="display-2">Salão Vilmar Oliveira</h1>
      <p class="lead">

      <p><h4>Há 35 anos fazendo a cabeça do povo Panambiense !</h4></p>
      <br>
      <p><h3>Agende o seu horário já!</h3></p>
      <br>


      </p>
    </div>

    <div class="container" >
      <!-- Example row of columns -->

      <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center" >
        <h1 class="display-4">Conheça os profissionais</h1>
        <br>
        <div class="row text-center">

          <div class="col-md-6">
            <img class="imgprofissionais" src="{{ asset('img/vilmar.jpg') }}" />
            <h2>Vilmar de Oliveira</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn btn-outline-primary" href="#" role="button">Ver perfil profissional &raquo;</a></p>
          </div>
          <div class="col-md-6">
          <img class="imgprofissionais" src="{{ asset('img/hildegard.jpg') }}" />
            <h2>Hildegard Scheer</h2>
            <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
            <p><a class="btn btn-outline-primary" href="#" role="button">Ver perfil profissional &raquo;</a></p>
          </div>
        </div>

        </p>
      </div>



      <hr>

    </div> <!-- /container -->


    <!-- FOOTER -->
    <footer class="bd-footer text-muted">
      <div class="container-fluid p-3 p-md-5">
        <div class="row">
          <div class="col">
            <ul class="bd-footer-links">
              <h5>Redes Sociais</h5>
              <a href="#">Facebook</a><br>
              <a href="#">Twitter</a><br>
              <a href="#">Instagram</a>
            </ul></div>


          <div class="col">
            <h5>Suporte</h5>
            <a href="#">Termos de Privacidade</a><br>
            <a href="#">Assistência</a><br>
            <a href="{{ route('admin.auth.login') }}">Admin/Cabeleireiro - Login!</a><br>
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
