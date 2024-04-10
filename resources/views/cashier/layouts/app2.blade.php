<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="{{ asset('assets') }}/cashier-css/cards.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/cashier-css/store dashboard.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/cashier-css/store.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/cashier-css/additional.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/cashier-css/Qr code.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/cashier-css/print qr code.css" />
    <link rel="stylesheet" href="{{ asset('assets') }}/cashier-css/dropdown.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <title>Store Dashboard</title>
</head>
<title>QR Code Generator</title>
<style>
    /* Add a class to adjust the position for the "Verify Payment" button */
    .detail-show.verified {
        bottom: -10%;
    }
</style>
<body>
    @include('cashier.layouts.partials.header')
    <section class="section-two container">
        @yield('content')
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        var qrQuery = JSON.stringify(<?php echo isset($query) ? $query : ''; ?>);
        var flag = true;
        var _uuid = '';
        var invoice_id = '';
        var address = <?php echo json_encode(isset($wallet_addresses) ? $wallet_addresses : []); ?>;
        $(document).ready(function() {
            $('.chain_card').on('click', function(event) {
                event.preventDefault();
                $(".chain_card").removeClass("selected");
                $(this).addClass("selected");
                var chain = $(this).data('chain');
                console.log(chain);
                address.forEach(wallet => {
                    if (wallet.chain == chain) {
                        $('#toField').val(wallet.wallet);
                    }
                });
            });
            var amountInput = $('#amountField');
            amountInput.on('input', function() {
                var amount = $(this).val();
                fetchRates(amount);
            });
        });

        if(1 == {{ isset($payment->amount) ? 1 : 0 }}) {
            fetchRates({{ isset($payment->amount) ? $payment->amount : '' }});
        }
        function fetchRates(amount) {
             // API URL to fetch conversion
             var apiUrl = 'https://api.coingecko.com/api/v3/simple/price';
            // Currency IDs for Binance Coin (bnb), Tether (usd), and Solana (solana)
            var bnbId = 'binancecoin';
            var usdtId = 'ethereum';
            var solanaId = 'solana';

            // Div elements to display converted values
            var bnbConversion = $('#bnbConversion');
            var tetherConversion = $('#tetherConversion');
            var solanaUsdtConversion = $('#solanaUsdtConversion');
            $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    data: {
                        ids: bnbId + ',' + usdtId + ',' + solanaId,
                        vs_currencies: 'usd',
                    },
                    success: function(response) {
                        // Perform the conversions and display the results
                        var bnbRate = response[bnbId].usd;
                        var usdtRate = response[usdtId].usd;
                        var solanaRate = response[solanaId].usd;

                        var bnbAmount = (amount / bnbRate).toFixed(2);
                        var tetherAmount = (amount / usdtRate).toFixed(2);
                        var solanaUsdtAmount = (amount / solanaRate).toFixed(2);

                        bnbConversion.text(bnbAmount + ' BNB');
                        tetherConversion.text(tetherAmount + ' ETH');
                        solanaUsdtConversion.text(solanaUsdtAmount + ' SOL');
                    },
                    error: function(error) {
                        console.error('Error fetching conversion rates.');
                    }
                });
        }
        function generateQRCode() {
            if (!flag)
                return;
            var toValue = document.getElementById("toField").value;
            var amountValue = document.getElementById("amountField").value;
            var selectedCard = document.querySelector(".chain_card.selected");
            if (toValue && amountValue && selectedCard) {
                var selectedChain = selectedCard.getAttribute("data-chain");
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('cashier.store-payment') }}",
                    method: "POST",

                    data: {
                        chain: selectedChain,
                        wallet_address: toValue,
                        amount: amountValue,
                    },
                    success: function(response) {
                        flag = false;
                        $('.verify-btn').css('display', 'inline');
                        $('.generate-btn').css('display', 'none');
                        $('#waiting-area').css('display', 'none');
                        $('.qr-container').css('display', 'block');
                        var qrString = {
                            "Chain": selectedChain,
                            "To": toValue,
                            "Amount": amountValue,
                            "UUID": response.payment.unique_id
                        };
                        _uuid = response.payment.unique_id;

                        document.querySelector(".amount-digits").textContent = amountValue;
                        var apiUrl = "https://api.qrserver.com/v1/create-qr-code/?bgcolor=13161d&color=fff&data=" + JSON.stringify(qrString) +
                            "&size=180x180";
                        qrQuery = JSON.stringify(qrString);
                        document.getElementById("qrcode").src = apiUrl;
                        document.getElementById("qrcode").style.display = "block";
                        console.log("Payment information stored successfully.");
                    },
                    error: function(error) {
                        console.error("payment does not made.");
                    }
                });
            }
        }
        function openInvoice() {
            var invoice_id = $('#invoice_id').val();
            var url = '<?php echo url('cashier/show-invoice'); ?>?invoice_id='+invoice_id;

            window.open(url, '_blank');
        }
        function openPrintQRForm() {
            var url = "<?php echo route('cashier.print-qr'); ?>";
            window.open(url + '?query=' + qrQuery, '_blank');
        }
        function verifyPayment(uuid = _uuid) {
            // Your payment verification logic here...
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('cashier.verify-payment') }}",
                    method: "POST",
                    data: {
                        uuid: uuid,
                    },
                    success: function(response) {
                        flag = false;
                        if(response.status) {
                            if(response.status == 'completed') {
                                $('#invoice_id').val(response.invoice.invoice_no);
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
                                if(response.status == 'pending') {
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
            // For example, you can set isPaymentVerified to true if the payment is verified
            isPaymentVerified = true;
           // Show the "Print invoice" button
            // Adjust the position of the button after verifying payment
            document.querySelector(".detail-show").classList.add("verified");
        }


        // Attach event listeners
        document.querySelector('.print').addEventListener('click', openPrintQRForm);
        document.querySelector('#invoicebtn').addEventListener('click', openInvoice);
        document.querySelector('.print-invoice').addEventListener('click', verifyPayment);
    </script>

    <script>
        function refreshPage() {
            // Clear the input fields
            document.getElementById("toField").value = "";
            document.getElementById("amountField").value = "";
            // Refresh the page
            window.location.reload();
        }
    </script>

    <script>
        // Wait for the DOM to load
        document.addEventListener('DOMContentLoaded', function() {
            // Get the dropdown menu element
            var dropdownMenu = document.getElementById('dropdownMenu');
            // Hide the dropdown menu by default
            dropdownMenu.style.display = 'none';
            // Toggle the dropdown menu when the profile image is clicked
            function toggleDropdownMenu() {
                dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
            }
            // Attach the toggleDropdownMenu function to the profile image click event
            var profileImage = document.querySelector('.menu-left-img img');
            profileImage.addEventListener('click', toggleDropdownMenu);
        });
    </script>
</body>

</html>
