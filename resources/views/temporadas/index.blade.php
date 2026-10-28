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

        <h1 class="text-center mb-4">Gestión de Temporadas</h1>



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

                    Registrar Temporada

                </button>

            </div>

        </div>



        <div class="row">

            <div class="col-lg-10 offset-lg-1">

                <table class="table table-bordered bg-white shadow-sm text-center">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>

                            <th>Año Inicio</th>

                            <th>Año Fin</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($temporadas as $temporada)

                        <tr>

                            <td>{{ $temporada->id }}</td>

                            <td class="fw-bold">{{ $temporada->año_inicio }}</td>

                            <td>{{ $temporada->año_fin }}</td>

                            <td>

                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$temporada->id}}">Editar</button>

                                

                                <form action="{{ route('temporadas.destroy', $temporada->id) }}" method="POST" class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta temporada?')">Eliminar</button>

                                </form>



                                <x-modal id="editModal{{$temporada->id}}" title="Actualizar Temporada">

                                    <form action="{{ route('temporadas.update', $temporada->id) }}" method="POST" novalidate>

                                        @csrf

                                        @method('PUT')

                                        <x-input-field name="año_inicio" label="Año de Inicio" type="number" :value="$temporada->año_inicio" />

                                        <x-input-field name="año_fin" label="Año de Fin" type="number" :value="$temporada->año_fin" />

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



    <x-modal id="createModal" title="Registrar Nueva Temporada">

        <form action="{{ route('temporadas.store') }}" method="POST" novalidate>

            @csrf

            <x-input-field name="año_inicio" label="Año de Inicio" type="number" placeholder="Ej. 2025" />

            <x-input-field name="año_fin" label="Año de Fin" type="number" placeholder="Ej. 2026" />

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <button type="submit" class="btn btn-primary">Registrar</button>

            </div>

        </form>

    </x-modal>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

