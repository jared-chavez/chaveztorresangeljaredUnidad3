@extends('layouts.app')

@section('content')
<div class="contact-section">
    <div class="contact-form-container">
        <h1 class="form-title">Iniciar Sesión</h1>
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
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" autofocus class="form-input">
            </div>
            <div>
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" name="password" id="password" class="form-input">
            </div>
            <div>
                <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
            </div>
            <button type="submit" class="form-btn">Iniciar sesión</button>
        </form>
        <p class="form-link">¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a></p>
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </div>
</div>
@endsection 