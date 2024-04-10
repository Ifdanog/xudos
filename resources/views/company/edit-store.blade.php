@extends('admin.layouts.master')


@section('content')
    <section class="section-two container">
        <div class="row-sec">
            <div class="col-sec">
                <div class="storesForm" id="storesForm" style="display: block">
                    <div class="content">
                        <!-- <span class="closeBtn" id="closeBtn">&times;</span> -->
                        <p>Edit Store</p>
                        <div class="stores-form-grid">
                            <form action={{ url('/edit-store') }} method="POST">
                                @csrf
                                <div class="form--div">
                                    <div class="form--details form--details--left">
                                        <div class="inner-form-details">
                                            <label for="store-name">Store Name *</label>
                                            <input type="text" name="name" id="store-name" value="{{$store->name}}" placeholder="Enter name"
                                                required />
                                        </div>

                                        <div class="inner-form-details">
                                            <label for="store-email">Store Email *</label>
                                            <input type="email" id="store-email" name="email"
                                                value={{$store->email}} required />
                                        </div>
                                        <div class="inner-form-details">
                                            <label for="store-email">Store Password *</label>
                                            <input type="password" id="store-email" name="password" placeholder="Type New Password"
                                                 />
                                        </div>


                                        <div class="inner-form-details">
                                            <img src="./images/phone.svg" alt="">
                                            <label for="store-contact">Store Type *</label>
                                            <select name="store_type" id="select-store" required>
                                                <option value="e-commerce" {{$store->store_type == "e-commerce" ? 'selected' : ''}}>E-commerce</option>
                                                <option value="e-commerce-1" {{$store->store_type == "e-commerce-1" ? 'selected' : ''}}>E-commerce-1</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="id" value={{$store->id}}>
                                        <div id="form-btns">
                                            <input type="reset" id="cashierCloseBtn" class="closeBtn" value="Cancel" onclick="window.history.back()">
                                            <input type="submit" value="Submit">
                                        </div>
                                    </div>
                                    <div class="form--details form--details--right">
                                        <div class="inner-form-details">
                                            <img src="./images/phone.svg" alt="">
                                            <label for="store-contact">Store Contact *</label>
                                            <input type="number" name="mobile" value={{$store->mobile}} id="store-contact"
                                                placeholder="+92-854785784" required></input>
                                        </div>
                                        <div class="inner-form-details">
                                            <label for="store-name">Profit %</label>
                                            <input type="text" name="profit_percentage" value={{$store->profit_percentage}} placeholder="0%"
                                                required></input>
                                        </div>
                                        <div class="inner-form-details">
                                            <label for="store-name">Valid Till</label>
                                            <input type="date" name="valid_till" value={{$store->valid_till}} placeholder="00-00-0000"
                                                required></input>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
