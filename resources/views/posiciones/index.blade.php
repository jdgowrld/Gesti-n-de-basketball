<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Catálogo de Posiciones</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    

    <x-navbar />



    <div class="container mt-4">

        <h1 class="text-center mb-4">Posiciones de Juego</h1>



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

                    Nueva Posición

                </button>

            </div>

        </div>



        <div class="row">

            <div class="col-lg-10 offset-lg-1">

                <table class="table table-bordered bg-white shadow-sm text-center">

                    <thead class="table-dark">

                        <tr>

                            <th>Nombre</th>

                            <th>Abreviatura</th>

                            <th>Descripción</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($posiciones as $posicion)

                        <tr>

                            <td class="fw-bold">{{ $posicion->nombre }}</td>

                            <td><span class="badge bg-secondary">{{ $posicion->abreviatura ?? 'N/A' }}</span></td>

                            <td>{{ $posicion->descripcion ?? 'Sin descripción' }}</td>

                            <td>

                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$posicion->id}}">Editar</button>

                                

                                <form action="{{ route('posiciones.destroy', $posicion->id) }}" method="POST" class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta posición?')">Eliminar</button>

                                </form>



                                <x-modal id="editModal{{$posicion->id}}" title="Actualizar Posición">

                                    <form action="{{ route('posiciones.update', $posicion->id) }}" method="POST" novalidate>

                                        @csrf

                                        @method('PUT')

                                        <x-input-field name="nombre" label="Nombre de Posición" :value="$posicion->nombre" />

                                        <x-input-field name="abreviatura" label="Abreviatura" placeholder="Ej. PG, SG, SF..." :value="$posicion->abreviatura" :required="false" />

                                        <div class="mb-3">

                                            <label class="form-label">Descripción</label>

                                            <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="2">{{ old('descripcion', $posicion->descripcion) }}</textarea>

                                            @error('descripcion')

                                                <div class="invalid-feedback">{{ $message }}</div>

                                            @enderror

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



    <x-modal id="createModal" title="Registrar Nueva Posición">

        <form action="{{ route('posiciones.store') }}" method="POST" novalidate>

            @csrf

            <x-input-field name="nombre" label="Nombre de Posición" placeholder="Ej. Base" />

            <x-input-field name="abreviatura" label="Abreviatura" placeholder="Ej. PG" :required="false" />

            <div class="mb-3">

                <label class="form-label">Descripción</label>

                <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" rows="2" placeholder="Opcional...">{{ old('descripcion') }}</textarea>

                @error('descripcion')

                    <div class="invalid-feedback">{{ $message }}</div>

                @enderror

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

