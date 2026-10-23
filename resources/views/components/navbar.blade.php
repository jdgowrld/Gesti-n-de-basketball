<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
    <!-- Cambiamos a container-fluid para aprovechar mejor el ancho de la pantalla -->
    <div class="container-fluid px-4">
        
        <!-- Logo / Hub Principal -->
        <a class="navbar-brand fw-bold" href="{{ url('/') }}"> Liga Básquetbol</a>
        
        <!-- Botón de hamburguesa para celulares -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                
                <!-- MÓDULOS CORE (Los de uso diario) -->
                <li class="nav-item"><a class="nav-link" href="{{ route('partidos.index') }}">Partidos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('estadisticas.index') }}">Box Score</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('equipos.index') }}">Equipos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('jugadores.index') }}">Jugadores</a></li>
                
                <!-- GESTIÓN DE TORNEOS -->
                <li class="nav-item"><a class="nav-link" href="{{ route('convocatorias.index') }}">Convocatorias</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('torneos.index') }}">Torneos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('temporadas.index') }}">Temporadas</a></li>

                <!-- CATÁLOGOS EXTRA (Agrupados en Dropdown por buena UX) -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarCat" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catálogos
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarCat">
                        <li><a class="dropdown-item" href="{{ route('canchas.index') }}"> Canchas y Sedes</a></li>
                        <li><a class="dropdown-item" href="{{ route('arbitros.index') }}"> Padrón de Árbitros</a></li>
                        <li><a class="dropdown-item" href="{{ route('patrocinadores.index') }}"> Patrocinadores</a></li>
                        <li><a class="dropdown-item" href="{{ route('posiciones.index') }}"> Posiciones de Juego</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('uniformes.index') }}"> Uniformes</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</nav>