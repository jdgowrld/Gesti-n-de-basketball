<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Gestión de Temporadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <x-navbar />

    <div class="container mt-4">
        <h1 class="text-center mb-4">Temporadas</h1>

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
                    Nueva Temporada
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <table class="table table-bordered bg-white shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Año Inicio</th>
                            <th>Año Fin</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($temporadas as $temporada)
                        <tr>
                            <td>{{ $temporada->id }}</td>
                            <td>{{ $temporada->año_inicio }}</td>
                            <td>{{ $temporada->año_fin }}</td>
                            <td>
                                @if($temporada->estado)
                                    <span class="badge bg-success">Activa</span>
                                @else
                                    <span class="badge bg-secondary">Terminada</span>
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$temporada->id}}">Editar</button>
                                
                                <form action="{{ route('temporadas.destroy', $temporada->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres eliminarla?')">Eliminar</button>
                                </form>

                                <!-- MODAL DE EDICIÓN -->
                                <div class="modal fade" id="editModal{{$temporada->id}}" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Actualizar Temporada</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                      </div>
                                      <div class="modal-body text-start">
                                        <form action="{{ route('temporadas.update', $temporada->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label>Año de Inicio</label>
                                                <input type="number" name="año_inicio" class="form-control" value="{{ $temporada->año_inicio }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label>Año de Fin</label>
                                                <input type="number" name="año_fin" class="form-control" value="{{ $temporada->año_fin }}" required>
                                            </div>
                                            <div class="mb-3 form-check">
                                                <!-- Mantiene el check si estaba activa -->
                                                <input type="checkbox" name="estado" class="form-check-input" {{ $temporada->estado ? 'checked' : '' }}>
                                                <label class="form-check-label">Temporada Activa</label>
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
            <h5 class="modal-title">Registrar Temporada</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body text-start">
            <form action="{{ route('temporadas.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Año de Inicio</label>
                    <input type="number" name="año_inicio" class="form-control" placeholder="Ej. 2026" required>
                </div>
                <div class="mb-3">
                    <label>Año de Fin</label>
                    <input type="number" name="año_fin" class="form-control" placeholder="Ej. 2027" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" name="estado" class="form-check-input" checked>
                    <label class="form-check-label">Temporada Activa</label>
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