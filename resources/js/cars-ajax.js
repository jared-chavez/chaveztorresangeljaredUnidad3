import carApi from './services/carApi.js';

// Make carApi available globally for debugging
window.carApi = carApi;

// Animation utility functions
const animations = {
    // Add entrance animation to element
    animateIn: (element, delay = 0) => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, delay);
    },

    // Add exit animation to element
    animateOut: (element, callback) => {
        element.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            if (callback) callback();
        }, 400);
    },

    // Add loading animation to button
    addLoadingState: (button, text) => {
        button.classList.add('loading');
        button.disabled = true;
        button.dataset.originalText = button.textContent;
        button.textContent = text;
    },

    // Remove loading animation from button
    removeLoadingState: (button) => {
        button.classList.remove('loading');
        button.disabled = false;
        button.textContent = button.dataset.originalText || 'Submit';
    },

    // Add success animation
    animateSuccess: (element) => {
        element.classList.add('bounce');
        setTimeout(() => {
            element.classList.remove('bounce');
        }, 600);
    },

    // Add pulse animation
    addPulse: (element) => {
        element.classList.add('pulse');
    },

    // Remove pulse animation
    removePulse: (element) => {
        element.classList.remove('pulse');
    },

    // Stagger animation for multiple elements
    staggerAnimation: (elements, delay = 100) => {
        elements.forEach((element, index) => {
            animations.animateIn(element, index * delay);
        });
    }
};

// Replace showSuccess and showError with Toastify for final status notifications
function showToastSuccess(message) {
    Toastify({
        text: message,
        duration: 3000,
        gravity: "top",
        position: "right",
        backgroundColor: "#27c93f", // green
        stopOnFocus: true
    }).showToast();
}
function showToastError(message) {
    Toastify({
        text: message,
        duration: 3500,
        gravity: "top",
        position: "right",
        backgroundColor: "#d93025", // red
        stopOnFocus: true
    }).showToast();
}
function showToastWarning(message) {
    Toastify({
        text: message,
        duration: 3500,
        gravity: "top",
        position: "right",
        backgroundColor: "#ffc107", // yellow
        stopOnFocus: true
    }).showToast();
}

