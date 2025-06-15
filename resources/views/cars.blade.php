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
                        <input type="text" name="brand" id="brand" value="{{ old('brand') }}">
                    </div>
                    <div>
                        <label for="model">Modelo</label>
                        <input type="text" name="model" id="model" value="{{ old('model') }}">
                    </div>
                    <div>
                        <label for="year">Año</label>
                        <input type="number" name="year" id="year" value="{{ old('year') }}" min="1900" max="{{ date('Y') + 1 }}">
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
                        <form method="POST" action="{{ route('cars.update', $car->id) }}" class="car-card-action-form" style="flex-direction: column; gap: 8px; margin-bottom:10px;">
                            @csrf
                            @method('PUT')
                            <div style="display: flex; gap: 6px;">
                                <span style="display: flex; align-items: center;"><img src='https://img.icons8.com/ios-filled/20/007bff/car.png' alt='Marca'></span>
                                <input type="text" name="brand" value="{{ $car->brand }}" placeholder="Marca">
                            </div>
                            <div style="display: flex; gap: 6px;">
                                <span style="display: flex; align-items: center;"><img src='https://img.icons8.com/ios-filled/20/007bff/identity-theft.png' alt='Modelo'></span>
                                <input type="text" name="model" value="{{ $car->model }}" placeholder="Modelo">
                            </div>
                            <div style="display: flex; gap: 6px;">
                                <span style="display: flex; align-items: center;"><img src='https://img.icons8.com/ios-filled/20/007bff/calendar--v1.png' alt='Año'></span>
                                <input type="number" name="year" value="{{ $car->year }}" min="1900" max="{{ date('Y') + 1 }}" placeholder="Año">
                            </div>
                            <button type="submit" class="car-card-btn car-card-btn-update" style="width:100%;margin-top:8px;display:flex;align-items:center;justify-content:center;gap:6px;">
                                <img src="https://img.icons8.com/ios-filled/20/ffffff/refresh.png" alt="Actualizar"> Actualizar
                            </button>
                        </form>
                        <form method="POST" action="{{ route('cars.destroy', $car->id) }}" class="car-card-action-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="car-card-btn car-card-btn-delete" style="width:100%;display:flex;align-items:center;justify-content:center;gap:6px;">
                                <img src="https://img.icons8.com/ios-filled/20/ffffff/delete-sign.png" alt="Eliminar"> Eliminar
                            </button>
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

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success'))
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session('success') }}',
        confirmButtonText: 'Aceptar',
    });
@endif

document.querySelectorAll('.car-card-btn-delete').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const form = this.closest('form');
        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Esta acción no se puede deshacer. El auto será eliminado.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff9800',
            cancelButtonColor: '#aaa',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
@endsection 