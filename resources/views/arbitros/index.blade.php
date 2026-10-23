<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Padrón de Árbitros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <x-navbar />

    <div class="container mt-4">
        <h1 class="text-center mb-4">Padrón de Árbitros</h1>

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
                    Registrar Árbitro
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <table class="table table-bordered bg-white shadow-sm text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Experiencia (Años)</th>
                            <th>Certificación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arbitros as $arbitro)
                        <tr>
                            <td class="fw-bold">{{ $arbitro->nombre }}</td>
                            <td>{{ $arbitro->experiencia_anios }}</td>
                            <td>{{ $arbitro->certificacion ?? 'Ninguna' }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$arbitro->id}}">Editar</button>
                                
                                <form action="{{ route('arbitros.destroy', $arbitro->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Dar de baja a este árbitro?')">Eliminar</button>
                                </form>

                                <!-- MODAL DE EDICIÓN -->
                                <x-modal id="editModal{{$arbitro->id}}" title="Actualizar Árbitro">
                                    <form action="{{ route('arbitros.update', $arbitro->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label>Nombre Completo</label>
                                            <input type="text" name="nombre" class="form-control" value="{{ $arbitro->nombre }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Años de Experiencia</label>
                                            <input type="number" name="experiencia_anios" class="form-control" value="{{ $arbitro->experiencia_anios }}" min="0" required>
                                        </div>
                                        <div class="mb-3">
                                            <label>Certificación (Opcional)</label>
                                            <input type="text" name="certificacion" class="form-control" value="{{ $arbitro->certificacion }}" placeholder="Ej. FIBA, Nacional...">
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
    <x-modal id="createModal" title="Registrar Nuevo Árbitro">
        <form action="{{ route('arbitros.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nombre Completo</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Años de Experiencia</label>
                <input type="number" name="experiencia_anios" class="form-control" value="0" min="0" required>
            </div>
            <div class="mb-3">
                <label>Certificación (Opcional)</label>
                <input type="text" name="certificacion" class="form-control" placeholder="Ej. FIBA, Nacional...">
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