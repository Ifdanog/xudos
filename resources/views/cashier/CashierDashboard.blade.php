@extends('cashier.layouts.app2')
@section('content')
    <div class="row-sec">
        <div class="col-sec">
            <div class="history-table">
                <p class="dashboard-tile">Cashier Dashboard</p>
                <p class="chain-title">Select one chain</p>

                <button class="New-payement" type="button" onclick="refreshPage()">New payment</button>
                <!-- Cards -->

                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <a href="{{ url('/get-wallet-address/bsc') }}" data-chain="bsc" class="chain_card">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h2 class="card-text1">BUSD</h2>
                                        <h6 class="m-b-20">(BNB)</h6>
                                        <h2 class="text-right">
                                            <img src="{{ asset('assets') }}/images/bnb-picture.png" class="Img-bnb" /><span
                                                class="Digits"></span>
                                        </h2>
                                        <p class="m-b-0">
                                            <span class="f-right"><img src="{{ asset('assets') }}/images/bnb-picture.png"
                                                    class="bnb-svg" /></span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <a href="{{ url('/get-wallet-address/tron') }}" data-chain="tether" class="chain_card">
                                <div class="card-2">
                                    <div class="card-block">
                                        <h2 class="card-text2">USDT</h2>
                                        <h6 class="ethrium-text">(Tether)</h6>
                                        <h2 class="text-right">
                                            <img src="{{ asset('assets') }}/images/Ethereum-picture.png"
                                                class="Img-Etherium" /><span class="Digits-3"></span>
                                        </h2>
                                        <p class="m-b-0">
                                            <span class="f-right"><img
                                                    src="{{ asset('assets') }}/images/Ethereum-picture.png"
                                                    class="ethrium-svg" /></span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <a href="{{ url('/get-wallet-address/solana') }}" data-chain="solana" class="chain_card">
                                <div class="card-4">
                                    <div class="card-block">
                                        <h2 class="card-text3">USDT</h2>
                                        <h6 class="m-b-21">(Solana)</h6>
                                        <h2 class="text-right">
                                            <img src="{{ asset('assets') }}/images/Assets-picture.png"
                                                class="Img-Assets" /><span class="Digits-4"></span>
                                        </h2>
                                        <p class="m-b-0">
                                            <span class="f-right"><img src="{{ asset('assets') }}/images/Assets-picture.png"
                                                    class="assests-svg" /></span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- ------------------------------------------------- -->

                <!-- Qr code form  -->

                <div class="parent-container">
                    <form id="qrForm" class="payment-form">
                        <div>
                            <div class="form-group">
                                <label for="toField">To:</label>
                                <input type="text" id="toField" name="wallet_address" class="totext-Field" required />
                            </div>

                            <div class="form-group">
                                <label for="amountField">Amount:</label>
                                <input type="text" name="amount" id="amountField" class="Amounttext-Field" required />
                            </div>
                            <input type="hidden" name="uuid" id="uuidField">


                            <h6 class="con-heading">Conversion</h6>

                            <div class="coins-detail">
                                <div class="Bnb_ist">
                                    <img src="{{ asset('assets') }}/images/bnb-conversion.png" class="bnb-img" />
                                    <p class="bnb-digits" id="bnbConversion"></p>
                                    <img src="{{ asset('assets') }}/images/straight-line.svg" class="line" />
                                    <img src="{{ asset('assets') }}/images/ethrium-conversion.png" class="ethrium-img" />
                                    <p class="ethrium-digits" id="tetherConversion"> </p>
                                    <img src="{{ asset('assets') }}/images/straight-line.svg" class="line" />
                                    <img src="{{ asset('assets') }}/images/assests-conversion.png" class="images-img" />
                                    <p class="images-digits" id="solanaUsdtConversion"> </p>
                                </div>
                            </div>
                        </div>
                        <button class="generate-btn" type="button" onclick="generateQRCode()">
                            Generate QR
                        </button>

                        <button class="verify-btn" style="display: none" type="button" onclick="verifyPayment()">
                            Verify Payment
                        </button>



                    </form>
                    <div id="waiting-area" class="waiting-area">
                        <h3>
                            QR CODE / DETAILS HERE
                        </h3>
                    </div>
                    <div class="qr-container" id="qr-container" style="display: none">
                        <div class="qr-code-container">

                            <div
                                style="width: 100%; align-items: center; display: flex; justify-content: center; margin-top: 20px">
                                <img id="success-payment" src="{{ asset('assets/images/check.jpg') }}"
                                    style="display: none; border: 3px solid white; border-radius: 78px; position: absolute; height: 50px;" />
                                <img id="danger-payment" src="{{ asset('assets/images/danger.png') }}"
                                    style="display: none; border: 3px solid white; border-radius: 78px; position: absolute; height: 50px;" />
                                <img id="pending-payment" src="{{ asset('assets/images/warning.png') }}"
                                    style="display: none; border: 3px solid white; border-radius: 78px; position: absolute; height: 50px;" />
                                <img id="qrcode" class="qrcode-generated" />
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; flex-direction: column;">
                                <div class="payement-date">
                                    <img src="{{ asset('assets') }}/images/payement-date.svg" class="Payement-sign">
                                    <img src="{{ asset('assets') }}/images//doted-slash.svg" class="doted-slash-1">
                                    @php
                                        use Carbon\Carbon;
                                        $currentDate = Carbon::now();
                                    @endphp
                                    <p class="Payement-detail">Payment Date</p>
                                    <p class="random-date">{{ $currentDate->format('d M, Y') }}</p>
                                </div>

                                <div class="Amount-show">
                                    <img src="{{ asset('assets') }}/images/dollar-sign.svg" class="dollar-sign-1">
                                    <img src="{{ asset('assets') }}/images//doted-slash.svg" class="doted-slash-1">
                                    <p class="Rough-Amount">Amount</p>
                                    <p class="amount-digits" id="digits"></p>
                                </div>

                            </div>
                        </div>
                        <div class="detail-show">
                            <input id="invoice_id" type="hidden" />

                            <button id="printButton"class="print" type="button">Print QR <img
                                    src="{{ asset('assets') }}/images/printer-picture.svg"
                                    class="printer-img-casheir-print"></button>


                            <button class="print-invoice" id="invoicebtn" onClick="openInvoice()" type="button">Print
                                invoice<img src="{{ asset('assets') }}/images/printer-picture.svg"
                                    class="printer-img-casheir-invoice"></button>
                        </div>
                    </div>
                    <div class="table-head">
                    </div>
                    <table class="Cashier-table" id="example2">
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Customer Name</th>
                                <th>From</th>
                                <th>Amount</th>
                                <th>Chain</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->customer_id }}</td>
                                    <td>{{ $item->from_address }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>{{ $item->chain }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <a href="{{ route('cashier.edit-pendingPayment', $item->id) }}">
                                            <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    @endsection
    @push('scripts')
        <script>
            var printUrl = document.getElementById('printButton').getAttribute('data-print-url');

            // Handle the button click event
            document.getElementById('printButton').addEventListener('click', function() {
                window.open(printUrl, '_blank');
            });
        </script>
    @endpush