function showConfirm(title, text, callback) {
    Swal.close();
    Swal.fire({
        title: title,
        text: text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ff9800',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Sí, continuar',
        cancelButtonText: 'Cancelar',
        showCloseButton: true,
        allowOutsideClick: true,
        allowEscapeKey: true,
        showClass: { popup: 'animate__animated animate__fadeInDown' }
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
}

// Image preview for create form
const modelImgInput = document.getElementById('modelImg');
const modelImgPreview = document.getElementById('modelImg-preview');
const modelImgLabelText = document.getElementById('modelImg-label-text');
const modelImgFilename = document.getElementById('modelImg-filename');
if (modelImgInput && modelImgPreview) {
    modelImgInput.addEventListener('change', function() {
        modelImgPreview.innerHTML = '';
        modelImgFilename.textContent = '';
        if (this.files && this.files[0]) {
            const file = this.files[0];
            modelImgLabelText.textContent = 'Cambiar imagen';
            modelImgFilename.textContent = file.name;
            const reader = new FileReader();
            reader.onload = function(e) {
                modelImgPreview.innerHTML = `<img src="${e.target.result}" alt="Vista previa" style="max-width:120px;max-height:90px;border-radius:10px;box-shadow:0 2px 8px #ccc;">`;
            };
            reader.readAsDataURL(file);
        } else {
            modelImgLabelText.textContent = 'Seleccionar imagen';
        }
    });
}

// Custom validation for car add form
function validateCarForm(formData) {
    let valid = true;
    // Brand: required, only letters, spaces, accents
    const brand = formData.get('brand')?.trim() || '';
    const brandError = document.getElementById('brand-error');
    if (!brand) {
        brandError.textContent = 'La marca es obligatoria.';
        document.getElementById('brand').classList.add('input-invalid');
        valid = false;
    } else if (!/^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/.test(brand)) {
        brandError.textContent = 'Solo letras y espacios para la marca.';
        document.getElementById('brand').classList.add('input-invalid');
        valid = false;
    } else {
        brandError.textContent = '';
        document.getElementById('brand').classList.remove('input-invalid');
    }
    // Model: required, letters, numbers, spaces, dashes
    const model = formData.get('model')?.trim() || '';
    const modelError = document.getElementById('model-error');
    if (!model) {
        modelError.textContent = 'El modelo es obligatorio.';
        document.getElementById('model').classList.add('input-invalid');
        valid = false;
    } else if (!/^[A-Za-z0-9ÁÉÍÓÚáéíóúÑñ\s\-]+$/.test(model)) {
        modelError.textContent = 'Solo letras, números, espacios y guiones para el modelo.';
        document.getElementById('model').classList.add('input-invalid');
        valid = false;
    } else {
        modelError.textContent = '';
        document.getElementById('model').classList.remove('input-invalid');
    }
    // Year: required, number between 1900 and next year
    const year = formData.get('year');
    const yearError = document.getElementById('year-error');
    const minYear = 1900;
    const maxYear = new Date().getFullYear() + 1;
    if (!year) {
        yearError.textContent = 'El año es obligatorio.';
        document.getElementById('year').classList.add('input-invalid');
        valid = false;
    } else if (isNaN(year) || year < minYear || year > maxYear) {
        yearError.textContent = `El año debe estar entre ${minYear} y ${maxYear}.`;
        document.getElementById('year').classList.add('input-invalid');
        valid = false;
    } else {
        yearError.textContent = '';
        document.getElementById('year').classList.remove('input-invalid');
    }
    // Image: optional, but if present must be image file
    const modelImg = formData.get('modelImg');
    const modelImgError = document.getElementById('modelImg-error');
    if (modelImg && modelImg.name) {
        if (!/\.(jpg|jpeg|png|webp)$/i.test(modelImg.name)) {
            modelImgError.textContent = 'Solo se permiten imágenes JPG, PNG o WEBP.';
            document.getElementById('modelImg-label').classList.add('input-invalid');
            valid = false;
        } else if (modelImg.size > 2 * 1024 * 1024) {
            modelImgError.textContent = 'La imagen no debe superar los 2MB.';
            document.getElementById('modelImg-label').classList.add('input-invalid');
            valid = false;
        } else {
            modelImgError.textContent = '';
            document.getElementById('modelImg-label').classList.remove('input-invalid');
        }
    } else {
        modelImgError.textContent = '';
        document.getElementById('modelImg-label').classList.remove('input-invalid');
    }
    return valid;
}

// Remove error on input
['brand','model','year','modelImg'].forEach(id => {
    const el = document.getElementById(id);
    if (el) {
        el.addEventListener('input', () => {
            const err = document.getElementById(id+'-error');
            if (err) err.textContent = '';
            el.classList.remove('input-invalid');
            if (id === 'modelImg') {
                document.getElementById('modelImg-label').classList.remove('input-invalid');
            }
        });
        if (id === 'modelImg') {
            el.addEventListener('change', () => {
                const err = document.getElementById('modelImg-error');
                if (err) err.textContent = '';
                document.getElementById('modelImg-label').classList.remove('input-invalid');
            });
        }
    }
});

// Create car form handler
document.getElementById('create-car-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    if (!validateCarForm(formData)) {
        return;
    }
    // Show loading state
    const submitBtn = this.querySelector('button[type="submit"]');
    animations.addLoadingState(submitBtn, 'Agregando...');
    try {
        // Create car via AJAX (with image)
        const newCar = await carApi.createCar(formData, true);
        this.reset();
        document.getElementById('year').value = new Date().getFullYear();
        modelImgPreview.innerHTML = '';
        showToastSuccess(`¡Auto creado exitosamente! ${newCar.brand} ${newCar.model}`);
        animations.animateSuccess(submitBtn);
        await loadCars();
    } catch (error) {
        showToastError(`Error al crear auto: ${error.message}`);
    } finally {
        animations.removeLoadingState(submitBtn);
    }
});

