<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Gestión de Uniformes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    
    <x-navbar />

    <div class="container mt-4">
        <h1 class="text-center mb-4">Uniformes de la Liga</h1>

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
                    Registrar Uniforme
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <table class="table table-bordered bg-white shadow-sm text-center align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Equipo</th>
                            <th>Tipo</th>
                            <th>Color Principal</th>
                            <th>Color Secundario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($uniformes as $uniforme)
                        <tr>
                            <td class="fw-bold">{{ $uniforme->equipo->nombre ?? 'N/A' }}</td>
                            <td>{{ $uniforme->tipo }}</td>
                            <td>
                                <span class="badge" style="background-color: {{ $uniforme->color_principal }}; color: #fff; text-shadow: 1px 1px 2px black;">
                                    {{ $uniforme->color_principal }}
                                </span>
                            </td>
                            <td>
                                @if($uniforme->color_secundario)
                                    <span class="badge" style="background-color: {{ $uniforme->color_secundario }}; color: #fff; text-shadow: 1px 1px 2px black;">
                                        {{ $uniforme->color_secundario }}
                                    </span>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$uniforme->id}}">Editar</button>
                                
                                <form action="{{ route('uniformes.destroy', $uniforme->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este uniforme?')">Borrar</button>
                                </form>

                                <!-- MODAL DE EDICIÓN -->
                                <x-modal id="editModal{{$uniforme->id}}" title="Actualizar Uniforme">
                                    <form action="{{ route('uniformes.update', $uniforme->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label>Equipo</label>
                                            <select name="equipo_id" class="form-control" required>
                                                @foreach($equipos as $equipo)
                                                    <option value="{{ $equipo->id }}" {{ $uniforme->equipo_id == $equipo->id ? 'selected' : '' }}>
                                                        {{ $equipo->nombre }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label>Tipo de Uniforme</label>
                                            <select name="tipo" class="form-control" required>
                                                <option value="Local" {{ $uniforme->tipo == 'Local' ? 'selected' : '' }}>Local</option>
                                                <option value="Visitante" {{ $uniforme->tipo == 'Visitante' ? 'selected' : '' }}>Visitante</option>
                                                <option value="Alternativo" {{ $uniforme->tipo == 'Alternativo' ? 'selected' : '' }}>Alternativo</option>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>Color Principal</label>
                                                <input type="color" name="color_principal" class="form-control form-control-color w-100" value="{{ $uniforme->color_principal }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>Color Secundario</label>
                                                <input type="color" name="color_secundario" class="form-control form-control-color w-100" value="{{ $uniforme->color_secundario ?? '#ffffff' }}">
                                            </div>
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
    <x-modal id="createModal" title="Registrar Uniforme">
        <form action="{{ route('uniformes.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Equipo</label>
                <select name="equipo_id" class="form-control" required>
                    <option value="">Selecciona un equipo...</option>
                    @foreach($equipos as $equipo)
                        <option value="{{ $equipo->id }}">{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Tipo de Uniforme</label>
                <select name="tipo" class="form-control" required>
                    <option value="">Selecciona...</option>
                    <option value="Local">Local</option>
                    <option value="Visitante">Visitante</option>
                    <option value="Alternativo">Alternativo</option>
                </select>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Color Principal</label>
                    <!-- El type="color" despliega la paleta de colores del sistema -->
                    <input type="color" name="color_principal" class="form-control form-control-color w-100" value="#000000" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>Color Secundario (Opcional)</label>
                    <input type="color" name="color_secundario" class="form-control form-control-color w-100" value="#ffffff">
                </div>
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