<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Gestión de Torneos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <!-- Componente reutilizable -->
    <x-navbar />

    <div class="container mt-4">
        <h1 class="text-center mb-4">Gestión de Torneos</h1>

        <!-- Alertas de UX (Éxito o Error) -->
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
                    Registrar Nuevo Torneo
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <table class="table table-bordered bg-white shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre del Torneo</th>
                            <th>Temporada</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($torneos as $torneo)
                        <tr>
                            <td>{{ $torneo->id }}</td>
                            <td>{{ $torneo->nombre }}</td>
                            <!-- Muestra la temporada a la que pertenece -->
                            <td>Temporada {{ $torneo->temporada->año_inicio ?? 'N/A' }} - {{ $torneo->temporada->año_fin ?? 'N/A' }}</td>
                            <td>
                                <!-- Botón Editar -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$torneo->id}}">Editar</button>
                                
                                <!-- Formulario Eliminar -->
                                <form action="{{ route('torneos.destroy', $torneo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminar este torneo?')">Eliminar</button>
                                </form>

                                <!-- MODAL DE EDICIÓN -->
                                <div class="modal fade" id="editModal{{$torneo->id}}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Actualizar Torneo</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                      </div>
                                      <div class="modal-body text-start">
                                        <form action="{{ route('torneos.update', $torneo->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label>Nombre del Torneo</label>
                                                <input type="text" name="nombre" class="form-control" value="{{ $torneo->nombre }}" required>
                                            </div>
                                            
                                            <!-- Selector de Temporada en Edición -->
                                            <div class="mb-3">
                                                <label>Temporada a la que pertenece</label>
                                                <select name="temporada_id" class="form-control" required>
                                                    <option value="">Selecciona una temporada...</option>
                                                    @foreach($temporadas as $temporada)
                                                        <!-- Marca la temporada actual como seleccionada -->
                                                        <option value="{{ $temporada->id }}" {{ $torneo->temporada_id == $temporada->id ? 'selected' : '' }}>
                                                            Temporada {{ $temporada->año_inicio }} - {{ $temporada->año_fin }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-warning">Actualizar</button>
                                            </div>
                                        </form>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- FIN MODAL DE EDICIÓN -->
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
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Registrar Torneo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body text-start">
            <form action="{{ route('torneos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nombre del Torneo</label>
                    <input type="text" name="nombre" class="form-control" placeholder="Ej. Torneo de Verano" required>
                </div>
                
                <!-- Selector de Temporada en Creación -->
                <div class="mb-3">
                    <label>Temporada a la que pertenece</label>
                    <select name="temporada_id" class="form-control" required>
                        <option value="">Selecciona una temporada...</option>
                        @foreach($temporadas as $temporada)
                            <option value="{{ $temporada->id }}">
                                Temporada {{ $temporada->año_inicio }} - {{ $temporada->año_fin }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>