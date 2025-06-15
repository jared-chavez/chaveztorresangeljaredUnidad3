@extends('layouts.app')

@section('content')
<div class="cars-page-flex">
    <div class="cars-form-col">
        <div class="contact-section">
            <div class="contact-form-container">
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
            </div>
        </div>
    </div>
    <div class="cars-list-col">
        <h2>Lista de Autos</h2>
        <input type="text" id="car-search" placeholder="Buscar por marca o modelo..." style="margin-bottom:24px;max-width:350px;width:100%;padding:10px 14px;border-radius:8px;border:1px solid #d1d5db;font-size:1em;">
        <div class="car-cards-container">
            @foreach($cars as $car)
                <div class="car-card car-card-filter" data-brand="{{ strtolower($car->brand) }}" data-model="{{ strtolower($car->model) }}">
                    <div class="car-card-img">
                        <img src="https://images.pexels.com/photos/358070/pexels-photo-358070.jpeg?auto=compress&w=600&h=400&fit=crop" alt="{{ $car->brand }} {{ $car->model }}">
                    </div>
                    <div class="car-card-body">
                        <div class="car-card-year">{{ $car->year }}</div>
                        <div class="car-card-title">{{ $car->brand }} {{ $car->model }}</div>
                        <form method="POST" action="{{ route('cars.update', $car->id) }}" class="car-card-action-form" style="margin-bottom:10px;">
                            @csrf
                            @method('PUT')
                            <input type="text" name="brand" value="{{ $car->brand }}" required>
                            <input type="text" name="model" value="{{ $car->model }}" required>
                            <input type="number" name="year" value="{{ $car->year }}" min="1900" max="{{ date('Y') + 1 }}" required>
                            <button type="submit" class="car-card-btn car-card-btn-update" style="width:100%;margin-top:8px;">Actualizar</button>
                        </form>
                        <form method="POST" action="{{ route('cars.destroy', $car->id) }}" class="car-card-action-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="car-card-btn car-card-btn-delete" style="width:100%;" onclick="return confirm('¿Seguro que deseas eliminar este auto?')">Eliminar</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
document.getElementById('car-search').addEventListener('input', function() {
    const value = this.value.trim().toLowerCase();
    document.querySelectorAll('.car-card-filter').forEach(card => {
        const brand = card.getAttribute('data-brand');
        const model = card.getAttribute('data-model');
        if (brand.includes(value) || model.includes(value)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
});
</script>
@endsection 