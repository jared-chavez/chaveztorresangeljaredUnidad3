@extends('layouts.app')

@section('title', 'Dashboard Administrador - AutoMundo')

@section('content')
<div class="dashboard-container">
    <div class="container">
        <!-- Header del Dashboard -->
        <div class="dashboard-header">
            <div class="dashboard-title">
                <h1><i class="fas fa-crown"></i> Panel de Administración</h1>
                <p>Bienvenido, {{ Auth::user()->name }} - {{ Auth::user()->getRoleDisplayName() }}</p>
            </div>
            <div class="dashboard-actions">
                <a href="{{ route('admin.users') }}" class="btn btn-primary">
                    <i class="fas fa-users"></i> Gestionar Usuarios
                </a>
                <a href="{{ route('admin.settings') }}" class="btn btn-outline">
                    <i class="fas fa-cog"></i> Configuración
                </a>
            </div>
        </div>

        <!-- Estadísticas Principales -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ \App\Models\User::count() }}</h3>
                    <p>Total Usuarios</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ \App\Models\Car::count() }}</h3>
                    <p>Vehículos</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ \App\Models\User::where('role', 'manager')->count() }}</h3>
                    <p>Gerentes</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ \App\Models\User::where('role', 'sales')->count() }}</h3>
                    <p>Vendedores</p>
                </div>
            </div>
        </div>

        <!-- Grid de Tarjetas -->
        <div class="dashboard-grid">
            <!-- Gestión de Usuarios -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-users-cog"></i> Gestión de Usuarios</h3>
                </div>
                <div class="card-content">
                    <div class="user-stats">
                        <div class="user-stat">
                            <span class="stat-label">Administradores:</span>
                            <span class="stat-value">{{ \App\Models\User::where('role', 'admin')->count() }}</span>
                        </div>
                        <div class="user-stat">
                            <span class="stat-label">Gerentes:</span>
                            <span class="stat-value">{{ \App\Models\User::where('role', 'manager')->count() }}</span>
                        </div>
                        <div class="user-stat">
                            <span class="stat-label">Vendedores:</span>
                            <span class="stat-value">{{ \App\Models\User::where('role', 'sales')->count() }}</span>
                        </div>
                        <div class="user-stat">
                            <span class="stat-label">Clientes:</span>
                            <span class="stat-value">{{ \App\Models\User::where('role', 'customer')->count() }}</span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('admin.users') }}" class="btn btn-primary">Ver Todos</a>
                        <button class="btn btn-outline">Crear Usuario</button>
                    </div>
                </div>
            </div>

            <!-- Actividad del Sistema -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-bar"></i> Actividad del Sistema</h3>
                </div>
                <div class="card-content">
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-details">
                                <p><strong>Nuevo usuario registrado</strong></p>
                                <small>Hace 5 minutos</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="activity-details">
                                <p><strong>Vehículo agregado al inventario</strong></p>
                                <small>Hace 15 minutos</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <div class="activity-details">
                                <p><strong>Inicio de sesión de gerente</strong></p>
                                <small>Hace 30 minutos</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Configuración del Sistema -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-cogs"></i> Configuración</h3>
                </div>
                <div class="card-content">
                    <div class="config-options">
                        <div class="config-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Configuración de Seguridad</span>
                        </div>
                        <div class="config-item">
                            <i class="fas fa-envelope"></i>
                            <span>Configuración de Email</span>
                        </div>
                        <div class="config-item">
                            <i class="fas fa-database"></i>
                            <span>Respaldo de Base de Datos</span>
                        </div>
                        <div class="config-item">
                            <i class="fas fa-file-alt"></i>
                            <span>Logs del Sistema</span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('admin.settings') }}" class="btn btn-primary">Configurar</a>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-bolt"></i> Acciones Rápidas</h3>
                </div>
                <div class="card-content">
                    <div class="quick-actions">
                        <a href="{{ route('admin.users') }}" class="quick-action">
                            <i class="fas fa-user-plus"></i>
                            <span>Crear Usuario</span>
                        </a>
                        <a href="{{ route('cars.index') }}" class="quick-action">
                            <i class="fas fa-car"></i>
                            <span>Gestionar Vehículos</span>
                        </a>
                        <a href="#" class="quick-action">
                            <i class="fas fa-download"></i>
                            <span>Generar Reporte</span>
                        </a>
                        <a href="#" class="quick-action">
                            <i class="fas fa-database"></i>
                            <span>Respaldo</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dashboard-container {
    padding: 2rem 0;
    background: #f8f9fa;
    min-height: calc(100vh - 200px);
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.dashboard-title h1 {
    margin: 0;
    color: #2c3e50;
    font-size: 1.8rem;
}

.dashboard-title p {
    margin: 0.5rem 0 0 0;
    color: #7f8c8d;
}

.dashboard-actions {
    display: flex;
    gap: 1rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
}

.stat-content h3 {
    margin: 0;
    font-size: 2rem;
    color: #2c3e50;
}

.stat-content p {
    margin: 0;
    color: #7f8c8d;
}

.dashboard-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
}

.dashboard-card {
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
    color: white;
    padding: 1rem 1.5rem;
}

.card-header h3 {
    margin: 0;
    font-size: 1.2rem;
}

.card-content {
    padding: 1.5rem;
}

.user-stats {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.user-stat {
    display: flex;
    justify-content: space-between;
    padding: 0.5rem;
    background: #f8f9fa;
    border-radius: 5px;
}

.stat-label {
    color: #2c3e50;
    font-weight: 500;
}

.stat-value {
    color: #667eea;
    font-weight: bold;
}

.card-actions {
    display: flex;
    gap: 0.5rem;
}

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.activity-icon {
    color: #e74c3c;
    font-size: 1.2rem;
}

.activity-details p {
    margin: 0;
    font-weight: 500;
}

.activity-details small {
    color: #7f8c8d;
}

.config-options {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1rem;
}

.config-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.config-item:hover {
    background: #e9ecef;
}

.config-item i {
    color: #e74c3c;
    font-size: 1.2rem;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.quick-action {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-decoration: none;
    color: #2c3e50;
    transition: all 0.3s ease;
}

.quick-action:hover {
    background: #e74c3c;
    color: white;
    transform: translateY(-2px);
}

.quick-action i {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.quick-action span {
    font-size: 0.9rem;
    text-align: center;
}

@media (max-width: 768px) {
    .dashboard-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection 