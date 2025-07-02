import carApi from './services/carApi.js';

// Make carApi available globally for testing
window.carApi = carApi;

// Global functions for testing
window.loadCars = async function() {
    const loadingEl = document.getElementById('loading');
    const errorEl = document.getElementById('error');
    const successEl = document.getElementById('success');
    const carsContentEl = document.getElementById('cars-content');
    
    try {
        // Show loading
        loadingEl.classList.remove('hidden');
        errorEl.classList.add('hidden');
        successEl.classList.add('hidden');
        
        // Fetch cars
        const cars = await carApi.getAllCars();
        
        // Hide loading
        loadingEl.classList.add('hidden');
        
        // Display cars
        if (cars.length === 0) {
            carsContentEl.innerHTML = `
                <div class="text-center py-8">
                    <div class="text-gray-500 text-lg mb-4">No se encontraron autos</div>
                    <p class="text-gray-400">¡Agrega algunos autos para comenzar!</p>
                </div>
            `;
        } else {
            const carsHtml = cars.map(car => `
                <div class="border-b border-gray-200 py-4 last:border-b-0">
                    <div class="flex justify-between items-center">
                        <div>
                            <h4 class="font-medium text-gray-900">${car.brand} ${car.model}</h4>
                            <p class="text-sm text-gray-500">Año: ${car.year} | ID: ${car.id}</p>
                        </div>
                        <div class="flex space-x-2">
                            <button 
                                onclick="testGetCarById(${car.id})"
                                class="text-blue-600 hover:text-blue-900 bg-blue-100 hover:bg-blue-200 px-3 py-1 rounded-md text-xs font-medium"
                            >
                                Ver Detalles
                            </button>
                            <button 
                                onclick="loadCarForEditing(${car.id})"
                                class="text-yellow-600 hover:text-yellow-900 bg-yellow-100 hover:bg-yellow-200 px-3 py-1 rounded-md text-xs font-medium"
                            >
                                Editar
                            </button>
                            <button 
                                onclick="loadCarForDeletionFromList(${car.id})"
                                class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 px-3 py-1 rounded-md text-xs font-medium"
                            >
                                Eliminar
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
            
            carsContentEl.innerHTML = carsHtml;
        }
        
        // Show success message
        showSuccess(`Se cargaron exitosamente ${cars.length} autos`);
        
    } catch (error) {
        loadingEl.classList.add('hidden');
        showError(`Error al cargar autos: ${error.message}`);
    }
};

window.testGetAllCars = async function() {
    try {
        const cars = await carApi.getAllCars();
        showSuccess(`Se obtuvieron exitosamente ${cars.length} autos`);
        console.log('All cars:', cars);
    } catch (error) {
        showError(`Error al obtener autos: ${error.message}`);
    }
};

window.testGetCarById = async function(id = null) {
    const carId = id || document.getElementById('car-id-input').value;
    
    if (!carId) {
        showError('Por favor ingresa un ID de auto');
        return;
    }
    
    try {
        const car = await carApi.getCarById(carId);
        showSuccess(`Auto obtenido exitosamente: ${car.brand} ${car.model} (ID: ${car.id})`);
        console.log('Car details:', car);
    } catch (error) {
        showError(`Error al obtener auto ${carId}: ${error.message}`);
    }
};

window.testCreateCar = async function() {
    const testCarData = {
        brand: 'Marca de Prueba',
        model: 'Modelo de Prueba',
        year: 2024
    };
    
    try {
        const newCar = await carApi.createCar(testCarData);
        showSuccess(`¡Auto de prueba creado exitosamente! ${newCar.brand} ${newCar.model} (ID: ${newCar.id})`);
        console.log('Test car created:', newCar);
        
        // Refresh the cars list
        await loadCars();
    } catch (error) {
        showError(`Error al crear auto de prueba: ${error.message}`);
    }
};

window.testUpdateCar = async function() {
    const carId = document.getElementById('test-update-id').value;
    
    if (!carId) {
        showError('Por favor ingresa un ID de auto');
        return;
    }
    
    const testUpdateData = {
        brand: 'Marca Actualizada',
        model: 'Modelo Actualizado',
        year: 2025
    };
    
    try {
        const updatedCar = await carApi.updateCar(carId, testUpdateData);
        showSuccess(`¡Auto de prueba actualizado exitosamente! ${updatedCar.brand} ${updatedCar.model} (ID: ${updatedCar.id})`);
        console.log('Test car updated:', updatedCar);
        
        // Refresh the cars list
        await loadCars();
    } catch (error) {
        showError(`Error al actualizar auto de prueba: ${error.message}`);
    }
};

window.loadCarForUpdate = async function() {
    const carId = document.getElementById('update-car-id').value;
    
    if (!carId) {
        showError('Por favor ingresa un ID de auto');
        return;
    }
    
    try {
        const car = await carApi.getCarById(carId);
        
        // Populate the update form
        document.getElementById('update-brand').value = car.brand;
        document.getElementById('update-model').value = car.model;
        document.getElementById('update-year').value = car.year;
        
        showSuccess(`Auto cargado para actualizar: ${car.brand} ${car.model}`);
        console.log('Car loaded for update:', car);
    } catch (error) {
        showError(`Error al cargar auto: ${error.message}`);
    }
};

window.resetUpdateForm = function() {
    document.getElementById('update-car-form').reset();
    showSuccess('Formulario de actualización limpiado');
};

window.loadCarForEditing = async function(carId) {
    try {
        const car = await carApi.getCarById(carId);
        
        // Populate the update form
        document.getElementById('update-car-id').value = car.id;
        document.getElementById('update-brand').value = car.brand;
        document.getElementById('update-model').value = car.model;
        document.getElementById('update-year').value = car.year;
        
        // Scroll to update form
        document.getElementById('update-car-form').scrollIntoView({ behavior: 'smooth' });
        
        showSuccess(`Auto cargado para editar: ${car.brand} ${car.model}`);
        console.log('Car loaded for editing:', car);
    } catch (error) {
        showError(`Error al cargar auto para editar: ${error.message}`);
    }
};

window.testDeleteCar = async function() {
    const carId = document.getElementById('test-delete-id').value;
    
    if (!carId) {
        showError('Please enter a car ID');
        return;
    }
    
    try {
        // Show confirmation dialog
        const result = await Swal.fire({
            title: '¿Estás seguro?',
            text: `Esto eliminará permanentemente el auto ID ${carId}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '¡Sí, elimínalo!',
            cancelButtonText: 'Cancelar'
        });
        
        if (result.isConfirmed) {
            await carApi.deleteCar(carId);
            showSuccess(`¡Auto de prueba ${carId} eliminado exitosamente!`);
            console.log('Test car deleted:', carId);
            
            // Clear the input
            document.getElementById('test-delete-id').value = '';
            
            // Refresh the cars list
            await loadCars();
        }
    } catch (error) {
        showError(`Error al eliminar auto de prueba: ${error.message}`);
    }
};

