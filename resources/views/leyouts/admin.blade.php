<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <title>MeuProj</title>
</head>
<body>

    <header class="p-3 text-bg-primary">
        <div class="container">
          <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
              <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
            </a>
    
            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
              <li><a href="{{ route('conta.index') }}" class="nav-link px-2 text-white">Principal</a></li>              
            </ul>
    
            <div class="text-end">
              @guest
                <a href="{{ route('home') }}" class="btn btn-warning">Login</a>
              @else

              <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><button href="#" class="btn btn-warning">{{ Auth::user()->name }}</button></li>
                <li style="padding-left: 10px;">
                  <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <input type="submit" sub class="btn btn-danger" value="Sair">
                  </form>
                </li>
              </ul>
                
              @endguest
            </div>
          </div>
        </div>
      </header>
      <div class="container">
    @yield('conteudo')
          </div>
<script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>