
@extends('storeowner.layouts.form')
@section('content')
    <div class="" id="" style="position:absiolute">
        <div id="content">
            <p>Form</p>
            <div class="stores-form-grid">
                <form action="{{ route('storeowner.update-cashier') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $cashierId->id }}">
                    <div class="cashier--form--div" id="cashier--form--div">
                        <div class="form--details form--details--left">
                            <div class="inner-form-details">
                                <label for="Cashier-name">Cashier Name *</label>
                                <input type="text" value="{{ $cashierId->user->name }}" name="name">
                                @error('name')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="inner-form-details">
                                <label for="cashier-id">Email*</label>
                                <input type="email" value="{{ old('email', $cashierId->user->email) }}" name="email">
                                @error('email')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="inner-form-details">
                                <label for="password">Create Password *</label>
                                <input type="password" name="password" placeholder="********">
                                @error('password')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="inner-form-details">
                                <label for="confirm-password">Confirm Password *</label>
                                <input type="password" name="confirm_password" placeholder="********">
                                @error('confirm_password')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                            </div>
                            <div class="inner-form-details">
                                <label for="Cashier-contact">Cashier Contact *</label>
                                <input type="text" value="{{ $cashierId->user->contact }}" name="contact">
                        @error('contact')
                            <span class="text-danger"> {{ $message }}</span>
                        @enderror
                            </div>
                            <div id="form-btns">
                              <a href="{{route('storeowner.store-dashboard')}}"><input type="" id="" class="closeBtn" value="Cancel"></a>
                                <input type="submit" value="Submit">
                            </div>
                        </div>
                        <div class="form--details form--details--right">
                            <div class="form--details--right--img">
                                <img src="{{ asset('assets') }}/images/6248754 1.png" alt="">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
