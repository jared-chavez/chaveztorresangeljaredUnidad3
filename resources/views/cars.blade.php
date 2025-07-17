@extends('layouts.app')

@section('content')
@auth
    @if(Auth::user()->role === 'admin' || Auth::user()->role === 'sales')
    <div class="cars-page-flex">
        <div class="cars-form-col">
            <div class="contact-section">
                <div class="contact-form-container">
                    <h2>Agregar Auto</h2>
                    <form id="create-car-form" enctype="multipart/form-data">
                        <div>
                            <label for="brand">Marca</label>
                            <input type="text" name="brand" id="brand">
                            <div class="input-error" id="brand-error"></div>
                        </div>
                        <div>
                            <label for="model">Modelo</label>
                            <input type="text" name="model" id="model">
                            <div class="input-error" id="model-error"></div>
                        </div>
                        <div>
                            <label for="year">Año</label>
                            <input type="number" name="year" id="year" min="1900" max="{{ date('Y') + 1 }}" value="{{ date('Y') }}">
                            <div class="input-error" id="year-error"></div>
                        </div>
                        <div>
                            <label for="modelImg">Imagen del Auto</label>
                            <div class="custom-file-upload">
                                <input type="file" name="modelImg" id="modelImg" accept="image/*" style="display:none;">
                                <label for="modelImg" id="modelImg-label" class="upload-btn">
                                    <i class="fas fa-camera"></i> <span id="modelImg-label-text">Seleccionar imagen</span>
                                </label>
                                <span id="modelImg-filename" class="file-name"></span>
                                <div id="modelImg-preview" style="margin-top:10px;"></div>
                                <div class="input-error" id="modelImg-error"></div>
                            </div>
                        </div>
                        <button type="submit" id="create-btn">Agregar</button>
                    </form>
                </div>
            </div>
        </div>
    @else
    <div class="cars-page-flex" style="grid-template-columns: 1fr;">
    @endif
@else
<div class="cars-page-flex" style="grid-template-columns: 1fr;">
@endauth
    <div class="cars-list-col">
        @auth
            @if(Auth::user()->role === 'sales')
                <div style="background: #e3f2fd; border: 1px solid #2196f3; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
                    <h3 style="margin: 0 0 8px 0; color: #1976d2;">
                        <i class="fas fa-info-circle"></i> Panel de Vendedor
                    </h3>
                    <p style="margin: 0; color: #1565c0;">
                        Aquí puedes gestionar el inventario completo de vehículos, crear nuevos autos, editar información y buscar por características.
                    </p>
                </div>
            @elseif(Auth::user()->role === 'customer')
                <div style="background: #f3e5f5; border: 1px solid #9c27b0; border-radius: 8px; padding: 16px; margin-bottom: 20px;">
                    <h3 style="margin: 0 0 8px 0; color: #7b1fa2;">
                        <i class="fas fa-info-circle"></i> Catálogo de Vehículos
                    </h3>
                    <p style="margin: 0; color: #6a1b9a;">
                        Explora nuestro catálogo completo de vehículos disponibles. Puedes buscar por marca o modelo para encontrar el auto perfecto para ti.
                    </p>
                </div>
            @endif
        @endauth
        <h2>Lista de Autos</h2>
        <input type="text" id="car-search" placeholder="Buscar por marca o modelo..." style="margin-bottom:24px;max-width:350px;width:100%;padding:10px 14px;border-radius:8px;border:1px solid #d1d5db;font-size:1em;">
        <div class="car-cards-grid" id="cars-container"></div>
    </div>
</div>
@endsection

@section('scripts')
@vite(['resources/css/app.css', 'resources/js/cars-ajax.js'])
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection 