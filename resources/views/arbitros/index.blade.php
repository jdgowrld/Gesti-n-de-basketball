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

                                <!-- MODAL DE EDICIÓN CON COMPONENTES -->
                                <x-modal id="editModal{{$arbitro->id}}" title="Actualizar Árbitro">
                                    <form action="{{ route('arbitros.update', $arbitro->id) }}" method="POST" novalidate>
                                        @csrf
                                        @method('PUT')
                                        
                                        <x-input-field name="nombre" label="Nombre Completo" :value="$arbitro->nombre" />
                                        <x-input-field name="experiencia_anios" label="Años de Experiencia" type="number" :value="$arbitro->experiencia_anios" />
                                        <x-input-field name="certificacion" label="Certificación (Opcional)" placeholder="Ej. FIBA, Nacional..." :value="$arbitro->certificacion" :required="false" />

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

    <!-- MODAL DE CREACIÓN CON COMPONENTES -->
    <x-modal id="createModal" title="Registrar Nuevo Árbitro">
        <form action="{{ route('arbitros.store') }}" method="POST" novalidate>
            @csrf
            
            <x-input-field name="nombre" label="Nombre Completo" placeholder="Nombre del árbitro" />
            <x-input-field name="experiencia_anios" label="Años de Experiencia" type="number" value="0" />
            <x-input-field name="certificacion" label="Certificación (Opcional)" placeholder="Ej. FIBA, Nacional..." />

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </form>
    </x-modal>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>