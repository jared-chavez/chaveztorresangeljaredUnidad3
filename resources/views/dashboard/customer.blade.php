@extends('layouts.app')

@section('title', 'Mi Dashboard - AutoMundo')

@section('content')
<div class="dashboard-container">
    <div class="container">
        <!-- Header del Dashboard -->
        <div class="dashboard-header">
            <div class="dashboard-title">
                <h1><i class="fas fa-user-circle"></i> Mi Dashboard</h1>
                <p>Bienvenido, {{ Auth::user()->name }} - {{ Auth::user()->getRoleDisplayName() }}</p>
            </div>
            <div class="dashboard-actions">
                <a href="{{ route('cars.index') }}" class="btn btn-primary">
                    <i class="fas fa-car"></i> Ver Vehículos
                </a>
                <a href="{{ route('contact') }}" class="btn btn-outline">
                    <i class="fas fa-headset"></i> Soporte
                </a>
            </div>
        </div>

        <!-- Grid de Tarjetas -->
        <div class="dashboard-grid">
            <!-- Perfil del Usuario -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-user"></i> Mi Perfil</h3>
                </div>
                <div class="card-content">
                    <div class="profile-info">
                        <div class="profile-avatar">
                            <i class="fas fa-user-circle fa-3x"></i>
                        </div>
                        <div class="profile-details">
                            <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
                            <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            <p><strong>Tipo de cuenta:</strong> {{ Auth::user()->getRoleDisplayName() }}</p>
                            <p><strong>Miembro desde:</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                    <div class="profile-actions">
                        <button class="btn btn-sm btn-outline">Editar Perfil</button>
                        <button class="btn btn-sm btn-outline">Cambiar Contraseña</button>
                    </div>
                </div>
            </div>

            <!-- Vehículos Favoritos -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-heart"></i> Vehículos Favoritos</h3>
                </div>
                <div class="card-content">
                    <div class="favorites-list">
                        <div class="empty-state">
                            <i class="fas fa-heart-broken"></i>
                            <p>No tienes vehículos favoritos aún</p>
                            <a href="{{ route('cars.index') }}" class="btn btn-sm btn-primary">Explorar Vehículos</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historial de Actividad -->
            <div class="dashboard-card">
                <div class="card-header">
                    <h3><i class="fas fa-history"></i> Actividad Reciente</h3>
                </div>
                <div class="card-content">
                    <div class="activity-list">
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <div class="activity-details">
                                <p><strong>Inicio de sesión</strong></p>
                                <small>{{ now()->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="activity-details">
                                <p><strong>Cuenta creada</strong></p>
                                <small>{{ Auth::user()->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                        </div>
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
                            <span>Ver Vehículos</span>
                        </a>
                        <a href="{{ route('financiamiento') }}" class="quick-action">
                            <i class="fas fa-calculator"></i>
                            <span>Calcular Financiamiento</span>
                        </a>
                        <a href="{{ route('contact') }}" class="quick-action">
                            <i class="fas fa-envelope"></i>
                            <span>Contactar</span>
                        </a>
                        <a href="{{ route('services') }}" class="quick-action">
                            <i class="fas fa-tools"></i>
                            <span>Servicios</span>
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

.profile-info {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.profile-avatar {
    color: #667eea;
}

.profile-details p {
    margin: 0.25rem 0;
    color: #2c3e50;
}

.profile-actions {
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
    color: #667eea;
    font-size: 1.2rem;
}

.activity-details p {
    margin: 0;
    font-weight: 500;
}

.activity-details small {
    color: #7f8c8d;
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
    background: #667eea;
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
    
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection 