<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Gestión de Equipos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <x-navbar />

    <div class="container mt-4">
        <h1 class="text-center mb-4">Franquicias de la Liga</h1>

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
                    Registrar Nuevo Equipo
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <table class="table table-bordered bg-white shadow-sm">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Ciudad</th>
                            <th>Logo (URL)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($equipos as $equipo)
                        <tr>
                            <td>{{ $equipo->id }}</td>
                            <td>{{ $equipo->nombre }}</td>
                            <td>{{ $equipo->ciudad }}</td>
                            <td>{{ $equipo->logo ?? 'N/A' }}</td>
                            <td>
                                <!-- Botón Editar -->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$equipo->id}}">Editar</button>
                                
                                <!-- Formulario Eliminar -->
                                <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres dar de baja este equipo?')">Eliminar</button>
                                </form>

                                <!-- MODAL DE EDICIÓN REFATORIZADO CON EL COMPONENTE -->
                                <x-modal id="editModal{{$equipo->id}}" title="Actualizar Equipo">
                                    <form action="{{ route('equipos.update', $equipo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label>Nombre del Equipo</label>
                                            <input type="text" name="nombre" class="form-control" value="{{ $equipo->nombre }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Ciudad</label>
                                            <input type="text" name="ciudad" class="form-control" value="{{ $equipo->ciudad }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Logo (URL)</label>
                                            <input type="text" name="logo" class="form-control" value="{{ $equipo->logo }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-warning">Actualizar</button>
                                        </div>
                                    </form>
                                </x-modal>
                                <!-- FIN MODAL DE EDICIÓN -->
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL DE CREACIÓN REFACTORIZADO CON EL COMPONENTE -->
    <x-modal id="createModal" title="Registrar Equipo">
        <form action="{{ route('equipos.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nombre del Equipo</label>
                <input type="text" name="nombre" class="form-control" placeholder="Ej. Toros de Torreón" required>
            </div>
            <div class="mb-3">
                <label>Ciudad</label>
                <input type="text" name="ciudad" class="form-control" placeholder="Ej. Torreón" required>
            </div>
            <div class="mb-3">
                <label>Logo (Opcional - URL)</label>
                <input type="text" name="logo" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </x-modal>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>