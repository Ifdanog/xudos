@extends('admin.layouts.master')


@section('content')
    <section class="section-two container">
        <div class="row-sec">
            <div class="col-sec">
                <div class="storesForm" id="storesForm" style="display: block">
                    <div class="content">
                        <!-- <span class="closeBtn" id="closeBtn">&times;</span> -->
                        <p>Edit Cashier</p>
                        <div class="stores-form-grid">
                            <form action={{ url('/edit-cashier') }} method="POST">
                                @csrf
                                <div class="form--div">
                                    <div class="form--details form--details--left">
                                        <div class="inner-form-details">
                                            <label for="store-name">Cashier Name *</label>
                                            <input type="text" name="name" id="store-name" value="{{ $cashier->user->name }}"
                                                placeholder="Enter name" required />
                                        </div>

                                        <div class="inner-form-details">
                                            <label for="store-email">Cashier Email *</label>
                                            <input type="email" id="store-email" name="email" value={{ $cashier->user->email }}
                                                required />
                                        </div>
                                        <div class="inner-form-details">
                                            <label for="store-email">Cashier Password *</label>
                                            <input type="password" id="store-email" name="password"
                                                placeholder="Type New Password" />
                                        </div>
                                        <div class="inner-form-details">
                                            <!-- <img src="./images/down-arrow.png" alt=""> -->
                                            <label for="select-store">Select Store *</label>
                                            <select name="store_id" id="select-store" required>
                                                @foreach ($stores_data as $store)
                                                    <option value="{{ $store->id }}"
                                                        {{ $store->id == $cashier->store->id ? 'selected' : '' }}>
                                                        {{ ucfirst(trans($store->name)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <input type="hidden" name="id" value={{ $cashier->id }}>
                                        <div id="form-btns">
                                            <input type="reset" id="cashierCloseBtn" class="closeBtn" value="Cancel" onclick="window.history.back()">
                                            <input type="submit" value="Submit">
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
