<!DOCTYPE html>
<html>
<head>
	<title>Invoice - Dazpay</title>
	<link rel="stylesheet" type="text/css" href="{{asset('assets')}}/cashier-css/forms.css">
        <!-- Other head elements -->
</head>
<body>

<div class="wrapper">
	<div class="invoice_wrapper-2">
		<div class="header">
			<div class="logo_invoice_wrap">
				<div class="logo_sec">
					<img src="">
					<div class="title_wrap">
						<p class="title bold">QR</p>

					</div>
				</div>
				<div class="invoice_sec">

                    <p class="Logo-title-print-form">Dazpay</p>
                    <img src="{{asset('assets')}}/images/invoice-form-logo.svg" class="logo-picture-print-form">
				</div>
			</div>
			<div class="bill_total_wrap">

		</div>
		<div class="body">
			<div class="main_table">

				</div>
				<div class="table_body">
					<div class="row">

                        <div class="Qr-code-scan">
                            <p class="scan-picture">SCAN QR TO PAY</p>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $qr_query }}&size=150x150" class="qr-picture">
                        </div>
                        <div class="walet-print-form">
							<p class="print-form-wallet-2"> Wallet Address:</p>
							<p class="wallet-adress-2-print-form">{{ $json_query->To }}</p>
						</div>
                        <div class="date-print-form">
                            <p class="bold">Date:  </p>
                            <p class="date-2-print-form">{{ $payment->created_at }}</p>
                        </div>
                </div>
				</div>
			</div>

            <div class="section-2-print-form">
              <p class="store-name">Store name</p>
              <p class="cashier-name">Cashier name</p>
              <p class="amount-transaction">Amount transaction</p>
              <p class="ch-ain">Chain</p>
            </div>
            <div class="sub-section-2-print-form">
                <p class="dazpay-text">{{ $payment->store->name}}</p>
                <p class="john-text">{{ Auth()->user()->name }}</p>
                <p class="amount-text">{{ $payment->amount }}$</p>
                <p class="bn-text">{{ strtoupper($payment->chain) }}</p>
            </div>
            <button class="print-invoice-2-print-form" type="button" onclick="printInvoiceForm()">Print<img src="{{asset('assets')}}/images/printer-picture.svg" class="printer-img-print-form"></button>

</div>
<!-- Added the functionality to download as PDF -->
<script>
	function printInvoiceForm() {
	  // Hide the "Print" button before printing
	  const printButton = document.querySelector(".print-invoice-2-print-form");
	  printButton.style.display = "none";

	  // Trigger the browser's print functionality
	  window.print();
	  // Show the "Print" button again after printing
	  printButton.style.display = "block";
	}

</script>
    <!-- The "Print" button -->

</body>
</html>
