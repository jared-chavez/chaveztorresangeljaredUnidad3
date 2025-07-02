@extends('layouts.app')

@section('title', 'AutoMundo - Tu Concesionario de Confianza')

@section('content')
    {{-- Hero Section --}}
    <section class="hero-section">
        <div class="hero-background">
            <div class="hero-overlay"></div>
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <h1 class="hero-title animate__animated animate__fadeInDown" style="animation-delay:0.1s;">
                            <span class="hero-highlight">Encuentra</span> tu auto ideal
                        </h1>
                        <p class="hero-subtitle animate__animated animate__fadeInUp" style="animation-delay:0.3s;">
                            Descubre nuestra amplia selección de vehículos nuevos, seminuevos y usados. 
                            Financiamiento flexible y servicio de excelencia.
                        </p>
                        <div class="hero-stats animate__animated animate__fadeIn animate__delay-1s">
                            <div class="stat-item">
                                <span class="stat-number">500+</span>
                                <span class="stat-label">Vehículos</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">20+</span>
                                <span class="stat-label">Años de Experiencia</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-number">10K+</span>
                                <span class="stat-label">Clientes Satisfechos</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero-image animate__animated animate__zoomIn" style="animation-delay:0.5s;">
                        <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="AutoMundo - Vehículos de Calidad">
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="features-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">¿Por qué elegirnos?</span>
                <h2 class="section-title">Tu confianza es nuestra prioridad</h2>
                <p class="section-subtitle">
                    Más de dos décadas ofreciendo la mejor experiencia en la compra y venta de vehículos
                </p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Garantía Extendida</h3>
                    <p>Todos nuestros vehículos incluyen garantía y respaldo técnico especializado</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h3>Financiamiento Flexible</h3>
                    <p>Opciones de crédito adaptadas a tus necesidades con tasas competitivas</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Servicio Técnico</h3>
                    <p>Taller especializado con técnicos certificados y repuestos originales</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Atención 24/7</h3>
                    <p>Asistencia vial y soporte técnico disponible las 24 horas del día</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Process Section --}}
    <section class="process-section">
        <div class="container">
            <div class="section-header">
                <span class="section-badge">Proceso Simple</span>
                <h2 class="section-title">Compra tu auto en 4 pasos</h2>
                <p class="section-subtitle">
                    Hacemos que el proceso de compra sea rápido, seguro y transparente
                </p>
            </div>
            <div class="process-steps">
                <div class="process-step">
                    <div class="step-number">01</div>
                    <div class="step-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Explora</h3>
                    <p>Navega por nuestro catálogo y encuentra el vehículo perfecto para ti</p>
                </div>
                <div class="process-step">
                    <div class="step-number">02</div>
                    <div class="step-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Agenda</h3>
                    <p>Programa una cita para ver el vehículo y realizar una prueba de manejo</p>
                </div>
                <div class="process-step">
                    <div class="step-number">03</div>
                    <div class="step-icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h3>Financia</h3>
                    <p>Elige el plan de financiamiento que mejor se adapte a tu presupuesto</p>
                </div>
                <div class="process-step">
                    <div class="step-number">04</div>
                    <div class="step-icon">
                        <i class="fas fa-key"></i>
                    </div>
                    <h3>Disfruta</h3>
                    <p>Recibe las llaves de tu nuevo vehículo y disfruta de la experiencia AutoMundo</p>
                </div>
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <span class="section-badge">Sobre Nosotros</span>
                    <h2 class="section-title">Más de 20 años de excelencia automotriz</h2>
                    <p class="about-description">
                        En AutoMundo, nos apasiona conectar a las personas con sus vehículos ideales. 
                        Desde 2003, hemos sido líderes en el mercado automotriz mexicano, ofreciendo 
                        una experiencia de compra excepcional respaldada por nuestro compromiso con 
                        la calidad y el servicio al cliente.
                    </p>
                    <div class="about-features">
                        <div class="about-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Vehículos certificados y garantizados</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Financiamiento personalizado</span>
                        </div>
                        <div class="about-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Servicio post-venta integral</span>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary">
                        <i class="fas fa-info-circle"></i>
                        Conoce más sobre nosotros
                    </a>
                </div>
                <div class="about-image">
                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="AutoMundo - Experiencia y Confianza">
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>¿Listo para encontrar tu auto ideal?</h2>
                <p>Únete a miles de clientes satisfechos que ya confían en AutoMundo</p>
                <div class="cta-actions">
                    <a href="{{ route('cars.index') }}" class="btn btn-primary btn-large">
                        <i class="fas fa-car"></i>
                        Ver Catálogo Completo
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline btn-large">
                        <i class="fas fa-phone"></i>
                        Contactar Asesor
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<!-- Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/684dffc60973de19088f189e/1itoau7ri';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
@endsection