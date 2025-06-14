@extends('layouts.app')

@section('content')
    <h1>Gestión de Autos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Crear nuevo auto --}}
    <h2>Agregar Auto</h2>
    <form method="POST" action="{{ route('cars.store') }}">
        @csrf
        <div>
            <label for="brand">Marca</label>
            <input type="text" name="brand" id="brand" value="{{ old('brand') }}" required>
        </div>
        <div>
            <label for="model">Modelo</label>
            <input type="text" name="model" id="model" value="{{ old('model') }}" required>
        </div>
        <div>
            <label for="year">Año</label>
            <input type="number" name="year" id="year" value="{{ old('year') }}" min="1900" max="{{ date('Y') + 1 }}" required>
        </div>
        <button type="submit">Agregar</button>
    </form>

    {{-- Listar autos --}}
    <h2>Lista de Autos</h2>
    <table border="1" cellpadding="5">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cars as $car)
                <tr>
                    <td>{{ $car->id }}</td>
                    <td>{{ $car->brand }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->year }}</td>
                    <td>
                        {{-- Editar auto --}}
                        <form method="POST" action="{{ route('cars.update', $car->id) }}" style="display:inline-block;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="brand" value="{{ $car->brand }}" required>
                            <input type="text" name="model" value="{{ $car->model }}" required>
                            <input type="number" name="year" value="{{ $car->year }}" min="1900" max="{{ date('Y') + 1 }}" required>
                            <button type="submit">Actualizar</button>
                        </form>
                        {{-- Eliminar auto --}}
                        <form method="POST" action="{{ route('cars.destroy', $car->id) }}" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este auto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection 