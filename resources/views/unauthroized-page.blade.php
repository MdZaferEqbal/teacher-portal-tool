@php
    http_response_code(401);
@endphp
@extends('layouts.main')
@push('title')
    <title>Unauthroized</title>
@endpush
@section('main-section')
    <div class="container text-center">
        <h1 class="text-danger mt-2">401 Unauthroized: <a class="text-secondary" href="{{url('/login')}}">Log In</a> or <a class="text-secondary" href="{{url('/signUp')}}">Sign Up</a> to access this page.</h1>
    </div>
@endsection
