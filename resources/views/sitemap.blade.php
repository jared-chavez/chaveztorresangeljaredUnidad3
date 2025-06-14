@extends('layouts.app')
@section('content')
<h1>Mapa del Sitio</h1>
<ul>
    <li><a href="{{ route('home') }}">Inicio</a></li>
    <li><a href="{{ route('cars.index') }}">Gestión de Autos</a></li>
    <li><a href="{{ route('register') }}">Registrar</a></li>
    <li><a href="{{ route('login') }}">Iniciar Sesión</a></li>
    <li><a href="{{ route('mailbox') }}">Buzón</a></li>
    <li><a href="{{ route('help') }}">Ayuda</a></li>
    <li><a href="{{ route('contact') }}">Contáctanos</a></li>
    <li><a href="{{ route('sitemap') }}">Mapa del Sitio</a></li>
    <li><a href="{{ route('password.recovery') }}">Recuperación de Contraseña</a></li>
    <li><a href="{{ route('chat') }}">Chat</a></li>
    <li><a href="{{ route('search') }}">Búsqueda</a></li>
</ul>
@endsection 