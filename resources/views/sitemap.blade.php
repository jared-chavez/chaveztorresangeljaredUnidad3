@extends('layouts.app')
@section('content')
<h1>Mapa del Sitio</h1>
<div class="sitemap-carousel" style="padding-left: 64px; padding-right: 64px;">
  <div class="sitemap-card">
    <img src="https://img.icons8.com/ios-filled/100/007bff/home.png" alt="Inicio">
    <a href="{{ route('home') }}">Inicio</a>
  </div>
  <div class="sitemap-card">
    <img src="https://img.icons8.com/ios-filled/100/007bff/car.png" alt="Gestión de Autos">
    <a href="{{ route('cars.index') }}">Gestión de Autos</a>
  </div>
  <div class="sitemap-card">
    <img src="https://img.icons8.com/ios-filled/100/007bff/add-user-group-man-man.png" alt="Registrar">
    <a href="{{ route('register') }}">Registrar</a>
  </div>
  <div class="sitemap-card">
    <img src="https://img.icons8.com/ios-filled/100/007bff/lock-2.png" alt="Iniciar Sesión">
    <a href="{{ route('login') }}">Iniciar Sesión</a>
  </div>
  <div class="sitemap-card">
    <img src="https://img.icons8.com/ios-filled/100/007bff/help.png" alt="Ayuda">
    <a href="{{ route('home') }}#tawk-chatbot" id="ayuda-link">Ayuda</a>
  </div>
  <div class="sitemap-card">
    <img src="https://img.icons8.com/ios-filled/100/007bff/secured-letter.png" alt="Contáctanos">
    <a href="{{ route('contact') }}">Contáctanos</a>
  </div>
  <div class="sitemap-card">
    <img src="https://img.icons8.com/ios-filled/100/007bff/password.png" alt="Recuperar Contraseña">
    <a href="{{ route('password.recovery') }}">Recuperar Contraseña</a>
  </div>
  <div class="sitemap-card">
    <img src="https://img.icons8.com/ios-filled/100/007bff/search--v1.png" alt="Búsqueda">
    <a href="{{ route('cars.index') }}#car-search">Búsqueda</a>
  </div>
</div>
@endsection 