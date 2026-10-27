<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Roster de Jugadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <x-navbar />

    <div class="container mt-4">
        <h1 class="text-center mb-4">Roster Oficial de Jugadores</h1>

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
            <div class="col-lg-10 offset-lg-1">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                    Registrar Nuevo Jugador
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <table class="table table-bordered bg-white shadow-sm text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Dorsal (#)</th>
                            <th>Posición</th>
                            <th>Equipo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jugadores as $jugador)
                        <tr>
                            <td>{{ $jugador->id }}</td>
                            <td class="fw-bold">{{ $jugador->nombre }}</td>
                            <td>{{ $jugador->numero }}</td>
                            <!-- AQUÍ SE IMPRIME LA RELACIÓN CORRECTA -->
                            <td>{{ $jugador->posicion->nombre ?? 'N/A' }}</td>
                            <td>{{ $jugador->equipo->nombre ?? 'N/A' }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$jugador->id}}">Editar</button>
                                
                                <form action="{{ route('jugadores.destroy', $jugador->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres dar de baja a este jugador?')">Eliminar</button>
                                </form>

                                <!-- MODAL DE EDICIÓN -->
                                <x-modal id="editModal{{$jugador->id}}" title="Actualizar Jugador">
                                    <form action="{{ route('jugadores.update', $jugador->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label>Nombre Completo</label>
                                            <input type="text" name="nombre" class="form-control" value="{{ $jugador->nombre }}" required>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Dorsal (#)</label>
                                                <input type="number" name="numero" class="form-control" value="{{ $jugador->numero }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Posición</label>
                                                <select name="posicion_id" class="form-control" required>
                                                    <option value="">Selecciona una posición</option>
                                                    @foreach($posiciones as $posicion)
                                                        <option value="{{ $posicion->id }}" {{ $jugador->posicion_id == $posicion->id ? 'selected' : '' }}>
                                                            {{ $posicion->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label>Equipo</label>
                                            <select name="equipo_id" class="form-control" required>
                                                @foreach($equipos as $equipo)
                                                    <option value="{{ $equipo->id }}" {{ $jugador->equipo_id == $equipo->id ? 'selected' : '' }}>
                                                        {{ $equipo->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-warning">Actualizar</button>
                                        </div>
                                    </form>
                                </x-modal>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL DE CREACIÓN -->
    <x-modal id="createModal" title="Fichar Jugador">
        <form action="{{ route('jugadores.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nombre Completo</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej. LeBron James" required>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Dorsal (#)</label>
                    <input type="number" name="numero" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Posición</label>
                    <select name="posicion_id" class="form-control" required>
                        <option value="">Selecciona...</option>
                        @foreach($posiciones as $posicion)
                            <option value="{{ $posicion->id }}">{{ $posicion->nombre }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>Equipo</label>
                <select name="equipo_id" class="form-control" required>
                    <option value="">Selecciona un equipo...</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Fichar Jugador</button>
            </div>
        </form>
    </x-modal>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>