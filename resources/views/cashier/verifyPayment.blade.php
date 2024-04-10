@extends('cashier.layouts.app2')
@section('content')
    <div class="row-sec">
        <div class="col-sec">
            <div class="history-table">
                <p class="dashboard-tile">Cashier Dashboard</p>


                <!-- Cards -->

                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <a href="#" data-chain="bsc" class="card">
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
                                                    class="bnb-svg  " /></span>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-4 col-xl-3">
                            <a href="#" data-chain="tron" class="card">
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
                            <a href="#" data-chain="solana" class="card">
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

                <div class="Qr-container">
                    <form id="qrForm">
                        @csrf
                        <input type="hidden" name="id" value="{{ $payment->id }}">
                        <input type="hidden" name="" value="">
                        <div class="form-group">
                            <label for="toField">To:</label>
                            <input type="text" name="wallet_address" id="toField"
                                value="{{ $payment->Wallets->wallet }}" class="totext-Field" required />
                        </div>
                        <div class="form-group">
                            <label for="amountField">Amount:</label>
                            <input type="text" name="amount" id="amountField" value="{{ $payment->amount }}"
                                class="Amounttext-Field" required />
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


                        <button class="generate-btn" type="button" onclick="generateQRCode()">
                            Generate QR
                        </button>

                        <button class="verify-btn" style="display: none" type="button" onclick="verifyPayment()">
                            Verify Payment
                        </button>



                    </form>

                    <div class="qr-code-container">
                        <img id="qrcode" class="qrcode-generated" />
                    </div>


                    <div class="detail-show">
                        <div class="Amount-show">
                            <img src="{{ asset('assets') }}/images/dollar-sign.svg" class="dollar-sign-1">
                            <img src="{{ asset('assets') }}/images//doted-slash.svg" class="doted-slash-1">
                            <p class="Rough-Amount">Amount</p>
                            <p class="amount-digits" id="digits"> {{ $payment->amount }}</p>
                        </div>
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

                        <button id="printButton"class="print" type="button">Print QR <img
                                src="{{ asset('assets') }}/images/printer-picture.svg"
                                class="printer-img-casheir-print"></button>


                        <button class="print-invoice" type="button" style="display: none;">Print invoice <img
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

        function generateQRCode() {
            if (!flag)
                return;
            var toValue = document.getElementById("toField").value;
            var amountValue = document.getElementById("amountField").value;
            var chain = {{ $payment->chain }}
            var uuid = {{ $payment->unique_id }}
            if (toValue && amountValue) {
                flag = false;
                $('.verify-btn').css('display', 'inline');
                $('.generate-btn').css('display', 'none');
                $('#waiting-area').css('display', 'none');
                $('.qr-container').css('display', 'block');
                var qrString = {
                    "Chain": chain,
                    "To": toValue,
                    "Amount": amountValue,
                    "UUID": uuid
                };
                _uuid = uuid;
                var apiUrl = "https://api.qrserver.com/v1/create-qr-code/?bgcolor=13161d&color=fff&data=" + JSON.stringify(
                        qrString) +
                    "&size=180x180";
                qrQuery = JSON.stringify(qrString);
                document.getElementById("qrcode").src = apiUrl;
                document.getElementById("qrcode").style.display = "block";

            }
        }

        function openInvoice() {
            //url invoice_id
            console.log(_uuid);
            var invoiceId = $('#invoicebtn').data('invoice_id');
            var url = '<?php echo url('cashier/show-invoice'); ?>?invoice_id=' + invoice_id;

            window.open(url, '_blank');
        }

        function openPrintQRForm() {
            var url = "<?php echo route('cashier.print-qr'); ?>";
            window.open(url + '?query=' + qrQuery, '_blank');
        }

        function verifyPayment() {
            // Your payment verification logic here...
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('cashier.verify-payment') }}",
                method: "POST",
                data: {
                    uuid: _uuid,
                },
                success: function(response) {
                    flag = false;
                    if (response.status) {
                        if (response.status == 'completed') {
                            invoice_id = response.invoice.invoice_id;
                            $('.verify-btn').css('display', 'inline');
                            $('.generate-btn').css('display', 'none');
                            $('#waiting-area').css('display', 'none');
                            $('.qr-container').css('display', 'block');
                            $('#success-payment').css('display', 'block');
                            $('#danger-payment').css('display', 'none');
                            $('#pending-payment').css('display', 'none');
                            document.querySelector(".print-invoice").style.display = "block";
                            document.querySelector("#printButton").style.display = "none";
                        } else {
                            if (response.status == 'pending') {
                                console.log(response.status);
                                $('#success-payment').css('display', 'none');
                                $('#danger-payment').css('display', 'none');
                                $('#pending-payment').css('display', 'block');
                            } else {
                                $('#success-payment').css('display', 'none');
                                $('#danger-payment').css('display', 'block');
                                $('#pending-payment').css('display', 'none');
                            }
                        }
                    }
                },
                error: function(error) {
                    console.error("Error saving payment information.");
                }
            });

            isPaymentVerified = true;
            // Show the "Print invoice" button
            // Adjust the position of the button after verifying payment
            document.querySelector(".detail-show").classList.add("verified");
        }


        // Attach event listeners
        document.querySelector('.print').addEventListener('click', openPrintQRForm);
        document.querySelector('.print-invoice').addEventListener('click', verifyPayment);
    </script>
@endpush