// Update car form handlers
document.addEventListener('submit', async function(e) {
    if (e.target.classList.contains('update-car-form')) {
        e.preventDefault();
        
        const form = e.target;
        const carId = form.getAttribute('data-car-id');
        const formData = new FormData(form);
        const carData = {
            brand: formData.get('brand').trim(),
            model: formData.get('model').trim(),
            year: parseInt(formData.get('year'))
        };
        
        // Basic validation
        if (!carData.brand || !carData.model || !carData.year) {
            showToastError('Por favor completa todos los campos requeridos');
            return;
        }
        
        if (carData.year < 1900 || carData.year > 2030) {
            showToastError('El año debe estar entre 1900 y 2030');
            return;
        }
        
        // Show loading state
        const submitBtn = form.querySelector('button[type="submit"]');
        animations.addLoadingState(submitBtn, 'Actualizando...');
        
        try {
            // Update car via AJAX
            const updatedCar = await carApi.updateCar(carId, carData);
            
            // Show success with animation
            showToastSuccess(`¡Auto actualizado exitosamente! ${updatedCar.brand} ${updatedCar.model}`);
            animations.animateSuccess(submitBtn);
            console.log('Car updated:', updatedCar);
            
            // Update the card display with animation
            updateCarCard(carId, updatedCar);
            
        } catch (error) {
            showToastError(`Error al actualizar auto: ${error.message}`);
        } finally {
            // Reset button state
            animations.removeLoadingState(submitBtn);
        }
    }
});

// Delete car button handlers
document.addEventListener('click', async function(e) {
    if (e.target.classList.contains('delete-car-btn') || e.target.closest('.delete-car-btn')) {
        e.preventDefault();
        
        const btn = e.target.classList.contains('delete-car-btn') ? e.target : e.target.closest('.delete-car-btn');
        const carId = btn.getAttribute('data-car-id');
        
        showConfirm(
            '¿Estás seguro?',
            'Esta acción no se puede deshacer. El auto será eliminado.',
            async () => {
                // Show loading state
                animations.addLoadingState(btn, 'Eliminando...');
                
                try {
                    // Delete car via AJAX
                    await carApi.deleteCar(carId);
                    
                    // Show success with animation
                    showToastSuccess('Auto eliminado exitosamente');
                    animations.animateSuccess(btn);
                    console.log('Car deleted:', carId);
                    
                    // Remove the card from DOM with animation
                    removeCarCard(carId);
                    
                } catch (error) {
                    showToastError(`Error al eliminar auto: ${error.message}`);
                } finally {
                    // Reset button state
                    animations.removeLoadingState(btn);
                }
            }
        );
    }
});

// Search functionality with animation
document.getElementById('car-search').addEventListener('input', function() {
    const value = this.value.trim().toLowerCase();
    const cards = document.querySelectorAll('.car-card-toyota');
    let anyVisible = false;
    cards.forEach((card, index) => {
        const brand = card.getAttribute('data-brand') || '';
        const model = card.getAttribute('data-model') || '';
        if (brand.includes(value) || model.includes(value)) {
            card.style.display = '';
            animations.animateIn(card, index * 50);
            anyVisible = true;
        } else {
            animations.animateOut(card, () => {
                card.style.display = 'none';
            });
        }
    });
    // Show message if none visible
    const container = document.getElementById('cars-container');
    let noResultsMsg = container.querySelector('.no-results-msg');
    if (!anyVisible) {
        if (!noResultsMsg) {
            noResultsMsg = document.createElement('div');
            noResultsMsg.className = 'no-results-msg';
            noResultsMsg.style.textAlign = 'center';
            noResultsMsg.style.padding = '40px';
            noResultsMsg.style.color = '#666';
            noResultsMsg.innerHTML = '<h3>No se encuentran disponibles vehículos con ese criterio.</h3>';
            container.appendChild(noResultsMsg);
            animations.animateIn(noResultsMsg);
        }
    } else if (noResultsMsg) {
        noResultsMsg.remove();
    }
});

