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
        <p class="welcome-back">Forget Password</p>
    </div>

    <!-- -------------------  -->


    <!-- singin form  -->

    <div class="form">
        <form action="{{ url('/send-reset-link') }}" method="POST">
            @csrf
            <div class="inputcontainer">
                <input type="email" class="email-input" name="email" placeholder="Enter your email" />
                @error('email')
                    <span style="color: red;"> {{ $message }}</span>
                @enderror
                <button type="submit" class="btn btn--primary" style="margin-left: 0px; width: 30%;">Submit</button>

            </div>
        </form>
        <div class="BannerImage">
            <div class="banner">
                <img src="{{ asset('assets') }}/images/group-585.svg" alt="" class="Sidebanner">
            </div>
        </div>
    </div>
@endsection

