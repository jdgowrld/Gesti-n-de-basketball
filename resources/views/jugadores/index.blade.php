<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Roster de Jugadores</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    

    <x-navbar />



    <div class="container mt-4">

        <h1 class="text-center mb-4">Roster Oficial de Jugadores</h1>



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

                    Registrar Nuevo Jugador

                </button>

            </div>

        </div>



        <div class="row">

            <div class="col-lg-10 offset-lg-1">

                <table class="table table-bordered bg-white shadow-sm text-center">

                    <thead class="table-dark">

                        <tr>

                            <th>ID</th>

                            <th>Nombre</th>

                            <th>Dorsal (#)</th>

                            <th>Posición</th>

                            <th>Equipo</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($jugadores as $jugador)

                        <tr>

                            <td>{{ $jugador->id }}</td>

                            <td class="fw-bold">{{ $jugador->nombre }}</td>

                            <td>{{ $jugador->numero }}</td>

                            <td>{{ $jugador->posicion->nombre ?? 'N/A' }}</td>

                            <td>{{ $jugador->equipo->nombre ?? 'N/A' }}</td>

                            <td>

                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$jugador->id}}">Editar</button>

                                

                                <form action="{{ route('jugadores.destroy', $jugador->id) }}" method="POST" class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que quieres dar de baja a este jugador?')">Eliminar</button>

                                </form>



                                <x-modal id="editModal{{$jugador->id}}" title="Actualizar Jugador">

                                    <form action="{{ route('jugadores.update', $jugador->id) }}" method="POST" novalidate>

                                        @csrf

                                        @method('PUT')

                                        <x-input-field name="nombre" label="Nombre Completo" :value="$jugador->nombre" />



                                        <div class="row">

                                            <div class="col-md-6">

                                                <x-input-field name="numero" label="Dorsal (#)" type="number" :value="$jugador->numero" />

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label class="form-label">Posición</label>

                                                <select name="posicion_id" class="form-control @error('posicion_id') is-invalid @enderror" required>

                                                    <option value="">Selecciona una posición</option>

                                                    @foreach($posiciones as $posicion)

                                                        <option value="{{ $posicion->id }}" {{ (old('posicion_id', $jugador->posicion_id) == $posicion->id) ? 'selected' : '' }}>

                                                            {{ $posicion->nombre }}

                                                        </option>

                                                    @endforeach

                                                </select>

                                                @error('posicion_id')

                                                    <div class="invalid-feedback">{{ $message }}</div>

                                                @enderror

                                            </div>

                                        </div>



                                        <div class="mb-3">

                                            <label class="form-label">Equipo</label>

                                            <select name="equipo_id" class="form-control @error('equipo_id') is-invalid @enderror" required>

                                                <option value="">Selecciona un equipo...</option>

                                                @foreach($equipos as $equipo)

                                                    <option value="{{ $equipo->id }}" {{ (old('equipo_id', $jugador->equipo_id) == $equipo->id) ? 'selected' : '' }}>

                                                        {{ $equipo->nombre }}

                                                    </option>

                                                @endforeach

                                            </select>

                                            @error('equipo_id')

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



    <x-modal id="createModal" title="Fichar Jugador">

        <form action="{{ route('jugadores.store') }}" method="POST" novalidate>

            @csrf

            <x-input-field name="nombre" label="Nombre Completo" placeholder="Ej. LeBron James" />

            

            <div class="row">

                <div class="col-md-6">

                    <x-input-field name="numero" label="Dorsal (#)" type="number" />

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Posición</label>

                    <select name="posicion_id" class="form-control @error('posicion_id') is-invalid @enderror" required>

                        <option value="">Selecciona...</option>

                        @foreach($posiciones as $posicion)

                            <option value="{{ $posicion->id }}" {{ old('posicion_id') == $posicion->id ? 'selected' : '' }}>

                                {{ $posicion->nombre }}

                            </option>

                        @endforeach

                    </select>

                    @error('posicion_id')

                        <div class="invalid-feedback">{{ $message }}</div>

                    @enderror

                </div>

            </div>



            <div class="mb-3">

                <label class="form-label">Equipo</label>

                <select name="equipo_id" class="form-control @error('equipo_id') is-invalid @enderror" required>

                    <option value="">Selecciona un equipo...</option>

                    @foreach($equipos as $equipo)

                        <option value="{{ $equipo->id }}" {{ old('equipo_id') == $equipo->id ? 'selected' : '' }}>

                            {{ $equipo->nombre }}

                        </option>

                    @endforeach

                </select>

                @error('equipo_id')

                    <div class="invalid-feedback">{{ $message }}</div>

                @enderror

            </div>



            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <button type="submit" class="btn btn-primary">Fichar Jugador</button>

            </div>

        </form>

    </x-modal>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

