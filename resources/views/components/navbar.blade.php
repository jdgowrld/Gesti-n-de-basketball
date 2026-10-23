<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href=""> Liga Básquetbol</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('equipos.index') }}">Equipos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('temporadas.index') }}">Temporadas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('torneos.index') }}">Torneos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('partidos.index') }}">Partidos</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('jugadores.index') }}">Jugadores</a></li>

                <li class="nav-item"><a class="nav-link" href="{{ route('estadisticas.index') }}">Estadísticas</a></li>
            </ul>
        </div>
    </div>
</nav>