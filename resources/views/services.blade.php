@extends('layouts.app')

@section('title', 'Servicios | AutoMundo')

@section('content')
<section class="services-hero-section">
    <div class="container">
        <div class="services-hero-content">
            <div class="services-hero-text">
                <h1 class="services-hero-title">Servicios Profesionales para tu Auto</h1>
                <p class="services-hero-subtitle">
                    En <b>AutoMundo</b> cuidamos tu vehículo como si fuera nuestro. Descubre todos los servicios que tenemos para ti, realizados por expertos y con la mejor atención.
                </p>
            </div>
            <div class="services-hero-img">
                <img src="https://img.icons8.com/ios-filled/150/ff9800/car-service.png" alt="Servicios AutoMundo">
            </div>
        </div>
    </div>
</section>

<section class="services-grid-section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Nuestros Servicios</span>
            <h2 class="section-title">Todo lo que tu auto necesita</h2>
        </div>
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-tools"></i></div>
                <h3>Mantenimiento Preventivo</h3>
                <p>Revisiones periódicas, cambios de aceite, filtros y más para mantener tu auto en óptimas condiciones.</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-cogs"></i></div>
                <h3>Reparaciones Generales</h3>
                <p>Solucionamos cualquier problema mecánico o eléctrico con refacciones originales y garantía.</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-search"></i></div>
                <h3>Diagnóstico Computarizado</h3>
                <p>Equipos de última generación para detectar fallas y optimizar el rendimiento de tu vehículo.</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Garantía y Seguros</h3>
                <p>Protege tu inversión con nuestras garantías extendidas y opciones de seguro automotriz.</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-road"></i></div>
                <h3>Asistencia Vial 24/7</h3>
                <p>Te apoyamos en carretera o ciudad con grúa, paso de corriente, cambio de llanta y más.</p>
            </div>
            <div class="service-card">
                <div class="service-icon"><i class="fas fa-car-side"></i></div>
                <h3>Estética Automotriz</h3>
                <p>Lavado, encerado, pulido y detallado profesional para que tu auto luzca siempre como nuevo.</p>
            </div>
        </div>
    </div>
</section>

<section class="why-choose-section">
    <div class="container">
        <div class="why-choose-content">
            <div class="why-choose-text">
                <h2>¿Por qué elegir AutoMundo?</h2>
                <ul>
                    <li><i class="fas fa-user-check"></i> Técnicos certificados y atención personalizada</li>
                    <li><i class="fas fa-certificate"></i> Refacciones originales y garantía en cada servicio</li>
                    <li><i class="fas fa-clock"></i> Rapidez, transparencia y precios competitivos</li>
                </ul>
            </div>
            <div class="why-choose-img">
                <img src="https://img.icons8.com/ios-filled/120/ff9800/checked-2--v1.png" alt="Por qué elegirnos">
            </div>
        </div>
    </div>
</section>

<section class="services-cta-section">
    <div class="container">
        <div class="services-cta-content">
            <h2>¿Listo para agendar tu servicio?</h2>
            <p>Contáctanos y recibe la mejor atención para tu auto.</p>
            <a href="{{ route('contact') }}" class="btn btn-primary btn-large"><i class="fas fa-calendar-check"></i> Agendar Servicio</a>
        </div>
    </div>
</section>
@endsection 