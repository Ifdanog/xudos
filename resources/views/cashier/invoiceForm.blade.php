<!DOCTYPE html>
<html>
<head>
	<title>Invoice Template Design</title>
	<link rel="stylesheet" type="text/css" href="{{asset('assets')}}/cashier-css/forms.css">


</head>
<body>

<div class="wrapper">
	<div class="invoice_wrapper">
		<div class="header">
			<div class="logo_invoice_wrap">
				<div class="logo_sec">
					<img src="">
					<div class="title_wrap">
						<p class="title bold">Invoice</p>

					</div>
				</div>
				<div class="invoice_sec">

                    <p class="Logo-title-1">Dazpay</p>
                    <img src="{{asset('assets')}}/images/invoice-form-logo.svg" class="logo-picture">
				</div>
			</div>
			<div class="bill_total_wrap">

		</div>
		<div class="body">
			<div class="main_table">

				</div>
				<div class="table_body">
					<div class="row">

						<div class="Customer-name">
							<p class="bold">Customer name : </p>
							<p class="Name-john">{{ $payment->customer->name }}</p>
						</div>

						<div class="Left-side">
							<p class="bold">Phone Number : </p>
						     <p class="Number-1">{{ $payment->customer->contact }}</p>

						<div class="col col_des">
							<p class="bold">Email Address : </p>
							<p class="mail-1">{{ $payment->customer->email }}</p>
						</div>





                        <div class="walet-ist">
							<p class="bold">To (Wallet Address)   </p>
							<p class="wallet-random-adrees">{{ $payment->Wallets->wallet }}</p>
						</div>


                        <div class="walet-2nd">
							<p class="bold">From (Wallet Address)</p>
							<p class="wallet-adress-2">{{$payment->from_address}}</p>
						</div>
					</div>
                    <div class="right-side">
                    <div class="col col_des">
                        <p class="bold">Invoice No : </p>
                        <p class="invoice-number">{{$invoice->invoice_no}}</p>
                    </div>

                    <div class="col col_des">
                        <p class="bold">Issue Date : </p>
                        <p class="date-1">{{ $payment->created_at->format('d/m/Y') }}</p>
                    </div>

                    <div class="col col_des">
                        <p class="bold">Paid Date :  </p>
                        <p class="date-2">{{ $invoice->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>
				</div>
			</div>

            <div class="section-2">
              <p class="store-name">Store name</p>
              <p class="cashier-name">Cashier name</p>
              <p class="amount-transaction">Amount transaction</p>
              <p class="ch-ain">Chain</p>


            </div>
            <div class="sub-section-2">
                <p class="dazpay-text">{{ $payment->store->name}}</p>
                <p class="john-text">{{ Auth()->user()->name }}</p>
                <p class="amount-text">{{ $payment->amount }}$</p>
                <p class="bn-text">{{ strtoupper($payment->chain) }}</p>

            </div>
</div>

<script>
	function printInvoiceForm() {
	  // Hide the "Print" button before printing
	  const printButton = document.querySelector(".print-invoice-2");
	  printButton.style.display = "none";

	  // Trigger the browser's print functionality
	  window.print();

	  // Show the "Print" button again after printing
	  printButton.style.display = "block";
	}
	</script>


	<button class="print-invoice-2" type="button" onclick="printInvoiceForm()">Print<img src="{{asset('assets')}}/images/printer-picture.svg" class="printer-img"></button>


</body>
</html>
