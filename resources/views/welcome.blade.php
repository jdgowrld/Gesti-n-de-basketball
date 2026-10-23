<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Dashboard - Liga Básquetbol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <!-- Tu Navbar global -->
    <x-navbar />

    <div class="container mt-5">
        <div class="row text-center mb-5">
            <div class="col-lg-8 offset-lg-2">
                <h1 class="display-4 fw-bold text-dark">🏀 Panel de Control</h1>
                <p class="lead text-secondary">Sistema centralizado de gestión para la Liga de Básquetbol.</p>
            </div>
        </div>

        <!-- Grid de Accesos Directos -->
        <div class="row g-4">
            <!-- Partidos -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h2 class="card-title">📅</h2>
                        <h4 class="fw-bold">Partidos</h4>
                        <p class="text-muted">Gestiona el calendario, horarios y el estado de los encuentros.</p>
                        <a href="{{ route('partidos.index') }}" class="btn btn-dark w-100">Ir a Partidos</a>
                    </div>
                </div>
            </div>

            <!-- Box Score -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h2 class="card-title">📊</h2>
                        <h4 class="fw-bold">Estadísticas</h4>
                        <p class="text-muted">Registra puntos, triples, rebotes y el Box Score de la liga.</p>
                        <a href="{{ route('estadisticas.index') }}" class="btn btn-dark w-100">Ir a Box Score</a>
                    </div>
                </div>
            </div>

            <!-- Roster -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h2 class="card-title">⛹️‍♂️</h2>
                        <h4 class="fw-bold">Jugadores</h4>
                        <p class="text-muted">Administra los rosters, dorsales y posiciones de los equipos.</p>
                        <a href="{{ route('jugadores.index') }}" class="btn btn-dark w-100">Ir a Jugadores</a>
                    </div>
                </div>
            </div>

            <!-- Equipos -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h2 class="card-title">🛡️</h2>
                        <h4 class="fw-bold">Franquicias</h4>
                        <p class="text-muted">Da de alta los equipos oficiales y ciudades representadas.</p>
                        <a href="{{ route('equipos.index') }}" class="btn btn-dark w-100">Ir a Equipos</a>
                    </div>
                </div>
            </div>

            <!-- Estructura -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h2 class="card-title">🏆</h2>
                        <h4 class="fw-bold">Torneos</h4>
                        <p class="text-muted">Controla las temporadas activas y las competiciones.</p>
                        <div class="d-flex gap-2">
                            <a href="{{ route('torneos.index') }}" class="btn btn-outline-dark w-50">Torneos</a>
                            <a href="{{ route('temporadas.index') }}" class="btn btn-outline-dark w-50">Temporadas</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sedes -->
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <h2 class="card-title">🏟️</h2>
                        <h4 class="fw-bold">Canchas</h4>
                        <p class="text-muted">Catálogo de sedes, gimnasios y domos deportivos.</p>
                        <a href="{{ route('canchas.index') }}" class="btn btn-dark w-100">Ir a Canchas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>