@extends('layouts.app')
@section('content')
<div class="contact-section">
    <div class="contact-form-container">
        <h1>Contáctanos</h1>
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
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required maxlength="100">
            </div>
            <div>
                <label for="email">Correo electrónico</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required maxlength="100">
            </div>
            <div>
                <label for="phone">Teléfono</label>
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required pattern="[0-9\-\+\s]{7,20}" maxlength="20">
            </div>
            <div>
                <label for="subject">Asunto</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}" required maxlength="150">
            </div>
            <div>
                <label for="message">Mensaje</label>
                <textarea name="message" id="message" rows="5" required maxlength="1000">{{ old('message') }}</textarea>
            </div>
            <button type="submit">Enviar mensaje</button>
        </form>
    </div>
</div>
@endsection 