<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Gestión de Partidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <x-navbar />

    <div class="container mt-4">
        <h1 class="text-center mb-4">Calendario de Partidos</h1>

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
                    Agendar Partido
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <table class="table table-bordered bg-white shadow-sm text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Torneo</th>
                            <th>Local</th>
                            <th>VS</th>
                            <th>Visitante</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partidos as $partido)
                        <tr>
                            <td>{{ $partido->torneo->nombre ?? 'N/A' }}</td>
                            <td class="fw-bold">{{ $partido->equipoLocal->nombre ?? 'N/A' }}</td>
                            <td>🏀</td>
                            <td class="fw-bold">{{ $partido->equipoVisitante->nombre ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</td>
                            <td>
                                <span class="badge bg-{{ $partido->estado == 'Programado' ? 'info' : ($partido->estado == 'En Juego' ? 'warning' : 'success') }}">
                                    {{ $partido->estado }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('partidos.destroy', $partido->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este partido del calendario?')">Borrar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL DE CREACIÓN REFACTORIZADO -->
    <x-modal id="createModal" title="Agendar Nuevo Partido">
        <form action="{{ route('partidos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Torneo</label>
                <select name="torneo_id" class="form-control" required>
                    <option value="">Selecciona un torneo...</option>
                    @foreach($torneos as $torneo)
                        <option value="{{ $torneo->id }}">{{ $torneo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Equipo Local</label>
                    <select name="equipo_local_id" class="form-control" required>
                        <option value="">Local...</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Equipo Visitante</label>
                    <select name="equipo_visitante_id" class="form-control" required>
                        <option value="">Visitante...</option>
                        @foreach($equipos as $equipo)
                            <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Hora</label>
                    <input type="time" name="hora" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label>Estado</label>
                <select name="estado" class="form-control" required>
                    <option value="Programado">Programado</option>
                    <option value="En Juego">En Juego</option>
                    <option value="Finalizado">Finalizado</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Agendar</button>
            </div>
        </form>
    </x-modal>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>