// Load cars function (for refreshing the list)
async function loadCars() {
    try {
        const cars = await carApi.getAllCars();
        await updateCarsContainer(cars);
    } catch (error) {
        showToastError(`Error al cargar autos: ${error.message}`);
    }
}

// Update cars container with new data and animations
async function updateCarsContainer(cars) {
    const container = document.getElementById('cars-container');
    if (cars.length === 0) {
        container.innerHTML = `
            <div style="text-align: center; padding: 40px; color: #666;">
                <h3>No se encontraron autos</h3>
                <p>¡Agrega algunos autos para comenzar!</p>
            </div>
        `;
        animations.animateIn(container.firstElementChild);
        return;
    }
    const carsHtml = cars.map(car => {
        // Verificar si el usuario es admin o sales para mostrar botones de edición
        const userRole = document.body.dataset.userRole || 'guest';
        const isAdmin = userRole === 'admin';
        const isSales = userRole === 'sales';
        

        
        return `
        <div class="car-card-toyota" data-id="${car.id}" data-brand="${car.brand.toLowerCase()}" data-model="${car.model.toLowerCase()}">
            <div class="car-card-img-toyota">
                <img src="${getCarImageUrl(car.modelImg)}"
                     alt="${car.brand} ${car.model}"
                     onerror="this.onerror=null;this.src='${getDefaultCarImage()}';"
                     loading="lazy">
            </div>
            <div class="car-card-body-toyota">
                <div class="car-card-title-toyota">${car.brand} <span>${car.model}</span></div>
                <div class="car-card-year-toyota">${car.year}</div>
                ${isAdmin ? `
                <div class="car-card-actions-toyota">
                    <button class="car-card-btn-toyota update-car-btn" data-car-id="${car.id}" title="Actualizar">
                        <i class="fas fa-pen"></i>
                    </button>
                    <button class="car-card-btn-toyota delete-car-btn" data-car-id="${car.id}" title="Eliminar">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
                ` : isSales ? `
                <div class="car-card-actions-toyota">
                    <button class="car-card-btn-toyota update-car-btn" data-car-id="${car.id}" title="Actualizar">
                        <i class="fas fa-pen"></i>
                    </button>
                </div>
                ` : `
                <div class="car-card-actions-toyota">
                    <button class="car-card-btn-toyota view-details-btn" data-car-id="${car.id}" title="Ver Detalles">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="car-card-btn-toyota contact-sales-btn" data-car-id="${car.id}" title="Contactar Vendedor">
                        <i class="fas fa-phone"></i>
                    </button>
                </div>
                `}
            </div>
        </div>
        `;
    }).join('');
    container.innerHTML = carsHtml;
    const newCards = container.querySelectorAll('.car-card-toyota');
    animations.staggerAnimation(newCards, 100);
}

// Update individual car card with animation
function updateCarCard(carId, carData) {
    // Just reload all cards for simplicity and consistency
    loadCars();
}

// Remove individual car card with animation
function removeCarCard(carId) {
    const card = document.querySelector(`.car-card-toyota[data-id="${carId}"]`);
    if (card) {
        animations.animateOut(card, () => {
            card.remove();
            // If no cars left, show empty message
            const remainingCards = document.querySelectorAll('.car-card-toyota');
            if (remainingCards.length === 0) {
                const container = document.getElementById('cars-container');
                container.innerHTML = `
                    <div style="text-align: center; padding: 40px; color: #666;">
                        <h3>No se encontraron autos</h3>
                        <p>¡Agrega algunos autos para comenzar!</p>
                    </div>
                `;
                animations.animateIn(container.firstElementChild);
            }
        });
    }
}

