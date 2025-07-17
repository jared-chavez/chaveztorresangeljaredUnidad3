@extends('layouts.app')

@section('content')
<div class="admin-users-section">
    <div class="admin-users-container">
        <h1>Gestión de Usuarios</h1>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="users-table-container">
            <div style="margin-bottom: 16px;">
                <input type="text" id="user-search" class="form-input" placeholder="Buscar usuario por nombre, email o rol..." style="max-width: 350px; width: 100%; padding: 10px 14px; border-radius: 8px; border: 1px solid #d1d5db; font-size: 1em;">
            </div>
            <div class="users-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Email Verificado</th>
                            <th>Fecha de Registro</th>
                            <th>Última Actualización</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <div class="user-info">
                                    <div class="user-name">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="role-badge role-{{ $user->role }}">
                                    {{ $user->getRoleDisplayName() }}
                                </span>
                            </td>
                            <td>
                                @if($user->email_verified_at)
                                    <span class="status-badge verified">
                                        <i class="fas fa-check"></i> Verificado
                                    </span>
                                @else
                                    <span class="status-badge unverified">
                                        <i class="fas fa-times"></i> No verificado
                                    </span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" onclick="editUser({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" title="Editar usuario">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    @if($user->id !== auth()->id())
                                    <button class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')" title="Eliminar usuario">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    @else
                                    <span class="text-muted" title="No puedes eliminar tu propia cuenta">
                                        <i class="fas fa-user-shield"></i>
                                    </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>
    </div>
</div>

<style>
.admin-users-section {
    min-height: 100vh;
    background: white;
    padding: 40px 20px;
}

.admin-users-container {
    max-width: 1400px;
    margin: 0 auto;
    background: white;
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    padding: 40px;
    overflow: visible;
}

.admin-users-container h1 {
    color: #333;
    margin-bottom: 30px;
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.users-table-container {
    margin-top: 20px;
    width: 100%;
    max-width: 100%;
    overflow-x: auto;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    background: white;
}

.users-table {
    width: 100%;
    min-width: 1400px; /* Aumentado para asegurar que todas las columnas sean visibles */
    background: white;
    border-radius: 12px;
    padding: 0;
    overflow: hidden;
}

.table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
}

.table th,
.table td {
    padding: 16px 20px;
    text-align: left;
    border-bottom: 1px solid #f0f0f0;
    vertical-align: middle;
    white-space: nowrap; /* Evita que el texto se rompa */
}

.table th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: sticky;
    top: 0;
    z-index: 10;
}

.table tr:hover {
    background: #f8f9fa;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 10px;
}

.user-name {
    font-weight: 500;
    color: #333;
}

.role-badge {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-block;
    min-width: 80px;
    text-align: center;
}

.role-admin {
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
}

.role-sales {
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
    color: white;
}

.role-customer {
    background: linear-gradient(135deg, #45b7d1, #96c93d);
    color: white;
}

.status-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.status-badge.verified {
    background: #d4edda;
    color: #155724;
}

.status-badge.unverified {
    background: #f8d7da;
    color: #721c24;
}

.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
}

.btn-sm {
    padding: 8px 12px;
    font-size: 12px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
}

.btn-sm:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.btn-primary {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}



.btn-danger {
    background: linear-gradient(135deg, #ff6b6b, #ee5a52);
    color: white;
}

.text-muted {
    color: #6c757d;
    font-size: 14px;
}

/* Estilos para SweetAlert2 inputs */
.swal2-input {
    width: 100% !important;
    margin: 8px 0 !important;
    padding: 12px 16px !important;
    border: 2px solid #e1e5e9 !important;
    border-radius: 8px !important;
    font-size: 14px !important;
    transition: border-color 0.3s ease !important;
    height: 48px !important;
    min-height: 48px !important;
    box-sizing: border-box !important;
}

.swal2-input:focus {
    outline: none !important;
    border-color: #667eea !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
}

.swal2-select {
    width: 100% !important;
    margin: 8px 0 !important;
    padding: 12px 16px !important;
    border: 2px solid #e1e5e9 !important;
    border-radius: 8px !important;
    font-size: 14px !important;
    background: white !important;
    cursor: pointer !important;
    height: 48px !important;
    min-height: 48px !important;
    appearance: none !important;
    -webkit-appearance: none !important;
    -moz-appearance: none !important;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e") !important;
    background-repeat: no-repeat !important;
    background-position: right 12px center !important;
    background-size: 16px !important;
    padding-right: 40px !important;
}

.swal2-select:focus {
    outline: none !important;
    border-color: #667eea !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
}

.swal2-select:disabled {
    background-color: #f8f9fa !important;
    color: #6c757d !important;
    cursor: not-allowed !important;
    opacity: 0.6 !important;
    background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23999' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e") !important;
}

/* Responsive */
@media (max-width: 768px) {
    .users-table-container {
        overflow-x: auto;
    }
    
    .users-table {
        min-width: 800px; /* Menor ancho mínimo en móviles */
    }
    
    .table th,
    .table td {
        padding: 12px 8px;
        font-size: 12px;
    }
    
    .action-buttons {
        flex-direction: column;
        gap: 4px;
    }
    
    .btn-sm {
        min-width: 32px;
        height: 32px;
        font-size: 11px;
    }
}
</style>

<script>
function editUser(userId, userName, userEmail, userRole) {
    // Verificar si es el usuario actual
    const isCurrentUser = userId === {{ auth()->id() }};
    
    Swal.fire({
        title: 'Editar Usuario',
        html: `
            <div style="text-align: left; margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Nombre:</label>
                <input id="swal-name" class="swal2-input" value="${userName}" style="width: 100%; margin-bottom: 10px;">
            </div>
            <div style="text-align: left; margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Email:</label>
                <input id="swal-email" class="swal2-input" type="email" value="${userEmail}" style="width: 100%; margin-bottom: 10px;">
            </div>
            <div style="text-align: left;">
                <label style="display: block; margin-bottom: 5px; font-weight: 500;">Rol:</label>
                <select id="swal-role" class="swal2-input" style="width: 100%;" ${isCurrentUser ? 'disabled' : ''}>
                    <option value="admin" ${userRole === 'admin' ? 'selected' : ''}>Administrador</option>
                    <option value="sales" ${userRole === 'sales' ? 'selected' : ''}>Vendedor</option>
                    <option value="customer" ${userRole === 'customer' ? 'selected' : ''}>Cliente</option>
                </select>
                ${isCurrentUser ? '<small style="color: #6c757d; font-size: 12px; margin-top: 5px; display: block;">No puedes cambiar tu propio rol</small>' : ''}
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Guardar Cambios',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#667eea',
        cancelButtonColor: '#6c757d',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            const name = document.getElementById('swal-name').value.trim();
            const email = document.getElementById('swal-email').value.trim();
            const role = document.getElementById('swal-role').value;
            
            if (!name || !email) {
                Swal.showValidationMessage('Por favor completa todos los campos');
                return false;
            }
            
            if (!email.includes('@')) {
                Swal.showValidationMessage('Por favor ingresa un email válido');
                return false;
            }
            
            return { name, email, role };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Realizar petición AJAX para actualizar el usuario
            fetch(`/admin/users/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(result.value)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: '¡Usuario Actualizado!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#667eea'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.message || 'Error al actualizar el usuario',
                        icon: 'error',
                        confirmButtonColor: '#ff6b6b'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Error de conexión al actualizar el usuario',
                    icon: 'error',
                    confirmButtonColor: '#ff6b6b'
                });
            });
        }
    });
}



function deleteUser(userId, userName) {
    Swal.fire({
        title: '¿Eliminar Usuario?',
        text: `¿Estás seguro de que quieres eliminar a "${userName}"? Esta acción no se puede deshacer.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, Eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#ff6b6b',
        cancelButtonColor: '#6c757d',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Mostrar loading
            Swal.fire({
                title: 'Eliminando...',
                text: 'Por favor espera mientras se elimina el usuario',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Realizar petición AJAX para eliminar el usuario
            fetch(`/admin/users/${userId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: '¡Usuario Eliminado!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#ff6b6b'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.message || 'Error al eliminar el usuario',
                        icon: 'error',
                        confirmButtonColor: '#ff6b6b'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Error de conexión al eliminar el usuario',
                    icon: 'error',
                    confirmButtonColor: '#ff6b6b'
                });
            });
        }
    });
}

document.getElementById('user-search').addEventListener('input', function() {
    const search = this.value.toLowerCase();
    document.querySelectorAll('.users-table tbody tr').forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(search) ? '' : 'none';
    });
});
</script>
@endsection 