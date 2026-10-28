<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Roster por Partido</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    

    <x-navbar />



    <div class="container mt-4">

        <h1 class="text-center mb-4">Convocatorias de Partido</h1>



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

                    Convocar Jugador

                </button>

            </div>

        </div>



        <div class="row">

            <div class="col-lg-10 offset-lg-1">

                <table class="table table-bordered bg-white shadow-sm text-center align-middle">

                    <thead class="table-dark">

                        <tr>

                            <th>Partido</th>

                            <th>Jugador Convocado</th>

                            <th>Equipo del Jugador</th>

                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($convocatorias as $conv)

                        <tr>

                            <td class="small">{{ $conv->partido->equipoLocal->nombre ?? 'L' }} vs {{ $conv->partido->equipoVisitante->nombre ?? 'V' }} ({{ \Carbon\Carbon::parse($conv->partido->fecha)->format('d/m') }})</td>

                            <td class="fw-bold">{{ $conv->jugador->nombre }}</td>

                            <td>{{ $conv->jugador->equipo->nombre ?? 'N/A' }}</td>

                            <td>

                                <form action="{{ route('convocatorias.destroy', $conv->id) }}" method="POST" class="d-inline">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Retirar jugador de este partido?')">Mandarlo out</button>

                                </form>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>



    <x-modal id="createModal" title="Agregar Jugador al Partido">

        <form action="{{ route('convocatorias.store') }}" method="POST" novalidate>

            @csrf

            <div class="mb-3">

                <label class="form-label">Partido</label>

                <select name="partido_id" class="form-control @error('partido_id') is-invalid @enderror" required>

                    <option value="">Selecciona el partido...</option>

                    @foreach($partidos as $partido)

                        <option value="{{ $partido->id }}" {{ old('partido_id') == $partido->id ? 'selected' : '' }}>

                            {{ $partido->equipoLocal->nombre ?? 'Local' }} vs {{ $partido->equipoVisitante->nombre ?? 'Visitante' }}

                        </option>

                    @endforeach

                </select>

                @error('partido_id')

                    <div class="invalid-feedback">{{ $message }}</div>

                @enderror

            </div>

            <div class="mb-3">

                <label class="form-label">Jugador a Convocar</label>

                <select name="jugador_id" class="form-control @error('jugador_id') is-invalid @enderror" required>

                    <option value="">Selecciona al jugador...</option>

                    @foreach($jugadores as $jugador)

                        <option value="{{ $jugador->id }}" {{ old('jugador_id') == $jugador->id ? 'selected' : '' }}>

                            {{ $jugador->nombre }} ({{ $jugador->equipo->nombre ?? 'Libre' }})

                        </option>

                    @endforeach

                </select>

                @error('jugador_id')

                    <div class="invalid-feedback">{{ $message }}</div>

                @enderror

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>

                <button type="submit" class="btn btn-primary">Guardar Convocatoria</button>

            </div>

        </form>

    </x-modal>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

