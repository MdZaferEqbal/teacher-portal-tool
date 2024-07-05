@extends('layouts.main')
@push('title')
    <title>Teacher-Portal | Login</title>
@endpush
@section('main-section')
    <div class="container ">
        <h1 class="text-center text-danger mt-2">Teacher-Portal | LogIn</h1>
        <div class="d-flex justify-content-center align-items-center mt-4 p-5">
            <form action="{{route('login')}}" method="POST">
                @csrf
                <x-custom-input label="Email" id="ttp-email" name="email" placeholder="Email" value="{{old('email')}}" icon='<i class="fa-solid fa-user"></i>' type="email" required="TRUE"/>
                <x-custom-input label="Password" id="ttp-password" name="password" value="{{old('password')}}" icon='<i class="fa-solid fa-lock"></i>' placeholder="Password" type="password" required="TRUE"/>
                {{-- <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input bg-dark" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Remember me</label>
                </div> --}}
                <button class="btn btn-dark w-100 log-in-btn w-100" type="submit">Log In</button>
                @session('error')
                    <div class="text-danger mt-2">
                        {!!session('error')!!}
                    </div>
                @endsession
            </form>
        </div>
    </div>
@endsection
