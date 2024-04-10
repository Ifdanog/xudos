@extends('layout.account')
@section('content')

<style>
    .main-logo{
        margin-left: 82px;
    }
</style>
    <div class="main-logo">
        <div class="logo-img">
            <img src="{{ asset('assets') }}/images/ppkt-final-logo.png" alt="logo" style="position: relative; top: -35px; left: -40px">
        </div>
        <div class="logo-Name">MTC Business</div>
    </div>

    <!-- --------------------------------------------- -->

    <!-- welcome  -->

    <div class="welcomeText">
        <p class="welcome-back">Reset Password</p>
    </div>

    <!-- -------------------  -->


    <!-- singin form  -->

    <div class="form">
        <form action="{{ url('/reset-password') }}" method="POST">
            @csrf
            <div class="inputcontainer">
                <input type="password"  class="password-input" name="password" placeholder="Enter your Password" />
                @error('email')
                    <span style="color: red;"> {{ $message }}</span>
                @enderror
                <input type="password" class="password-input" name="confirm_password" placeholder="Confirm your password" />
                @error('password')
                    <span style="color: red;"> {{ $message }}</span>
                @enderror
                <input type="hidden" name="otp" value="{{ request('verification_code') }}">
                <div class="sinin-Button">
                    <button type="submit" class="btn btn--primary btn-block" style="margin-left: 0px">Reset Password</button>
                </div>
            </div>
        </form>
        <div class="BannerImage">
            <div class="banner">
                <img src="{{ asset('assets') }}/images/group-585.svg" alt="" class="Sidebanner">
            </div>
        </div>
    </div>
@endsection