window.loadCarForDeletion = async function() {
    const carId = document.getElementById('delete-car-id').value;
    
    if (!carId) {
        showError('Please enter a car ID');
        return;
    }
    
    try {
        const car = await carApi.getCarById(carId);
        
        // Show car information
        document.getElementById('car-delete-details').innerHTML = `
            <p><strong>ID:</strong> ${car.id}</p>
            <p><strong>Marca:</strong> ${car.brand}</p>
            <p><strong>Modelo:</strong> ${car.model}</p>
            <p><strong>Año:</strong> ${car.year}</p>
        `;
        document.getElementById('car-to-delete-info').classList.remove('hidden');
        
        showSuccess(`Auto cargado para eliminar: ${car.brand} ${car.model}`);
        console.log('Car loaded for deletion:', car);
    } catch (error) {
        showError(`Error al cargar auto: ${error.message}`);
    }
};

window.loadCarForDeletionFromList = async function(carId) {
    try {
        const car = await carApi.getCarById(carId);
        
        // Populate the delete form
        document.getElementById('delete-car-id').value = car.id;
        
        // Show car information
        document.getElementById('car-delete-details').innerHTML = `
            <p><strong>ID:</strong> ${car.id}</p>
            <p><strong>Marca:</strong> ${car.brand}</p>
            <p><strong>Modelo:</strong> ${car.model}</p>
            <p><strong>Año:</strong> ${car.year}</p>
        `;
        document.getElementById('car-to-delete-info').classList.remove('hidden');
        
        // Scroll to delete section
        document.getElementById('delete-car-id').scrollIntoView({ behavior: 'smooth' });
        
        showSuccess(`Auto cargado para eliminar: ${car.brand} ${car.model}`);
        console.log('Car loaded for deletion:', car);
    } catch (error) {
        showError(`Error al cargar auto para eliminar: ${error.message}`);
    }
};

