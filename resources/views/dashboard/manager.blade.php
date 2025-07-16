@extends('layouts.app')

@section('title', 'Dashboard Gerente - AutoMundo')

@section('content')
<div class="dashboard-container">
    <div class="container">
        <!-- Header del Dashboard -->
        <div class="dashboard-header">
            <div class="dashboard-title">
                <h1><i class="fas fa-user-tie"></i> Panel de Gerencia</h1>
                <p>Bienvenido, {{ Auth::user()->name }} - {{ Auth::user()->getRoleDisplayName() }}</p>
            </div>
            <div class="dashboard-actions">
                <a href="{{ route('manager.sales') }}" class="btn btn-primary">
                    <i class="fas fa-users"></i> Gestionar Vendedores
                </a>
                <a href="{{ route('manager.reports') }}" class="btn btn-outline">
                    <i class="fas fa-chart-bar"></i> Reportes
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
                    <h3>{{ \App\Models\User::where('role', 'sales')->count() }}</h3>
                    <p>Vendedores</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-car"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ \App\Models\Car::count() }}</h3>
                    <p>Vehículos en Inventario</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <div class="stat-content">
                    <h3>{{ \App\Models\User::where('role', 'customer')->count() }}</h3>
                    <p>Clientes</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-content">
                    <h3>85%</h3>
                    <p>Meta de Ventas</p>
                </div>
            </div>
        </div>

        <!-- Grid de Tarjetas -->
        <div class="dashboard-grid">
            <!-- Gestión de Vendedores -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-user-tie"></i> Equipo de Ventas</h3>
                </div>
                <div class="card-content">
                    <div class="sales-team">
                        @php
                            $salesUsers = \App\Models\User::where('role', 'sales')->take(5)->get();
                        @endphp
                        @forelse($salesUsers as $salesUser)
                        <div class="team-member">
                            <div class="member-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="member-info">
                                <h4>{{ $salesUser->name }}</h4>
                                <p>{{ $salesUser->email }}</p>
                                <small>Miembro desde {{ $salesUser->created_at->format('M Y') }}</small>
                            </div>
                            <div class="member-status">
                                <span class="status-badge online">Activo</span>
                            </div>
                        </div>
                        @empty
                        <div class="empty-state">
                            <i class="fas fa-users"></i>
                            <p>No hay vendedores registrados</p>
                        </div>
                        @endforelse
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('manager.sales') }}" class="btn btn-primary">Ver Todos</a>
                        <button class="btn btn-outline">Agregar Vendedor</button>
                    </div>
                </div>
            </div>

            <!-- Reportes de Ventas -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-chart-bar"></i> Reportes de Ventas</h3>
                </div>
                <div class="card-content">
                    <div class="sales-reports">
                        <div class="report-item">
                            <div class="report-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="report-details">
                                <h4>Ventas del Mes</h4>
                                <p class="report-value">$125,000</p>
                                <small class="report-change positive">+12% vs mes anterior</small>
                            </div>
                        </div>
                        <div class="report-item">
                            <div class="report-icon">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="report-details">
                                <h4>Vehículos Vendidos</h4>
                                <p class="report-value">24</p>
                                <small class="report-change positive">+3 vs mes anterior</small>
                            </div>
                        </div>
                        <div class="report-item">
                            <div class="report-icon">
                                <i class="fas fa-percentage"></i>
                            </div>
                            <div class="report-details">
                                <h4>Tasa de Conversión</h4>
                                <p class="report-value">68%</p>
                                <small class="report-change negative">-2% vs mes anterior</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('manager.reports') }}" class="btn btn-primary">Ver Reporte Completo</a>
                    </div>
                </div>
            </div>

            <!-- Inventario -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-warehouse"></i> Estado del Inventario</h3>
                </div>
                <div class="card-content">
                    <div class="inventory-status">
                        <div class="inventory-item">
                            <span class="inventory-label">Vehículos Disponibles:</span>
                            <span class="inventory-value">{{ \App\Models\Car::count() }}</span>
                        </div>
                        <div class="inventory-item">
                            <span class="inventory-label">En Proceso de Venta:</span>
                            <span class="inventory-value">5</span>
                        </div>
                        <div class="inventory-item">
                            <span class="inventory-label">Pendientes de Llegada:</span>
                            <span class="inventory-value">12</span>
                        </div>
                        <div class="inventory-item">
                            <span class="inventory-label">En Mantenimiento:</span>
                            <span class="inventory-value">3</span>
                        </div>
                    </div>
                    <div class="card-actions">
                        <a href="{{ route('cars.index') }}" class="btn btn-primary">Ver Inventario</a>
                        <button class="btn btn-outline">Actualizar Stock</button>
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
                        <a href="{{ route('manager.sales') }}" class="quick-action">
                            <i class="fas fa-user-plus"></i>
                            <span>Agregar Vendedor</span>
                        </a>
                        <a href="{{ route('cars.index') }}" class="quick-action">
                            <i class="fas fa-car"></i>
                            <span>Gestionar Inventario</span>
                        </a>
                        <a href="{{ route('manager.reports') }}" class="quick-action">
                            <i class="fas fa-download"></i>
                            <span>Generar Reporte</span>
                        </a>
                        <a href="#" class="quick-action">
                            <i class="fas fa-cog"></i>
                            <span>Configuración</span>
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
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
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
    background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
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

.sales-team {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1rem;
}

.team-member {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.member-avatar {
    color: #f39c12;
    font-size: 2rem;
}

.member-info h4 {
    margin: 0;
    color: #2c3e50;
    font-size: 1rem;
}

.member-info p {
    margin: 0.25rem 0;
    color: #7f8c8d;
    font-size: 0.9rem;
}

.member-info small {
    color: #95a5a6;
    font-size: 0.8rem;
}

.member-status {
    margin-left: auto;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-badge.online {
    background: #27ae60;
    color: white;
}

.sales-reports {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-bottom: 1rem;
}

.report-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.report-icon {
    color: #f39c12;
    font-size: 1.5rem;
}

.report-details h4 {
    margin: 0;
    color: #2c3e50;
    font-size: 0.9rem;
}

.report-value {
    margin: 0.25rem 0;
    font-size: 1.5rem;
    font-weight: bold;
    color: #2c3e50;
}

.report-change {
    font-size: 0.8rem;
}

.report-change.positive {
    color: #27ae60;
}

.report-change.negative {
    color: #e74c3c;
}

.inventory-status {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    margin-bottom: 1rem;
}

.inventory-item {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem;
    background: #f8f9fa;
    border-radius: 5px;
}

.inventory-label {
    color: #2c3e50;
    font-weight: 500;
}

.inventory-value {
    color: #f39c12;
    font-weight: bold;
}

.card-actions {
    display: flex;
    gap: 0.5rem;
}

.empty-state {
    text-align: center;
    padding: 2rem;
    color: #7f8c8d;
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
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
    background: #f39c12;
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