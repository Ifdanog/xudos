@extends('cashier.layouts.app')
@section('content')
    <div class="background-container">
        <section class="hero-sec">
            <div class="main-sec">

                <!-- uper portion  -->
                <div class="container-profile">
                    @if($userId->image == null)
                        <img id="proImg" src="{{asset('assets/images/face.jpeg')}}"  alt=""style="width:100px; height:150px; border:1px solid #ccc">
                        @else
                        <img id="proImg" src= "{{ $url }}" alt="" style="width:100px; height:100px; border:1px solid #ccc; margin-top: 15px;
                        position: fixed;">
                        @endif
                    <button id="profileImage" class="text" >Click to upload</button>
                    {{-- <p class="text-2">Maximun image size 3MB</p> --}}
                </div>

                <!-- --------------------------------------------------------------------- -->

                <!-- lower portion  -->

                <div class="container">
                    <div class="col-lg-8 col-lg-offset-2 col-md-8 col-md-offset-2 col-sm-12 col-xs-12 edit_information">
                        <form action="{{ route('cashier.update-profile') }}" method="POST" enctype="multipart/form-data" >
                            <!-- <h3 class="text-center">Edit Personal Information</h3> -->
                            @csrf
                            <input type="hidden" name="id" value="{{ $userId->id }}">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Full Name</label>
                                        <input type="text" name="name"  value="{{ old('name', $userId->name) }}" class="form-control" value="" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Email Address</label>
                                        <input type="email" name="email"  value="{{ old('email', $userId->email) }}" class="form-control" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Create Password</label>
                                        <input type="password" name="password" class="form-control" value=""
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control" value=""
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label class="profile_details_text">Mobile Number</label>
                                        <input type="text" name="contact"  value="{{ old('contact', $userId->contact) }}" class="form-control" value="" required>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <input id="profileIMG" type="file" name="image" style="opacity: 0;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 submit">
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success" value="confrim">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>

            </div>
        </section>
    </div>
@endsection
