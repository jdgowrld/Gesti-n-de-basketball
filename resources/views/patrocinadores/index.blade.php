<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Patrocinadores Oficiales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <x-navbar />

    <div class="container mt-4">
        <h1 class="text-center mb-4">Marcas y Patrocinadores</h1>

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
                    Registrar Marca
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <table class="table table-bordered bg-white shadow-sm text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Marca (Sponsor)</th>
                            <th>Industria</th>
                            <th>Monto de Aportación ($)</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($patrocinadores as $patrocinador)
                        <tr>
                            <td class="fw-bold">{{ $patrocinador->nombre }}</td>
                            <td>{{ $patrocinador->industria ?? 'N/A' }}</td>
                            <td class="text-success fw-bold">${{ number_format($patrocinador->monto_patrocinio, 2) }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$patrocinador->id}}">Editar</button>
                                
                                <form action="{{ route('patrocinadores.destroy', $patrocinador->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta marca?')">Eliminar</button>
                                </form>

                                <!-- MODAL DE EDICIÓN -->
                                <x-modal id="editModal{{$patrocinador->id}}" title="Actualizar Patrocinador">
                                    <form action="{{ route('patrocinadores.update', $patrocinador->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label>Nombre de la Marca</label>
                                            <input type="text" name="nombre" class="form-control" value="{{ $patrocinador->nombre }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Industria</label>
                                            <input type="text" name="industria" class="form-control" value="{{ $patrocinador->industria }}" placeholder="Ej. Calzado, Bebidas...">
                                        </div>
                                        <div class="mb-3">
                                            <label>Monto Aportado ($)</label>
                                            <input type="number" step="0.01" name="monto_patrocinio" class="form-control" value="{{ $patrocinador->monto_patrocinio }}">
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
    <x-modal id="createModal" title="Registrar Nueva Marca">
        <form action="{{ route('patrocinadores.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nombre de la Marca</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Industria (Opcional)</label>
                <input type="text" name="industria" class="form-control" placeholder="Ej. Calzado, Bebidas...">
            </div>
            <div class="mb-3">
                <label>Monto Aportado ($)</label>
                <input type="number" step="0.01" name="monto_patrocinio" class="form-control" value="0.00">
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