window.deleteCar = async function() {
    const carId = document.getElementById('delete-car-id').value;
    
    if (!carId) {
        showError('Please enter a car ID');
        return;
    }
    
    try {
        // Show confirmation dialog
        const result = await Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '¡Sí, elimínalo!',
            cancelButtonText: 'Cancelar'
        });
        
        if (result.isConfirmed) {
            // Show loading state
            const deleteBtn = document.querySelector('button[onclick="deleteCar()"]');
            const originalText = deleteBtn.textContent;
            deleteBtn.textContent = 'Eliminando...';
            deleteBtn.disabled = true;
            
            await carApi.deleteCar(carId);
            
            // Clear form
            clearDeleteForm();
            
            showSuccess(`¡Auto ${carId} eliminado exitosamente!`);
            console.log('Car deleted:', carId);
            
            // Refresh the cars list
            await loadCars();
            
            // Reset button state
            deleteBtn.textContent = originalText;
            deleteBtn.disabled = false;
        }
    } catch (error) {
        showError(`Error al eliminar auto: ${error.message}`);
        
        // Reset button state
        const deleteBtn = document.querySelector('button[onclick="deleteCar()"]');
        deleteBtn.textContent = 'Eliminar Auto';
        deleteBtn.disabled = false;
    }
};

window.clearDeleteForm = function() {
    document.getElementById('delete-car-id').value = '';
    document.getElementById('car-to-delete-info').classList.add('hidden');
    showSuccess('Formulario de eliminación limpiado');
};

// Utility functions
function showSuccess(message) {
    const successEl = document.getElementById('success');
    const successMessageEl = document.getElementById('success-message');
    const errorEl = document.getElementById('error');
    
    errorEl.classList.add('hidden');
    successMessageEl.textContent = message;
    successEl.classList.remove('hidden');
    
    // Auto-hide after 3 seconds
    setTimeout(() => {
        successEl.classList.add('hidden');
    }, 3000);
}

function showError(message) {
    const errorEl = document.getElementById('error');
    const errorMessageEl = document.getElementById('error-message');
    const successEl = document.getElementById('success');
    
    successEl.classList.add('hidden');
    errorMessageEl.textContent = message;
    errorEl.classList.remove('hidden');
    
    // Auto-hide after 5 seconds
    setTimeout(() => {
        errorEl.classList.add('hidden');
    }, 5000);
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Create car form handler
    document.getElementById('create-car-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const carData = {
            brand: formData.get('brand').trim(),
            model: formData.get('model').trim(),
            year: parseInt(formData.get('year'))
        };
        
        // Basic validation
        if (!carData.brand || !carData.model || !carData.year) {
            showError('Por favor completa todos los campos requeridos');
            return;
        }
        
        if (carData.year < 1900 || carData.year > 2030) {
            showError('El año debe estar entre 1900 y 2030');
            return;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        try {
            submitBtn.textContent = 'Creando...';
            submitBtn.disabled = true;
            
            // Create car via AJAX
            const newCar = await carApi.createCar(carData);
            
            // Reset form
            this.reset();
            document.getElementById('year').value = '2024';
            
            // Show success
            showSuccess(`¡Auto creado exitosamente! ${newCar.brand} ${newCar.model} (ID: ${newCar.id})`);
            console.log('New car created:', newCar);
            
            // Refresh the cars list
            await loadCars();
            
        } catch (error) {
            showError(`Error al crear auto: ${error.message}`);
        } finally {
            // Reset button state
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }
    });
    
    // Update car form handler
    document.getElementById('update-car-form').addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const carId = document.getElementById('update-car-id').value;
        const formData = new FormData(this);
        const carData = {
            brand: formData.get('brand').trim(),
            model: formData.get('model').trim(),
            year: parseInt(formData.get('year'))
        };
        
        // Basic validation
        if (!carId) {
            showError('Por favor ingresa un ID de auto');
            return;
        }
        
        if (!carData.brand || !carData.model || !carData.year) {
            showError('Por favor completa todos los campos requeridos');
            return;
        }
        
        if (carData.year < 1900 || carData.year > 2030) {
            showError('El año debe estar entre 1900 y 2030');
            return;
        }
        
        // Show loading state
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.textContent;
        
        try {
            submitBtn.textContent = 'Actualizando...';
            submitBtn.disabled = true;
            
            // Update car via AJAX
            const updatedCar = await carApi.updateCar(carId, carData);
            
            // Reset form
            this.reset();
            
            // Show success
            showSuccess(`¡Auto actualizado exitosamente! ${updatedCar.brand} ${updatedCar.model} (ID: ${updatedCar.id})`);
            console.log('Car updated:', updatedCar);
            
            // Refresh the cars list
            await loadCars();
            
        } catch (error) {
            showError(`Error al actualizar auto: ${error.message}`);
        } finally {
            // Reset button state
            submitBtn.textContent = originalText;
            submitBtn.disabled = false;
        }
    });
}); 