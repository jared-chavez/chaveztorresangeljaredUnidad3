@extends('layouts.app')
@section('content')
<div class="contact-section">
    <div class="contact-form-container">
        <h1>Recuperar Contraseña</h1>
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
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div>
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" maxlength="100">
            </div>
            <button type="submit">Enviar enlace de recuperación</button>
        </form>
        @else
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ request('token', $token ?? '') }}">
            <input type="hidden" name="email" value="{{ request('email', $email ?? '') }}">
            <div>
                <label for="password">Nueva contraseña</label>
                <input type="password" name="password" id="password" minlength="6">
            </div>
            <div>
                <label for="password_confirmation">Confirmar nueva contraseña</label>
                <input type="password" name="password_confirmation" id="password_confirmation" minlength="6">
            </div>
            <button type="submit">Restablecer contraseña</button>
        </form>
        @endif
    </div>
</div>
@endsection 