// Update car button handler (SweetAlert modal form)
document.addEventListener('click', async function(e) {
    if (e.target.classList.contains('update-car-btn') || e.target.closest('.update-car-btn')) {
        e.preventDefault();
        const btn = e.target.classList.contains('update-car-btn') ? e.target : e.target.closest(' .update-car-btn');
        const carId = btn.getAttribute('data-car-id');
        // Get current car data from DOM
        const card = btn.closest('.car-card-toyota');
        const brand = card.querySelector('.car-card-title-toyota').childNodes[0].textContent.trim();
        const model = card.querySelector('.car-card-title-toyota span').textContent.trim();
        const year = card.querySelector('.car-card-year-toyota').textContent.trim();
        // Show SweetAlert modal with form including file input and preview
        const { value: formValues } = await Swal.fire({
            title: 'Actualizar Auto',
            html:
                `<input id="swal-input1" class="swal2-input" placeholder="Marca" value="${brand}">
                 <input id="swal-input2" class="swal2-input" placeholder="Modelo" value="${model}">
                 <input id="swal-input3" class="swal2-input" type="number" min="1900" max="2030" placeholder="Año" value="${year}">
                 <label for="swal-input4" class="swal2-file-label">
                   <i class="fa fa-camera"></i> Seleccionar imagen
                 </label>
                 <input id="swal-input4" type="file" accept="image/*" class="swal2-file-custom">
                 <span id="swal-file-name"></span>
                 <div id="swal-img-preview" style="margin-bottom:10px;"></div>`,
            focusConfirm: false,
            showCancelButton: true,
            confirmButtonText: 'Actualizar',
            cancelButtonText: 'Cancelar',
            didOpen: () => {
                const fileInput = document.getElementById('swal-input4');
                const fileLabel = document.querySelector('.swal2-file-label');
                const fileNameSpan = document.getElementById('swal-file-name');
                const preview = document.getElementById('swal-img-preview');
                fileLabel.addEventListener('click', () => fileInput.click());
                fileInput.addEventListener('change', function() {
                    preview.innerHTML = '';
                    if (this.files && this.files[0]) {
                        fileNameSpan.textContent = this.files[0].name;
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.innerHTML = `<img src="${e.target.result}" alt="Vista previa" style="max-width:120px;max-height:90px;border-radius:10px;box-shadow:0 2px 8px #ccc;">`;
                        };
                        reader.readAsDataURL(this.files[0]);
                    } else {
                        fileNameSpan.textContent = '';
                    }
                });
            },
            preConfirm: () => {
                return [
                    document.getElementById('swal-input1').value.trim(),
                    document.getElementById('swal-input2').value.trim(),
                    document.getElementById('swal-input3').value.trim(),
                    document.getElementById('swal-input4').files[0] || null
                ];
            }
        });
        if (formValues) {
            const [newBrand, newModel, newYear, newImg] = formValues;
            if (!newBrand || !newModel || !newYear) {
                showToastError('Por favor completa todos los campos requeridos');
                return;
            }
            if (parseInt(newYear) < 1900 || parseInt(newYear) > 2030) {
                showToastError('El año debe estar entre 1900 y 2030');
                return;
            }
            // Show loading
            Swal.fire({
                title: 'Actualizando...',
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });
            try {
                if (newImg) {
                    // Use FormData for file upload
                    const formData = new FormData();
                    formData.append('brand', newBrand);
                    formData.append('model', newModel);
                    formData.append('year', parseInt(newYear));
                    formData.append('modelImg', newImg);
                    formData.append('_method', 'PUT');
                    await carApi.updateCar(carId, formData, true);
                } else {
                    await carApi.updateCar(carId, { brand: newBrand, model: newModel, year: parseInt(newYear) });
                }
                Swal.close();
                showToastSuccess('¡Auto actualizado exitosamente!');
                loadCars();
            } catch (error) {
                Swal.close();
                showToastError(`Error al actualizar auto: ${error.message}`);
            }
        }
    }
});

