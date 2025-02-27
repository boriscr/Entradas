<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Eventos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                @role('Admin')
                    <li class="nav-item">
                        <a class="nav-link nav-admin" href="{{ route('evento.create') }}">Nuevo evento</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-admin" href="{{ route('entrada.create') }}">Nueva entrada</a>
                    </li>
                @endrole
            </ul>

            <ul class="box-nav-admin">
                @if (Route::has('login'))
                    @auth
                    <ul>
                        <p class="nav-admin">Hola, {{ auth()->user()->name }}</p>
                    </ul>
                    @endauth
                    <ul class="navbar-nav ulLog">
                        @auth
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button type="submit" class="color=white">Salir</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="color=white">Iniciar sesion</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="color=white">Crear cuenta</a>
                            @endif
                        @endauth
                    </ul>
                @endif
            </ul>
        </div>
    </div>
</nav>
