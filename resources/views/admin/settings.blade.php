@extends('layouts.app')

@section('content')
<div class="contact-section">
    <div class="contact-form-container">
        <h1>Configuración del Sistema</h1>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form id="settingsForm">
            <div class="settings-section">
                <h3>Configuración General</h3>
                <p>Aquí puedes configurar los parámetros generales del sistema.</p>
                
                            <div class="setting-item">
                <label>Nombre del Sistema:</label>
                <input type="text" name="system_name" value="{{ $settings['system_name'] }}" class="form-input" disabled>
            </div>
            
            <div class="setting-item">
                <label>Versión:</label>
                <input type="text" name="system_version" value="{{ $settings['system_version'] }}" class="form-input" disabled>
            </div>
            
            <div class="setting-item">
                <label>Modo de Mantenimiento:</label>
                <div class="maintenance-control">
                    <select name="maintenance_mode" class="form-input">
                        <option value="0" {{ $settings['maintenance_mode'] == '0' ? 'selected' : '' }}>Desactivado</option>
                        <option value="1" {{ $settings['maintenance_mode'] == '1' ? 'selected' : '' }}>Activado</option>
                    </select>
                    <span class="maintenance-status {{ $settings['maintenance_mode'] == '1' ? 'active' : 'inactive' }}">
                        <i class="fas {{ $settings['maintenance_mode'] == '1' ? 'fa-exclamation-triangle' : 'fa-check-circle' }}"></i>
                        {{ $settings['maintenance_mode'] == '1' ? 'Mantenimiento Activo' : 'Sistema Operativo' }}
                    </span>
                </div>
            </div>
            </div>

            <div class="settings-section">
                <h3>Configuración de Email</h3>
                <p>Configuración para el envío de emails del sistema.</p>
                
                            <div class="setting-item">
                <label>Servidor SMTP:</label>
                <input type="text" name="smtp_server" value="{{ $settings['smtp_server'] }}" class="form-input" disabled>
            </div>
            
            <div class="setting-item">
                <label>Email de Contacto:</label>
                <input type="email" name="contact_email" value="{{ $settings['contact_email'] }}" class="form-input" disabled>
            </div>
            </div>

            <div class="settings-section">
                <h3>Configuración de Seguridad</h3>
                <p>Parámetros de seguridad del sistema.</p>
                
                <div class="setting-item">
                    <label>Duración de Sesión (minutos):</label>
                    <input type="number" name="session_lifetime" value="{{ $settings['session_lifetime'] }}" class="form-input" min="1" max="1440">
                </div>
                
                <div class="setting-item">
                    <label>Intentos de Login Máximos:</label>
                    <input type="number" name="max_login_attempts" value="{{ $settings['max_login_attempts'] }}" class="form-input" min="1" max="20">
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn btn-primary" id="saveSettings">
                    <i class="fas fa-save"></i> Guardar Configuración
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al Dashboard
                </a>
            </div>
        </form>
    </div>
</div>

<style>
.settings-section {
    margin-bottom: 30px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #007bff;
}

.settings-section h3 {
    margin-top: 0;
    color: #333;
    margin-bottom: 10px;
}

.setting-item {
    margin-bottom: 15px;
}

.setting-item label {
    display: block;
    margin-bottom: 5px;
    font-weight: 500;
    color: #555;
}

.form-input {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}

.form-input:disabled {
    background: #f5f5f5;
    color: #666;
}

.form-input:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.btn-primary {
    background: linear-gradient(135deg, #007bff, #0056b3);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

.btn-secondary {
    background: #6c757d;
    color: white;
}

.btn-secondary:hover {
    background: #545b62;
    transform: translateY(-1px);
}

.alert {
    padding: 12px 16px;
    border-radius: 4px;
    margin-bottom: 20px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.maintenance-control {
    display: flex;
    align-items: center;
    gap: 15px;
}

.maintenance-status {
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 6px;
    white-space: nowrap;
}

.maintenance-status.active {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.maintenance-status.inactive {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.maintenance-status i {
    font-size: 14px;
}
</style>

<script>
document.getElementById('settingsForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    // Mostrar loading
    const saveButton = document.getElementById('saveSettings');
    const originalText = saveButton.innerHTML;
    saveButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Guardando...';
    saveButton.disabled = true;
    
    fetch('{{ route("admin.settings.update") }}', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Actualizar el indicador de mantenimiento
            const maintenanceSelect = document.querySelector('select[name="maintenance_mode"]');
            const maintenanceStatus = document.querySelector('.maintenance-status');
            const selectedValue = maintenanceSelect.value;
            
            if (selectedValue === '1') {
                maintenanceStatus.className = 'maintenance-status active';
                maintenanceStatus.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Mantenimiento Activo';
            } else {
                maintenanceStatus.className = 'maintenance-status inactive';
                maintenanceStatus.innerHTML = '<i class="fas fa-check-circle"></i> Sistema Operativo';
            }
            
            Swal.fire({
                title: '¡Configuración Guardada!',
                text: data.message,
                icon: 'success',
                confirmButtonColor: '#007bff'
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: data.message,
                icon: 'error',
                confirmButtonColor: '#dc3545'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            title: 'Error de Conexión',
            text: 'No se pudo guardar la configuración',
            icon: 'error',
            confirmButtonColor: '#dc3545'
        });
    })
    .finally(() => {
        // Restaurar botón
        saveButton.innerHTML = originalText;
        saveButton.disabled = false;
    });
});
</script>
@endsection 