// Helper functions for image handling
function getCarImageUrl(modelImg) {
    if (!modelImg) {
        return getDefaultCarImage();
    }
    
    // If it's already a full URL, return as is
    if (modelImg.startsWith('http://') || modelImg.startsWith('https://')) {
        return modelImg;
    }
    
    // If it's a relative path starting with /storage, make it absolute
    if (modelImg.startsWith('/storage/')) {
        return window.location.origin + modelImg;
    }
    
    // If it's just a filename, construct the full path
    if (!modelImg.startsWith('/')) {
        return window.location.origin + '/storage/cars/' + modelImg;
    }
    
    return modelImg;
}

function getDefaultCarImage() {
    // Multiple fallback options for better reliability
    const defaultImages = [
        'https://images.pexels.com/photos/358070/pexels-photo-358070.jpeg?auto=compress&w=600&h=400&fit=crop',
        'https://images.pexels.com/photos/3802510/pexels-photo-3802510.jpeg?auto=compress&w=600&h=400&fit=crop',
        'https://images.pexels.com/photos/116675/pexels-photo-116675.jpeg?auto=compress&w=600&h=400&fit=crop'
    ];
    
    // Return a random default image for variety
    return defaultImages[Math.floor(Math.random() * defaultImages.length)];
}

// Function to check if image exists
function checkImageExists(url) {
    return new Promise((resolve) => {
        const img = new Image();
        img.onload = () => resolve(true);
        img.onerror = () => resolve(false);
        img.src = url;
    });
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Cars AJAX interface loaded successfully');
    loadCars();
    
    // Add entrance animation to existing cards
    const existingCards = document.querySelectorAll('.car-card');
    animations.staggerAnimation(existingCards, 100);
    
    // Add entrance animation to form
    const form = document.querySelector('.contact-form-container');
    if (form) {
        animations.animateIn(form, 200);
    }
    
    // Add event listeners for customer buttons
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('view-details-btn') || e.target.closest('.view-details-btn')) {
            e.preventDefault();
            const btn = e.target.classList.contains('view-details-btn') ? e.target : e.target.closest('.view-details-btn');
            const carId = btn.getAttribute('data-car-id');
            const card = btn.closest('.car-card-toyota');
            const brand = card.querySelector('.car-card-title-toyota').childNodes[0].textContent.trim();
            const model = card.querySelector('.car-card-title-toyota span').textContent.trim();
            const year = card.querySelector('.car-card-year-toyota').textContent.trim();
            
            Swal.fire({
                title: `${brand} ${model}`,
                html: `
                    <div style="text-align: left;">
                        <p><strong>Marca:</strong> ${brand}</p>
                        <p><strong>Modelo:</strong> ${model}</p>
                        <p><strong>Año:</strong> ${year}</p>
                        <p><strong>Estado:</strong> <span style="color: #4ecdc4;">Disponible</span></p>
                        <p><strong>Información:</strong> Este vehículo está disponible para consulta y compra.</p>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Cerrar',
                confirmButtonColor: '#4ecdc4'
            });
        }
        
        if (e.target.classList.contains('contact-sales-btn') || e.target.closest('.contact-sales-btn')) {
            e.preventDefault();
            const btn = e.target.classList.contains('contact-sales-btn') ? e.target : e.target.closest('.contact-sales-btn');
            const carId = btn.getAttribute('data-car-id');
            const card = btn.closest('.car-card-toyota');
            const brand = card.querySelector('.car-card-title-toyota').childNodes[0].textContent.trim();
            const model = card.querySelector('.car-card-title-toyota span').textContent.trim();
            
            Swal.fire({
                title: 'Contactar Vendedor',
                html: `
                    <div style="text-align: left;">
                        <p><strong>Vehículo:</strong> ${brand} ${model}</p>
                        <p>Para obtener más información sobre este vehículo, puedes:</p>
                        <ul style="text-align: left; margin: 10px 0;">
                            <li>Llamar al: <strong>+52 55 1234 5678</strong></li>
                            <li>Enviar email a: <strong>info@automundo.mx</strong></li>
                            <li>Visitar nuestro concesionario</li>
                        </ul>
                    </div>
                `,
                icon: 'info',
                confirmButtonText: 'Entendido',
                confirmButtonColor: '#4ecdc4'
            });
        }
    });
}); 