@extends('layouts.app')

@section('title', 'Dashboard Vendedor - AutoMundo')

@section('content')
<div class="dashboard-container">
    <div class="container">
        <!-- Header del Dashboard -->
        <div class="dashboard-header">
            <div class="dashboard-title">
                <h1><i class="fas fa-chart-line"></i> Panel de Ventas</h1>
                <p>Bienvenido, {{ Auth::user()->name }} - {{ Auth::user()->getRoleDisplayName() }}</p>
            </div>
            <div class="dashboard-actions">
                <a href="{{ route('cars.index') }}" class="btn btn-primary">
                    <i class="fas fa-car"></i> Ver Inventario
                </a>
            </div>
        </div>

        <!-- Estadísticas Principales -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ \App\Models\Car::count() }}</h3>
                    <p>Vehículos Disponibles</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ \App\Models\User::where('role', 'customer')->count() }}</h3>
                    <p>Clientes Potenciales</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stat-content">
                    <h3>0</h3>
                    <p>Ventas del Mes</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-percentage"></i>
                </div>
                <div class="stat-content">
                    <h3>0%</h3>
                    <p>Comisión del Mes</p>
                </div>
            </div>
        </div>

        <!-- Grid de Tarjetas -->
        <div class="dashboard-grid">
            <!-- Inventario de Vehículos -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-car"></i> Inventario de Vehículos</h3>
                </div>
                <div class="card-content">
                    <div class="inventory-stats">
                        <div class="inventory-stat">
                            <span class="stat-label">Total de Vehículos:</span>
                            <span class="stat-value">{{ \App\Models\Car::count() }}</span>
                        </div>
                        <div class="inventory-stat">
                            <span class="stat-label">Disponibles:</span>
                            <span class="stat-value">{{ \App\Models\Car::count() }}</span>
                        </div>
                        <div class="inventory-stat">
                            <span class="stat-label">Reservados:</span>
                            <span class="stat-value">0</span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('cars.index') }}" class="btn btn-primary">Ver Inventario</a>
                    </div>
                </div>
            </div>

            <!-- Actividad Reciente -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-clock"></i> Actividad Reciente</h3>
                </div>
                <div class="card-content">
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="activity-details">
                                <p><strong>Nuevo vehículo agregado</strong></p>
                                <small>Hace 2 horas</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="activity-details">
                                <p><strong>Cliente interesado en Toyota Camry</strong></p>
                                <small>Hace 1 día</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="activity-details">
                                <p><strong>Llamada de seguimiento realizada</strong></p>
                                <small>Hace 2 días</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Clientes Potenciales -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-users"></i> Clientes Potenciales</h3>
                </div>
                <div class="card-content">
                    <div class="clients-list">
                        <div class="client-item">
                            <div class="client-info">
                                <strong>Juan Pérez</strong>
                                <small>Interesado en SUV</small>
                            </div>
                            <div class="client-status">
                                <span class="status-badge hot">Caliente</span>
                            </div>
                        </div>
                        <div class="client-item">
                            <div class="client-info">
                                <strong>María García</strong>
                                <small>Buscando vehículo familiar</small>
                            </div>
                            <div class="client-status">
                                <span class="status-badge warm">Tibio</span>
                            </div>
                        </div>
                        <div class="client-item">
                            <div class="client-info">
                                <strong>Carlos López</strong>
                                <small>Interesado en deportivo</small>
                            </div>
                            <div class="client-status">
                                <span class="status-badge cold">Frío</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="#" class="btn btn-primary">Ver Todos</a>
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
                        <a href="{{ route('cars.index') }}" class="quick-action">
                            <i class="fas fa-car"></i>
                            <span>Ver Inventario</span>
                        </a>
                        <a href="#" class="quick-action">
                            <i class="fas fa-chart-bar"></i>
                            <span>Reporte de Ventas</span>
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
    background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
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
    background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
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

.inventory-stats {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.inventory-stat {
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
    color: #4ecdc4;
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
    color: #4ecdc4;
    font-size: 1.2rem;
}

.activity-details p {
    margin: 0;
    font-weight: 500;
}

.activity-details small {
    color: #7f8c8d;
}

.clients-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1rem;
}

.client-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.client-info strong {
    display: block;
    color: #2c3e50;
}

.client-info small {
    color: #7f8c8d;
}

.status-badge {
    padding: 4px 8px;
    border-radius: 12px;
    font-size: 11px;
    font-weight: 500;
}

.status-badge.hot {
    background: #ff6b6b;
    color: white;
}

.status-badge.warm {
    background: #ffa726;
    color: white;
}

.status-badge.cold {
    background: #90a4ae;
    color: white;
}

.quick-actions {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
    max-width: 300px;
    margin: 0 auto;
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
    background: #4ecdc4;
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
    background: linear-gradient(135deg, #4ecdc4, #44a08d);
    color: white;
}

.btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(78, 205, 196, 0.3);
}

.btn-outline {
    background: transparent;
    color: #4ecdc4;
    border: 2px solid #4ecdc4;
}

.btn-outline:hover {
    background: #4ecdc4;
    color: white;
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