@extends('layouts.main')
@push('title')
    <title>Teacher-Portal | SignUp</title>
@endpush
@section('main-section')
    <div class="container">
        <h1 class="text-center text-danger mt-2">Teacher-Portal | Sign Up</h1>
        <div class="d-flex justify-content-center align-items-center mt-4 p-5">
            <form action="{{route('signup')}}" method="POST">
                @csrf
                <x-custom-input label="Name" id="ttp-name" name="name" placeholder="Name" value="{{old('name')}}" icon='<i class="fa-solid fa-user"></i>' type="text" required="TRUE"/>
                <x-custom-input label="Email" id="ttp-email" name="email" placeholder="email" value="{{old('email')}}" icon='<i class="fa-solid fa-envelope"></i>' type="email" required="TRUE"/>
                <x-custom-input label="Password" id="ttp-password" name="password" value="{{old('password')}}" icon='<i class="fa-solid fa-lock"></i>' type="password" required="TRUE"/>
                <button class="btn btn-dark w-100 sign-up-btn" type="submit">Sign Up</button>
                @session('error')
                    <div class="text-danger mt-2">
                        {!!session('error')!!}
                    </div>
                @endsession
            </form>
        </div>
    </div>
@endsection
