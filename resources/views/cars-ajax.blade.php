@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Gestión de Autos - Pruebas AJAX</h1>
        
        <!-- Loading State -->
        <div id="loading" class="hidden flex justify-center items-center py-8">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
                            <span class="ml-3 text-gray-600">Cargando autos...</span>
        </div>

        <!-- Error State -->
        <div id="error" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <span id="error-message"></span>
        </div>

        <!-- Success Message -->
        <div id="success" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            <span id="success-message"></span>
        </div>

        <!-- Cars List -->
        <div id="cars-container" class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-semibold text-gray-800">Lista de Autos</h2>
                    <button 
                        id="refresh-btn" 
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        onclick="loadCars()"
                    >
                        Actualizar Autos
                    </button>
                </div>
            </div>
            
            <div id="cars-content" class="p-6">
                <div class="text-center text-gray-500">
                    Haz clic en "Actualizar Autos" para cargar los datos
                </div>
            </div>
        </div>

        <!-- Create Car Form -->
        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Crear Nuevo Auto</h3>
            
            <form id="create-car-form" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700 mb-1">
                            Marca *
                        </label>
                        <input
                            type="text"
                            id="brand"
                            name="brand"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="ej., Toyota"
                            maxLength="255"
                            required
                        >
                    </div>

                    <div>
                        <label for="model" class="block text-sm font-medium text-gray-700 mb-1">
                            Modelo *
                        </label>
                        <input
                            type="text"
                            id="model"
                            name="model"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="ej., Camry"
                            maxLength="255"
                            required
                        >
                    </div>

                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700 mb-1">
                            Año *
                        </label>
                        <input
                            type="number"
                            id="year"
                            name="year"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            min="1900"
                            max="2030"
                            value="2024"
                            required
                        >
                    </div>
                </div>

                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Crear Auto
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Car Form -->
        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Actualizar Auto</h3>
            
            <form id="update-car-form" class="space-y-4">
                <div class="mb-4">
                                            <label for="update-car-id" class="block text-sm font-medium text-gray-700 mb-1">
                            ID del Auto *
                        </label>
                        <div class="flex gap-2">
                            <input
                                type="number"
                                id="update-car-id"
                                name="car_id"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                placeholder="Ingresa el ID del auto"
                                min="1"
                                required
                            >
                            <button
                                type="button"
                                onclick="loadCarForUpdate()"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Cargar Auto
                            </button>
                        </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="update-brand" class="block text-sm font-medium text-gray-700 mb-1">
                            Marca *
                        </label>
                        <input
                            type="text"
                            id="update-brand"
                            name="brand"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="ej., Toyota"
                            maxLength="255"
                            required
                        >
                    </div>

                    <div>
                        <label for="update-model" class="block text-sm font-medium text-gray-700 mb-1">
                            Modelo *
                        </label>
                        <input
                            type="text"
                            id="update-model"
                            name="model"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="ej., Camry"
                            maxLength="255"
                            required
                        >
                    </div>

                    <div>
                        <label for="update-year" class="block text-sm font-medium text-gray-700 mb-1">
                            Año *
                        </label>
                        <input
                            type="number"
                            id="update-year"
                            name="year"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                            min="1900"
                            max="2030"
                            required
                        >
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button
                        type="button"
                        onclick="resetUpdateForm()"
                        class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
                    >
                        Limpiar
                    </button>
                    <button
                        type="submit"
                        class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Actualizar Auto
                    </button>
                </div>
            </form>
        </div>

        <!-- Delete Car Section -->
        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Eliminar Auto</h3>
            
            <div class="space-y-4">
                <div>
                                            <label for="delete-car-id" class="block text-sm font-medium text-gray-700 mb-1">
                            ID del Auto a Eliminar
                        </label>
                        <div class="flex gap-2">
                            <input
                                type="number"
                                id="delete-car-id"
                                placeholder="Ingresa el ID del auto"
                                class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                min="1"
                            >
                            <button
                                onclick="loadCarForDeletion()"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                            >
                                Cargar Información
                            </button>
                        </div>
                </div>
                
                <div id="car-to-delete-info" class="hidden bg-gray-50 p-4 rounded-md">
                    <h4 class="font-medium text-gray-800 mb-2">Información del Auto:</h4>
                    <div id="car-delete-details" class="text-sm text-gray-600"></div>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button
                        onclick="clearDeleteForm()"
                        class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-md transition-colors"
                    >
                        Limpiar
                    </button>
                    <button
                        onclick="deleteCar()"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Eliminar Auto
                    </button>
                </div>
            </div>
        </div>

        <!-- API Testing Section -->
        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Pruebas de API</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Obtener Todos los Autos</h4>
                    <button 
                        onclick="testGetAllCars()"
                        class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Probar GET /api/cars
                    </button>
                </div>
                
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Obtener Auto Individual</h4>
                    <div class="flex gap-2">
                        <input 
                            type="number" 
                            id="car-id-input" 
                            placeholder="ID del Auto" 
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md"
                            min="1"
                        >
                        <button 
                            onclick="testGetCarById()"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Probar GET /api/cars/{id}
                        </button>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Crear Auto (Prueba)</h4>
                    <button 
                        onclick="testCreateCar()"
                        class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded"
                    >
                        Probar POST /api/cars
                    </button>
                </div>
                
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Actualizar Auto (Prueba)</h4>
                    <div class="flex gap-2">
                        <input 
                            type="number" 
                            id="test-update-id" 
                            placeholder="ID del Auto" 
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md"
                            min="1"
                        >
                        <button 
                            onclick="testUpdateCar()"
                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Probar PUT /api/cars/{id}
                        </button>
                    </div>
                </div>
                
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Eliminar Auto (Prueba)</h4>
                    <div class="flex gap-2">
                        <input 
                            type="number" 
                            id="test-delete-id" 
                            placeholder="ID del Auto" 
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-md"
                            min="1"
                        >
                        <button 
                            onclick="testDeleteCar()"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                        >
                            Probar DELETE /api/cars/{id}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@vite(['resources/css/app.css', 'resources/js/ajax-app.js'])
@endsection 