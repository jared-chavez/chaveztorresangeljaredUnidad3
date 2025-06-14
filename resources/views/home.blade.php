@extends('layouts.app')

@section('content')
    <div style="text-align:center; margin-top:40px;">
        <h1 style="font-size:2.5em; color:#007bff;">¡Bienvenido a AutoMundo!</h1>
        <p style="font-size:1.2em; margin: 20px auto; max-width: 600px;">
            Tu portal divertido y sencillo para gestionar autos.<br>
            ¡Explora, experimenta y diviértete!
        </p>
        <div style="margin: 30px 0;">
            <a href="{{ route('cars.index') }}" class="btn" style="margin: 0 10px;">Gestión de Autos</a>
            <a href="{{ route('register') }}" class="btn" style="margin: 0 10px;">Registrar</a>
            <a href="{{ route('login') }}" class="btn" style="margin: 0 10px;">Iniciar Sesión</a>
            <a href="{{ route('sitemap') }}" class="btn" style="margin: 0 10px;">Mapa del Sitio</a>
            <a href="{{ route('contact') }}" class="btn" style="margin: 0 10px;">Contáctanos</a>
        </div>
        <img src="https://cdn.pixabay.com/photo/2013/07/12/13/58/car-147017_1280.png" alt="AutoMundo" style="max-width:200px; margin-top:30px;">
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
    <!-- Begin Zoho SalesIQ Script -->
    <script type='text/javascript'>
        var $zoho = $zoho || {};
        $zoho.salesiq = $zoho.salesiq || {
            widgetcode: "UN-CÓDIGO-LARGO-AQUÍ",
            values: {},
            ready: function() {}
        };
        var d = document;
        s = d.createElement("script");
        s.type = "text/javascript";
        s.id = "zsiqscript";
        s.defer = true;
        s.src = "https://salesiq.zoho.com/widget";
        t = d.getElementsByTagName("script")[0];
        t.parentNode.insertBefore(s, t);
    </script>
    <!-- End Zoho SalesIQ Script -->
@endsection