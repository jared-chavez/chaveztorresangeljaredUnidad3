@extends('layouts.app')

@section('title', 'Financiamiento | AutoMundo')

@section('content')
<section id="planes" class="financiamiento-planes-section animate__animated animate__fadeInUp" style="margin-top:48px;">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Nuestros Planes</span>
            <h2 class="section-title">Elige el plan ideal para ti</h2>
        </div>
        <div class="financiamiento-cards-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:32px;">
            <div class="financiamiento-card animate__animated animate__zoomIn" style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;transition:transform .2s;">
                <img src="https://images.unsplash.com/photo-1503736334956-4c8f8e92946d?auto=format&fit=crop&w=600&q=80" alt="Plan Tradicional" style="width:100%;height:180px;object-fit:cover;">
                <div style="padding:24px;">
                    <h3 style="color:#d32f2f;font-weight:700;font-size:1.3em;margin-bottom:8px;">Plan Tradicional</h3>
                    <p style="color:#444;">Pagos fijos mensuales y plazos flexibles. ¡Elige el auto que más te guste y págalo a tu ritmo!</p>
                </div>
            </div>
            <div class="financiamiento-card animate__animated animate__zoomIn" style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;transition:transform .2s;animation-delay:0.1s;">
                <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=600&q=80" alt="Plan Balloon" style="width:100%;height:180px;object-fit:cover;">
                <div style="padding:24px;">
                    <h3 style="color:#ff9800;font-weight:700;font-size:1.3em;margin-bottom:8px;">Plan Balloon</h3>
                    <p style="color:#444;">Pagos mensuales bajos y un pago final mayor. Ideal si buscas cuotas accesibles y flexibilidad al final del plazo.</p>
                </div>
            </div>
            <div class="financiamiento-card animate__animated animate__zoomIn" style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;transition:transform .2s;animation-delay:0.2s;">
                <img src="https://images.pexels.com/photos/164634/pexels-photo-164634.jpeg?auto=compress&w=600&h=400&fit=crop" alt="Plan Anualidades" style="width:100%;height:180px;object-fit:cover;">
                <div style="padding:24px;">
                    <h3 style="color:#1976d2;font-weight:700;font-size:1.3em;margin-bottom:8px;">Plan Anualidades</h3>
                    <p style="color:#444;">Realiza pagos anuales y disfruta de mayor liquidez mes a mes. Perfecto para quienes reciben ingresos anuales.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="financiamiento-leasing-section animate__animated animate__fadeInUp">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Arrendamientos</span>
            <h2 class="section-title">Opciones de Arrendamiento</h2>
        </div>
        <div class="financiamiento-cards-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:32px;">
            <div class="financiamiento-card animate__animated animate__zoomIn" style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;transition:transform .2s;">
                <img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=600&q=80" alt="Arrendamiento Financiero" style="width:100%;height:180px;object-fit:cover;">
                <div style="padding:24px;">
                    <h3 style="color:#388e3c;font-weight:700;font-size:1.3em;margin-bottom:8px;">Arrendamiento Financiero</h3>
                    <p style="color:#444;">Adquiere tu auto con pagos mensuales y opción a compra al final del contrato. Ideal para empresas y profesionistas.</p>
                </div>
            </div>
            <div class="financiamiento-card animate__animated animate__zoomIn" style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;transition:transform .2s;animation-delay:0.1s;">
                <img src="https://images.unsplash.com/photo-1502877338535-766e1452684a?auto=format&fit=crop&w=600&q=80" alt="Arrendamiento Puro" style="width:100%;height:180px;object-fit:cover;">
                <div style="padding:24px;">
                    <h3 style="color:#7b1fa2;font-weight:700;font-size:1.3em;margin-bottom:8px;">Arrendamiento Puro</h3>
                    <p style="color:#444;">Utiliza el auto por el tiempo que lo necesites y al final decide si lo renuevas, lo devuelves o lo compras.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="financiamiento-promos-section animate__animated animate__fadeInUp">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Promociones</span>
            <h2 class="section-title">Ofertas Especiales</h2>
        </div>
        <div class="financiamiento-cards-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:32px;">
            <div class="financiamiento-card animate__animated animate__zoomIn" style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;transition:transform .2s;">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80" alt="Tasas Preferenciales" style="width:100%;height:180px;object-fit:cover;">
                <div style="padding:24px;">
                    <h3 style="color:#d32f2f;font-weight:700;font-size:1.3em;margin-bottom:8px;">Tasas Preferenciales</h3>
                    <p style="color:#444;">Aprovecha tasas de interés exclusivas por tiempo limitado. ¡Pregunta por nuestras promociones vigentes!</p>
                </div>
            </div>
            <div class="financiamiento-card animate__animated animate__zoomIn" style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;transition:transform .2s;animation-delay:0.1s;">
                <img src="https://images.pexels.com/photos/210574/pexels-photo-210574.jpeg?auto=compress&w=600&h=400&fit=crop" alt="Bonos y Beneficios" style="width:100%;height:180px;object-fit:cover;">
                <div style="padding:24px;">
                    <h3 style="color:#ff9800;font-weight:700;font-size:1.3em;margin-bottom:8px;">Bonos y Beneficios</h3>
                    <p style="color:#444;">Recibe bonos de descuento, meses sin intereses o servicios incluidos al contratar tu financiamiento.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="financiamiento-info-section animate__animated animate__fadeInUp">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">¿Cómo funciona?</span>
            <h2 class="section-title">Proceso sencillo y transparente</h2>
        </div>
        <div class="financiamiento-cards-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:32px;">
            <div class="financiamiento-card animate__animated animate__zoomIn" style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;transition:transform .2s;">
                <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=600&q=80" alt="Elige tu auto" style="width:100%;height:180px;object-fit:cover;">
                <div style="padding:24px;">
                    <h3 style="color:#1976d2;font-weight:700;font-size:1.15em;margin-bottom:8px;">1. Elige tu auto y el plan que más te convenga</h3>
                    <p style="color:#444;">Explora nuestro catálogo y selecciona la opción de financiamiento que se adapte a tus necesidades.</p>
                </div>
            </div>
            <div class="financiamiento-card animate__animated animate__zoomIn" style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;transition:transform .2s;animation-delay:0.1s;">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=600&q=80" alt="Presenta tu documentación" style="width:100%;height:180px;object-fit:cover;">
                <div style="padding:24px;">
                    <h3 style="color:#388e3c;font-weight:700;font-size:1.15em;margin-bottom:8px;">2. Presenta tu documentación básica</h3>
                    <p style="color:#444;">Te guiaremos en el proceso para que entregues los documentos necesarios de forma sencilla y rápida.</p>
                </div>
            </div>
            <div class="financiamiento-card animate__animated animate__zoomIn" style="background:#fff;border-radius:18px;box-shadow:0 4px 24px rgba(0,0,0,0.08);overflow:hidden;transition:transform .2s;animation-delay:0.2s;">
                <img src="https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=600&q=80" alt="Recibe aprobación" style="width:100%;height:180px;object-fit:cover;">
                <div style="padding:24px;">
                    <h3 style="color:#d32f2f;font-weight:700;font-size:1.15em;margin-bottom:8px;">3. Recibe aprobación y estrena tu auto</h3>
                    <p style="color:#444;">Una vez aprobado tu crédito, ¡solo queda disfrutar tu nuevo auto!</p>
                </div>
            </div>
        </div>
        <div class="financiamiento-legal animate__animated animate__fadeIn animate__delay-1s" style="margin-top:32px;">
            <p style="font-size:0.95em;color:#888;">
                <strong>Aviso de Privacidad:</strong> Tu información está protegida conforme a la ley. Consulta nuestro aviso de privacidad para más detalles.
            </p>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<!-- Animate.css for animations -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
@endsection 