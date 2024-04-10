@extends('admin.layouts.master')

@section('content')
    <section class="section-two container">
        <div class="row-sec">
            <div class="col-sec"  style="width: 100%">
                <div class="history-table">
                    <div class="table-head">
                        <p style="font-size: 16px">Companies Info</p>
                    </div>
                    <table id="companies-table">
                        <thead>
                            <tr>
                                <th>Company ID</th>
                                <th>Company Name</th>
                                <th>Type</th>
                                <th>Activation</th>
                                <th>Email</th>
                                <th>Profit %</th>
                                <th>Valid Till</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores_data as $store)
                                <tr>
                                    <td>{{ $store->id }}</td>
                                    <td>{{ $store->name }}</td>
                                    <td>{{ $store->email }}</td>
                                    <td>{{ $store->mobile }}</td>
                                    <td>{{ $store->created_at }}</td>
                                    <td>{{ $store->created_at }}</td>
                                    <td>{{ $store->created_at }}</td>

                                    <td id="action" style="margin-top: 15px">
                                        <a href={{url('/single-company/'. $store->id)}} style="text-decoration: none"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></a>
                                        <a href={{ url('/edit-store/' . $store->id) }}><i class="fa-solid fa-pen-to-square"
                                                style="color: #ffffff;"></i></a><a
                                            href={{ url('/delete-store/' . $store->id) }}
                                            onclick="return confirm('Are you sure you want to delete this store?');"><i
                                                class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- <div class="table-footer">
                        <a href="#" id="addStores">Add Stores</a>
                    </div> --}}
                </div>
                {{-- <div class="storesForm" id="storesForm">
                    <div class="content">
                        <!-- <span class="closeBtn" id="closeBtn">&times;</span> -->
                        <p>Add Store</p>
                        <div class="stores-form-grid">
                            <form action={{ url('/add-store') }} method="POST">
                                @csrf
                                <div class="form--div">
                                    <div class="form--details form--details--left">
                                        <div class="inner-form-details">
                                            <label for="store-name">Store Name *</label>
                                            <input type="text" name="name" id="store-name" placeholder="Enter name"
                                                required></input>
                                        </div>

                                        <div class="inner-form-details">
                                            <label for="store-email">Store Email *</label>
                                            <img src="{{ asset('assets/images/alphanumeric@.svg') }}" width="20"
                                                alt="">
                                            <input type="email" id="store-email" name="email"
                                                placeholder="Professional@email.com" required></input>
                                        </div>
                                        <div class="inner-form-details">
                                            <label for="store-email">Store Password *</label>
                                            <input type="password" id="store-email" name="password" placeholder="*****"
                                                required></input>
                                        </div>
                                        <div class="inner-form-details">
                                            <!-- <img src="./images/down-arrow.png" alt=""> -->
                                            <label for="select-store">Store Type</label>
                                            <select name="store_type" id="select-store" required>
                                                <option value="e-commerce">E-commerce</option>
                                                <option value="e-commerce-1">E-commerce-1</option>
                                            </select>
                                        </div>
                                        <div id="form-btns">
                                            <input type="reset" id="cashierCloseBtn" class="closeBtn" value="Cancel">
                                            <input type="submit" value="Submit">
                                        </div>
                                    </div>
                                    <div class="form--details form--details--right">
                                        <div class="inner-form-details">
                                            <img src="{{ asset('assets/images/phone.svg') }}" alt="">
                                            <label for="store-contact">Store Contact *</label>
                                            <input type="number" name="mobile" id="store-contact"
                                                placeholder="+92-854785784" required></input>
                                        </div>
                                        <div class="inner-form-details">
                                            <label for="store-name">Profit %</label>
                                            <input type="text" name="profit_percentage" placeholder="0%"
                                                required></input>
                                        </div>
                                        <div class="inner-form-details">
                                            <label for="store-name">Valid Till</label>
                                            <input type="date" name="valid_till" placeholder="00-00-0000"
                                                required></input>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    {{-- <section class="section-two container" id="section-two">
        <div class="row-sec">
            <div>
                <div class="history-table">
                    <div class="table-head">
                        <p>Cashiers Info</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Cashier ID</th>
                                <th>Cashier Name</th>
                                <th>Store Name</th>
                                <th>Store Id</th>
                                <th>Issue Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashier_data as $cashier)
                                <tr>
                                    <td>{{ $cashier->id }}</td>
                                    <td>{{ $cashier->user->name }}</td>
                                    <td>{{ $cashier->store->name }}</td>
                                    <td>{{ $cashier->store->id }}</td>
                                    <td>{{ $cashier->created_at }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="table-footer">
                        <a href="#" id="addCashier">Add Cashier</a>
                    </div>
                    <div class="cashierForm" id="cashierForm">
                        <div id="content">
                            <!-- <span class="closeBtn" id="closeBtn">&times;</span> -->
                            <p>Add Cashier</p>
                            <div class="stores-form-grid">
                                <form action={{ url('/add-cashier') }} method="POST">
                                    @csrf
                                    <div class="cashier--form--div" id="cashier--form--div">
                                        <div class="form--details form--details--left">
                                            <div class="inner-form-details">
                                                <label for="Cashier-name">Cashier Name *</label>
                                                <input type="text" name="name" id="Cashier-name"
                                                    placeholder="Enter name" required></input>
                                            </div>
                                            <div class="inner-form-details">
                                                <label for="Cashier-name">Cashier Email *</label>
                                                <input type="email" name="email" id="Cashier-email"
                                                    placeholder="Enter Email" required></input>
                                            </div>
                                            <div class="inner-form-details">
                                                <label for="Cashier-name">Cashier Password *</label>
                                                <input type="password" name="password" id="Cashier-password"
                                                    required></input>
                                            </div>

                                            <div class="inner-form-details">
                                                <!-- <img src="./images/down-arrow.png" alt=""> -->
                                                <label for="select-store">Select Store *</label>
                                                <select name="store_id" id="select-store" required>
                                                    @foreach ($stores_data as $store)
                                                        <option value="{{ $store->id }}">
                                                            {{ ucfirst(trans($store->name)) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div id="form-btns">
                                                <input type="reset" id="storeCloseBtn" class="closeBtn" value="Cancel"
                                                    onclick="closeCashier()">
                                                <input type="submit" value="Submit">
                                            </div>
                                        </div>
                                        <div class="form--details form--details--right">
                                            <div class="form--details--right--img">
                                                <img src="{{ asset('assets/images/6248754 1.png') }} " alt="">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <script>
        function closeCashier() {
            document.getElementById("cashierForm").style.display = "none";
        }
    </script>
@endsection
