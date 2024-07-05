@extends('layouts.main')
@push('title')
    <title>Teacher-Portal | Add-Student</title>
@endpush
@section('main-section')
    <div class="container">
        <h1 class="text-center text-danger mt-2">Teacher-Portal | Add Student</h1>
        <div class="d-flex justify-content-center align-items-center mt-4 p-5">
            <form>
                @csrf
                <x-custom-input label="Student Name" id="ttp-name" name="name" placeholder="Student Name" value="{{old('name')}}" icon='<i class="fa-solid fa-signature"></i>' type="text" required="TRUE" />
                <x-custom-input label="Subject" id="ttp-subject" name="subject" placeholder="Subject" value="{{old('subject')}}" icon='<i class="fa-solid fa-s"></i>' type="text" required="TRUE" />
                <x-custom-input label="Marks" id="ttp-marks" name="marks" value="{{old('marks')}}" icon='<i class="fa-solid fa-star-half-stroke"></i>' placeholder="100" type="number" required="TRUE" />
                <button class="btn btn-dark w-100 add-student-btn" onclick="addStudent()" type="button">Add</button>
                <button class="btn btn-dark custom-loader w-100 d-none" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Adding...</span>
                </button>
                <div id="custom-success-message" class="text-success"></div>
                <div id="custom-error-message" class="text-danger"></div>
            </form>
        </div>
    </div>
@endsection
