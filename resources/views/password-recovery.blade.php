@extends('layouts.app')

@section('content')
<div class="contact-section">
    <div class="contact-form-container">
        <h1 class="form-title">Recuperar Contraseña</h1>
        
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
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
        
        @if(!request()->has('token') || !request()->has('email'))
            <div class="password-recovery-info">
                <p style="text-align: center; color: #666; margin-bottom: 1.5rem;">
                    Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña.
                </p>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div>
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" maxlength="100" class="form-input" autofocus placeholder="ejemplo@correo.com">
                </div>
                <button type="submit" class="form-btn">
                    <i class="fas fa-paper-plane"></i> Enviar enlace de recuperación
                </button>
            </form>
            <p class="form-link">
                <a href="{{ route('login') }}">
                    <i class="fas fa-arrow-left"></i> Volver al inicio de sesión
                </a>
            </p>
        @else
            <div class="password-recovery-info">
                <p style="text-align: center; color: #666; margin-bottom: 1.5rem;">
                    Establece tu nueva contraseña. Asegúrate de que tenga al menos 6 caracteres.
                </p>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ request('token', $token ?? '') }}">
                <input type="hidden" name="email" value="{{ request('email', $email ?? '') }}">
                <div>
                    <label for="password" class="form-label">Nueva contraseña</label>
                    <input type="password" name="password" id="password" minlength="6" class="form-input" autofocus placeholder="Mínimo 6 caracteres">
                </div>
                <div>
                    <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" minlength="6" class="form-input" placeholder="Repite tu nueva contraseña">
                </div>
                <button type="submit" class="form-btn">
                    <i class="fas fa-key"></i> Restablecer contraseña
                </button>
            </form>
            <p class="form-link">
                <a href="{{ route('login') }}">
                    <i class="fas fa-arrow-left"></i> Volver al inicio de sesión
                </a>
            </p>
        @endif
    </div>
</div>
@endsection 