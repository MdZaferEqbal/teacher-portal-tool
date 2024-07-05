@extends('layouts.main')
@push('title')
    <title>Teacher-Portal | Unauthroized</title>
@endpush
@section('main-section')
    <div class="container">
        <h1 class="text-center text-danger mt-2">Unauthroized: <a class="text-info" href="{{url('/login')}}">LogIn</a> or <a class="text-info" href="{{url('/signUp')}}">SignUp</a> to access this page.</h1>
    </div>
@endsection
