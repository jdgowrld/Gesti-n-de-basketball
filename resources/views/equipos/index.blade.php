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
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$equipo->id}}">Editar</button>
                                
                                <form action="{{ route('equipos.destroy', $equipo->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres dar de baja este equipo?')">Eliminar</button>
                                </form>

                                <x-modal id="editModal{{$equipo->id}}" title="Actualizar Equipo">
                                    <form action="{{ route('equipos.update', $equipo->id) }}" method="POST" novalidate>
                                        @csrf
                                        @method('PUT')
                                        
                                        <x-input-field name="nombre" label="Nombre del Equipo" :value="$equipo->nombre" />
                                        <x-input-field name="ciudad" label="Ciudad" :value="$equipo->ciudad" />
                                        <x-input-field name="logo" label="Logo (URL)" :value="$equipo->logo" :required="false" />

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

    <x-modal id="createModal" title="Registrar Nuevo Equipo">
        <form action="{{ route('equipos.store') }}" method="POST" novalidate>
            @csrf
            
            <x-input-field name="nombre" label="Nombre del Equipo" placeholder="Ej. Toros de Torreón" />
            <x-input-field name="ciudad" label="Ciudad" placeholder="Ej. Torreón" />
            <x-input-field name="logo" label="Logo (Opcional - URL)" placeholder="https://..." :required="false" />

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar Equipo</button>
            </div>
        </form>
    </x-modal>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>