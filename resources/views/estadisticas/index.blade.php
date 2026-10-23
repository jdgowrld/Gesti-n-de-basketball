<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Box Score - Estadísticas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <x-navbar />

    <div class="container mt-4">
        <h1 class="text-center mb-4">Box Score (Estadísticas por Jugador)</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}<br>
                @endforeach
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-lg-12">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Registrar Rendimiento
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered bg-white shadow-sm text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Partido</th>
                            <th>Jugador</th>
                            <th>PTS</th>
                            <th>3PM</th>
                            <th>REB</th>
                            <th>AST</th>
                            <th>Fouls</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estadisticas as $stat)
                        <tr>
                            <td class="small">{{ $stat->partido->equipoLocal->nombre ?? 'L' }} vs {{ $stat->partido->equipoVisitante->nombre ?? 'V' }}</td>
                            <td class="fw-bold">{{ $stat->jugador->nombre ?? 'N/A' }}</td>
                            <td class="text-success fw-bold">{{ $stat->puntos }}</td>
                            <td>{{ $stat->triples }}</td>
                            <td>{{ $stat->rebotes }}</td>
                            <td>{{ $stat->asistencias }}</td>
                            <td class="text-danger">{{ $stat->faltas }}</td>
                            <td>
                                <form action="{{ route('estadisticas.destroy', $stat->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Borrar este registro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL DE CREACIÓN -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Añadir Estadísticas al Box Score</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body text-start">
            <form action="{{ route('estadisticas.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label>Partido (En Juego / Finalizado)</label>
                        <select name="partido_id" class="form-control" required>
                            <option value="">Selecciona el partido...</option>
                            @foreach($partidos as $partido)
                                <option value="{{ $partido->id }}">
                                    {{ $partido->equipoLocal->nombre ?? 'Local' }} vs {{ $partido->equipoVisitante->nombre ?? 'Visitante' }} ({{ \Carbon\Carbon::parse($partido->fecha)->format('d/m') }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Jugador</label>
                        <select name="jugador_id" class="form-control" required>
                            <option value="">Selecciona al jugador...</option>
                            @foreach($jugadores as $jugador)
                                <option value="{{ $jugador->id }}">{{ $jugador->nombre }} ({{ $jugador->equipo->nombre ?? 'Sin Equipo' }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2 mb-3">
                        <label>Puntos</label>
                        <input type="number" name="puntos" class="form-control" value="0" min="0" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Triples</label>
                        <input type="number" name="triples" class="form-control" value="0" min="0" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Rebotes</label>
                        <input type="number" name="rebotes" class="form-control" value="0" min="0" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>Asistencias</label>
                        <input type="number" name="asistencias" class="form-control" value="0" min="0" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label>Faltas</label>
                        <input type="number" name="faltas" class="form-control" value="0" min="0" max="5" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Stats</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>