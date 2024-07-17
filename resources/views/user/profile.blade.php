@extends('layouts.main')
@push('title')
    <title>Teacher-Portal | Profile</title>
@endpush
@section('main-section')
    <div class="container">
        <h1 class="text-center display-3 text-danger">Teacher's Id: <span id="ttp-user-id-span" class="text-secondary">{{Auth::user()->id}}</span></h1>
        <form>
            <x-custom-input label="User Name" id="ttp-name" name="name" placeholder="Name" value="{{Auth::user()->name}}" icon='<i class="fa-solid fa-signature"></i>' type="text" required="TRUE" />

            <x-custom-input label="Email" id="ttp-email" name="email" placeholder="Email" value="{{Auth::user()->email}}" icon='<i class="fa-solid fa-at"></i>' type="email" required="TRUE" disabled="TRUE"/>

            <x-custom-input label="Current Password" id="ttp-current-password" name="current_password" value="{{old('current_password')}}" icon='<i class="fa-solid fa-key"></i>' placeholder="Current Password" type="password" required="TRUE" />

            <x-custom-input label="New Password" id="ttp-new-password" name="new_password" placeholder="New Password" value="{{old('new_password')}}" icon='<i class="fa-solid fa-lock"></i>' type="password" labelInfo="(Leave 'New Password' empty to update only the User Name)"/>
                
            <button type="button" onclick="updateUser()" class="btn btn-outline-secondary rounded-0 me-2">Update</button>
            <a href="{{url('/log-out')}}" class="btn btn-danger rounded-0 ms-2">Log Out</a>
        </form>
    </div>
    @include('modals.pop-up-modal')
@endsection
