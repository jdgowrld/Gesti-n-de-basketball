<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Sedes y Canchas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    

    <x-navbar />



    <div class="container mt-4">

        <h1 class="text-center mb-4">Sedes de la Liga</h1>



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

                    Registrar Sede

                </button>

            </div>

        </div>



        <div class="row">

            <div class="col-lg-10 offset-lg-1">

                <table class="table table-bordered bg-white shadow-sm text-center">

                    <thead class="table-dark">

                        <tr>

                            <th>Nombre de la Cancha</th>

                            <th>Dirección</th>

                            <th>Capacidad</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($canchas as $cancha)

                        <tr>

                            <td class="fw-bold">{{ $cancha->nombre }}</td>

                            <td>{{ $cancha->direccion }}</td>

                            <td>{{ $cancha->capacidad ?? 'N/A' }}</td>

                            <td>

                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$cancha->id}}">Editar</button>

                                

                                <form action="{{ route('canchas.destroy', $cancha->id) }}" method="POST" class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar esta sede?')">Borrar</button>

                                </form>



                                <x-modal id="editModal{{$cancha->id}}" title="Actualizar Sede">

                                    <form action="{{ route('canchas.update', $cancha->id) }}" method="POST" novalidate>

                                        @csrf

                                        @method('PUT')

                                        <x-input-field name="nombre" label="Nombre" :value="$cancha->nombre" />

                                        <x-input-field name="direccion" label="Dirección" :value="$cancha->direccion" />

                                        <x-input-field name="capacidad" label="Capacidad (Opcional)" type="number" :value="$cancha->capacidad" :required="false" />

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



    <x-modal id="createModal" title="Registrar Nueva Sede">

        <form action="{{ route('canchas.store') }}" method="POST" novalidate>

            @csrf

            <x-input-field name="nombre" label="Nombre" placeholder="Ej. Auditorio Municipal" />

            <x-input-field name="direccion" label="Dirección" placeholder="Ej. Centro Histórico" />

            <x-input-field name="capacidad" label="Capacidad (Opcional)" type="number" placeholder="Ej. 1500" :required="false" />

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <button type="submit" class="btn btn-primary">Registrar</button>

            </div>

        </form>

    </x-modal>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

