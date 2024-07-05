@extends('layouts.main')
@push('title')
    <title>Teacher-Portal</title>
@endpush
@section('main-section')
    <div class="container ">
        <h1 class="text-center text-danger mt-2">Teacher-Portal</h1>
        <div class="d-flex justify-content-center align-items-center mt-4 p-5">
            <h4 class="text-dark">
                Upon logging into the Teacher Portal, you will be redirected to the Student Management Dashboard. This central hub provides a comprehensive view of all students, displaying their names, subjects, and marks. From this dashboard, you can easily manage student information by editing their details or removing student records as needed. The intuitive interface ensures that you can efficiently navigate through the student list, update relevant data, and maintain an organized overview of your class’s progress.
            </h4>
        </div>
    </div>
@endsection