@extends('cashier.layouts.app2')
@section('content')
      <div class="row-sec">
        <div class="col-sec">

          <div class="history-table">
            <p class="dashboard-tile">Update Payement</p>
            <p class="chain-title">Selected chain</p>
             <a href="{{route('cashier.cashier-dashboard')}}" style="
             position: relative;
            bottom: 51px;
            background-color: #E5E5E5;
            padding: 5px;
            padding-right: 40px;
            padding-left: 38px;
            text-decoration: none;
            color: black;
            border:1px solid #E5E5E5;
            border-bottom: 12px;
">Back</a>
            <!-- Cards -->

            <div class="container">
              <div class="row">
                <div class="col-md-4 col-xl-3">
                    <a href="{{ url('/get-wallet-address/bsc') }}" data-chain="bsc" disabled style="{{ $payment->chain != 'bsc' ? 'filter: grayscale(1); cursor: auto' : 'cursor: auto' }}"  class="chain_card">
                        <div class="card bg-c-green order-card">
                      <div class="card-block">
                        <h2 class="card-text1">BUSD</h2>
                        <h6 class="m-b-20">(BNB)</h6>
                        <h2 class="text-right">
                          <img src="{{ asset('assets') }}/images/bnb-picture.png" class="Img-bnb" /><span class="Digits"></span>
                        </h2>
                        <p class="m-b-0">
                         <span class="f-right"><img src="{{ asset('assets') }}/images/bnb-picture.png" class="bnb-svg" /></span>
                        </p>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="col-md-4 col-xl-3">
                    <a href="{{ url('/get-wallet-address/tron') }}" data-chain="tether" style="{{ $payment->chain != 'tether' ? 'filter: grayscale(1); cursor: auto' : 'cursor: auto' }}" disabled class="chain_card">
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
                    <a href="{{ url('/get-wallet-address/solana') }}" data-chain="solana" style="{{ $payment->chain != 'solana' ? 'filter: grayscale(1); cursor: auto' : 'cursor: auto' }}" disabled class="chain_card">
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
                        @csrf
                        <input type="hidden" name="id" value="{{ $payment->id }}">
                        <input type="hidden" name="uuid" value="{{ $payment->unique_id }}">
                        <div class="form-group">
                            <label for="toField">To:</label>
                            <input type="text" disabled value="{{ $payment->Wallets->wallet }}" class="totext-Field" required />
                        </div>
                        <div class="form-group">
                            <label for="amountField">Amount:</label>
                            <input type="text" disabled id="amountField" value="{{ $payment->amount }}"
                                class="Amounttext-Field" required />
                        </div>

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
                    <button class="verify-btn" style="display: inline" type="button" onclick="verifyPayment('{{ $payment->unique_id }}')">
                        Verify Payment
                    </button>



                </form>

                <div class="qr-container" id="qr-container">
                    <div class="qr-code-container">

                        <div style="width: 100%; align-items: center; display: flex; justify-content: center; margin-top: 20px">
                            <img id="success-payment" src="{{ asset('assets/images/check.jpg') }}" style="display: none; border: 3px solid white; border-radius: 78px; position: absolute; height: 50px;" />
                            <img id="danger-payment" src="{{ asset('assets/images/danger.png') }}" style="display: none; border: 3px solid white; border-radius: 78px; position: absolute; height: 50px;" />
                            <img id="pending-payment" src="{{ asset('assets/images/warning.png') }}" style="display: none; border: 3px solid white; border-radius: 78px; position: absolute; height: 50px;" />
                            <img id="qrcode" src="https://api.qrserver.com/v1/create-qr-code/?bgcolor=13161d&color=fff&data={{ $query }}&size=180x180" class="qrcode-generated" />
                        </div>
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-direction: column;">
                            <div class="payement-date">
                                <img src="{{ asset('assets') }}/images/payement-date.svg" class="Payement-sign">
                                <img src="{{ asset('assets') }}/images//doted-slash.svg" class="doted-slash-1">
                                @php
                                    use Carbon\Carbon;
                                    $currentDate = Carbon::now();
                                @endphp
                                <p class="Payement-detail">Payment Date</p>
                                <p class="random-date">{{ $payment->created_at->format('d M, Y') }}</p>
                            </div>

                            <div class="Amount-show">
                                <img src="{{ asset('assets') }}/images/dollar-sign.svg" class="dollar-sign-1">
                                <img src="{{ asset('assets') }}/images//doted-slash.svg" class="doted-slash-1">
                                <p class="Rough-Amount">Amount</p>
                                <p class="amount-digits" id="digits">{{ $payment->amount }}</p>
                            </div>

                        </div>
                    </div>
                    <div class="detail-show">
                            <input id="invoice_id" type="hidden" />
                            <button id="printButton"class="print"  type="button">Print QR <img
                                src="{{ asset('assets') }}/images/printer-picture.svg"
                                class="printer-img-casheir-print"></button>


                        <button class="print-invoice" id="invoicebtn" type="button">Print invoice<img
                                src="{{ asset('assets') }}/images/printer-picture.svg"
                                class="printer-img-casheir-invoice"></button>
                    </div>
                </div>
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

