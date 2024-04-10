@extends('layout.account')
@section('content')

<style>
    .main-logo{
        margin-left: 82px;
    }
</style>
    <div class="main-logo">
        <div class="logo-img">
            {{-- <img src="{{ asset('assets') }}/images/ppkt-final-logo.png" alt="logo" style="position: relative; top: -35px; left: -40px"> --}}
        </div>
        <div class="logo-Name">XUDOS 2.0</div>
    </div>

    <!-- --------------------------------------------- -->

    <!-- welcome  -->

    <div class="welcomeText">
        <p class="welcome-back">Welcome Back!</p>
    </div>

    <!-- -------------------  -->


    <!-- singin form  -->

    <div class="form">
        <form action="{{ route('loginSubmit') }}" method="POST">
            @csrf
            <div class="inputcontainer">
                <input type="email" class="email-input" name="email" placeholder="Enter your email" />
                @error('email')
                    <span style="color: red;"> {{ $message }}</span>
                @enderror
                <input type="password" class="password-input" name="password" placeholder="Enter your password" />
                @error('password')
                    <span style="color: red;"> {{ $message }}</span>
                @enderror
                {{-- <div class="">
                    <div class="g-recaptcha" data-sitekey="6LdGDJYnAAAAAKH4yCaPMB-EPqnXx6IzvRj_zAjc"></div>
                </div> --}}
            </div>
            <div class="sinin-Button">
                {{-- <div class="btn-singin">
                    <button type="submit" class="buTon">Signin</button>
                </div> --}}
                <button type="submit" class="btn btn--primary btn-block">Sign in</button>
                <div class="forGet">
                    <a class="forget" href="{{url('/forgot-password')}}">Forgot password?</a>
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

{{-- <div class="row px-3">
    <div class="col-lg-12 col-md-12 col-xl-12 card flex-row mx-auto px-0 bg-dark">
        <div class="card-body ">
            <div class="logo-image mt-5 ml-4 mb-4 py-3 d-flex justify-content-center">
                <img src="{{ asset('assets') }}/images/dazlogo.png" alt="">
            </div>
            <h6 class="title text-center text-white mt-4">
                Wellcome Back!
            </h6>
            <form action="{{ route('loginSubmit') }}" class="form-box py-3 px-3" method="POST">
                @csrf
                <div class="form-input">
                    <span><i class="fa fa-envelope-o"></i></span>
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                <div class="form-input">
                    <span><i class="fa fa-key"></i></span>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="g-recaptcha" data-sitekey="6LdGDJYnAAAAAKH4yCaPMB-EPqnXx6IzvRj_zAjc"></div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-block text-uppercase">
                        Login
                    </button>
                </div>
                <div class="text-right">
                    <a href="#" class="forget-link">
                        Forget Password?
                    </a>
                </div>

            </form>
        </div>
        <div class="img-left d-none d-md-flex"></div>
    </div>
</div> --}}
