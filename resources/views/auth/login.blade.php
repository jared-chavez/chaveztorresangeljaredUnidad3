@extends('layouts.app')

@section('content')
<div class="contact-section">
    <div class="contact-form-container">
        <h1>Iniciar Sesión</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div>
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus>
            </div>
            <div>
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            </div>
            <button type="submit">Iniciar sesión</button>
        </form>
        <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </div>
</div>
@endsection 