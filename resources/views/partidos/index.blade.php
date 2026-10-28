<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Gestión de Partidos</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    

    <x-navbar />



    <div class="container mt-4">

        <h1 class="text-center mb-4">Calendario de Partidos</h1>



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

            <div class="col-lg-12">

                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">

                    Agendar Partido

                </button>

            </div>

        </div>



        <div class="row">

            <div class="col-lg-12">

                <table class="table table-bordered bg-white shadow-sm text-center">

                    <thead class="table-dark">

                        <tr>

                            <th>Torneo</th>

                            <th>Local</th>

                            <th>VS</th>

                            <th>Visitante</th>

                            <th>Fecha</th>

                            <th>Hora</th>

                            <th>Estado</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($partidos as $partido)

                        <tr>

                            <td>{{ $partido->torneo->nombre ?? 'N/A' }}</td>

                            <td class="fw-bold">{{ $partido->equipoLocal->nombre ?? 'N/A' }}</td>

                            <td>🏀</td>

                            <td class="fw-bold">{{ $partido->equipoVisitante->nombre ?? 'N/A' }}</td>

                            <td>{{ \Carbon\Carbon::parse($partido->fecha)->format('d/m/Y') }}</td>

                            <td>{{ \Carbon\Carbon::parse($partido->hora)->format('H:i') }}</td>

                            <td>

                                <span class="badge bg-{{ $partido->estado == 'Programado' ? 'info' : ($partido->estado == 'En Juego' ? 'warning' : 'success') }}">

                                    {{ $partido->estado }}

                                </span>

                            </td>

                            <td>

                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{$partido->id}}">Editar</button>

                                

                                <form action="{{ route('partidos.destroy', $partido->id) }}" method="POST" class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este partido del calendario?')">Borrar</button>

                                </form>



                                <x-modal id="editModal{{$partido->id}}" title="Actualizar Partido">

                                    <form action="{{ route('partidos.update', $partido->id) }}" method="POST" novalidate>

                                        @csrf

                                        @method('PUT')

                                        

                                        <div class="mb-3">

                                            <label class="form-label">Torneo</label>

                                            <select name="torneo_id" class="form-control @error('torneo_id') is-invalid @enderror" required>

                                                @foreach($torneos as $torneo)

                                                    <option value="{{ $torneo->id }}" {{ (old('torneo_id', $partido->torneo_id) == $torneo->id) ? 'selected' : '' }}>{{ $torneo->nombre }}</option>

                                                @endforeach

                                            </select>

                                            @error('torneo_id')

                                                <div class="invalid-feedback">{{ $message }}</div>

                                            @enderror

                                        </div>

                                        

                                        <div class="row">

                                            <div class="col-md-6 mb-3">

                                                <label class="form-label">Equipo Local</label>

                                                <select name="equipo_local_id" class="form-control @error('equipo_local_id') is-invalid @enderror" required>

                                                    @foreach($equipos as $equipo)

                                                        <option value="{{ $equipo->id }}" {{ (old('equipo_local_id', $partido->equipo_local_id) == $equipo->id) ? 'selected' : '' }}>{{ $equipo->nombre }}</option>

                                                    @endforeach

                                                </select>

                                                @error('equipo_local_id')

                                                    <div class="invalid-feedback">{{ $message }}</div>

                                                @enderror

                                            </div>

                                            <div class="col-md-6 mb-3">

                                                <label class="form-label">Equipo Visitante</label>

                                                <select name="equipo_visitante_id" class="form-control @error('equipo_visitante_id') is-invalid @enderror" required>

                                                    @foreach($equipos as $equipo)

                                                        <option value="{{ $equipo->id }}" {{ (old('equipo_visitante_id', $partido->equipo_visitante_id) == $equipo->id) ? 'selected' : '' }}>{{ $equipo->nombre }}</option>

                                                    @endforeach

                                                </select>

                                                @error('equipo_visitante_id')

                                                    <div class="invalid-feedback">{{ $message }}</div>

                                                @enderror

                                            </div>

                                        </div>



                                        <div class="row">

                                            <div class="col-md-6">

                                                <x-input-field name="fecha" label="Fecha" type="date" :value="$partido->fecha" />

                                            </div>

                                            <div class="col-md-6">

                                                <x-input-field name="hora" label="Hora" type="time" :value="$partido->hora" />

                                            </div>

                                        </div>



                                        <div class="mb-3">

                                            <label class="form-label">Estado del Partido</label>

                                            <select name="estado" class="form-control fw-bold @error('estado') is-invalid @enderror" required>

                                                <option value="Programado" {{ (old('estado', $partido->estado) == 'Programado') ? 'selected' : '' }}>Programado</option>

                                                <option value="En Juego" {{ (old('estado', $partido->estado) == 'En Juego') ? 'selected' : '' }} class="text-warning">En Juego</option>

                                                <option value="Finalizado" {{ (old('estado', $partido->estado) == 'Finalizado') ? 'selected' : '' }} class="text-success">Finalizado</option>

                                            </select>

                                            @error('estado')

                                                <div class="invalid-feedback">{{ $message }}</div>

                                            @enderror

                                        </div>



                                        <div class="modal-footer">

                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                                            <button type="submit" class="btn btn-warning">Actualizar Estado</button>

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



    <x-modal id="createModal" title="Agendar Nuevo Partido">

        <form action="{{ route('partidos.store') }}" method="POST" novalidate>

            @csrf

            <div class="mb-3">

                <label class="form-label">Torneo</label>

                <select name="torneo_id" class="form-control @error('torneo_id') is-invalid @enderror" required>

                    <option value="">Selecciona un torneo...</option>

                    @foreach($torneos as $torneo)

                        <option value="{{ $torneo->id }}" {{ old('torneo_id') == $torneo->id ? 'selected' : '' }}>{{ $torneo->nombre }}</option>

                    @endforeach

                </select>

                @error('torneo_id')

                    <div class="invalid-feedback">{{ $message }}</div>

                @enderror

            </div>

            

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">Equipo Local</label>

                    <select name="equipo_local_id" class="form-control @error('equipo_local_id') is-invalid @enderror" required>

                        <option value="">Local...</option>

                        @foreach($equipos as $equipo)

                            <option value="{{ $equipo->id }}" {{ old('equipo_local_id') == $equipo->id ? 'selected' : '' }}>{{ $equipo->nombre }}</option>

                        @endforeach

                    </select>

                    @error('equipo_local_id')

                        <div class="invalid-feedback">{{ $message }}</div>

                    @enderror

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">Equipo Visitante</label>

                    <select name="equipo_visitante_id" class="form-control @error('equipo_visitante_id') is-invalid @enderror" required>

                        <option value="">Visitante...</option>

                        @foreach($equipos as $equipo)

                            <option value="{{ $equipo->id }}" {{ old('equipo_visitante_id') == $equipo->id ? 'selected' : '' }}>{{ $equipo->nombre }}</option>

                        @endforeach

                    </select>

                    @error('equipo_visitante_id')

                        <div class="invalid-feedback">{{ $message }}</div>

                    @enderror

                </div>

            </div>



            <div class="row">

                <div class="col-md-6">

                    <x-input-field name="fecha" label="Fecha" type="date" value="{{ old('fecha') }}" />

                </div>

                <div class="col-md-6">

                    <x-input-field name="hora" label="Hora" type="time" value="{{ old('hora') }}" />

                </div>

            </div>



            <div class="mb-3">

                <label class="form-label">Estado</label>

                <select name="estado" class="form-control @error('estado') is-invalid @enderror" required>

                    <option value="Programado" {{ old('estado') == 'Programado' ? 'selected' : '' }}>Programado</option>

                    <option value="En Juego" {{ old('estado') == 'En Juego' ? 'selected' : '' }}>En Juego</option>

                    <option value="Finalizado" {{ old('estado') == 'Finalizado' ? 'selected' : '' }}>Finalizado</option>

                </select>

                @error('estado')

                    <div class="invalid-feedback">{{ $message }}</div>

                @enderror

            </div>



            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <button type="submit" class="btn btn-primary">Agendar</button>

            </div>

        </form>

    </x-modal>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

