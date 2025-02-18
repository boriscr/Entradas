<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('AdminEvento.index') }}">Eventos</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('AdminEvento.index') }}">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('AdminEvento.create') }}">Nuevo evento</a>
                    </li>
                @endauth
            </ul>

            <ul class="navbar-nav ulLog">
                @if (Route::has('login'))
                    @auth
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="color=white">Salir</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="color=white">Iniciar sesion</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="color=white">Registrar</a>
                        @endif
                    @endauth
                @endif

            </ul>
        </div>
    </div>
</nav>
