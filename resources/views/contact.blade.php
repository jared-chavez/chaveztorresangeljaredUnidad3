@extends('layouts.app')
@section('content')
<div class="contact-section">
    <div class="contact-form-container">
        <h1 class="form-title">Contáctanos</h1>
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
        <form method="POST" action="{{ route('contact.send') }}">
            @csrf
            <div>
                <label for="name" class="form-label">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" maxlength="100" class="form-input">
            </div>
            <div>
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" maxlength="100" class="form-input">
            </div>
            <div>
                <label for="phone" class="form-label">Teléfono</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" pattern="[0-9\-\+\s]{7,20}" maxlength="20" class="form-input">
            </div>
            <div>
                <label for="subject" class="form-label">Asunto</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" maxlength="150" class="form-input">
            </div>
            <div>
                <label for="message" class="form-label">Mensaje</label>
                <textarea name="message" id="message" rows="5" maxlength="1000" class="form-input">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="form-btn">Enviar mensaje</button>
        </form>
    </div>
</div>
@endsection 