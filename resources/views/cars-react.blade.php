@extends('layouts.app')

@section('content')
<div id="app"></div>
@endsection
 
@section('scripts')
@vite(['resources/css/app.css', 'resources/js/react-app.jsx'])
@endsection 