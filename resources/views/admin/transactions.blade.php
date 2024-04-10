@extends('admin.layouts.master')
{{--
@section('content')
    <section class="section-two container">
        <div class="row-sec">
            <div class="col-sec">
                <div class="history-table">
                    <div class="table-head">
                        <p>Transaction History</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Store ID</th>
                                <th>Store Name</th>
                                <th>Cashier ID</th>
                                <th>Cashier Name</th>
                                <th>Customer ID</th>
                                <th>Customer Name</th>
                                <th>Network</th>
                                <th>Amount($)</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->store_id_new }}</td>
                                    <td>{{ $transaction->name }}</td>
                                    <td>{{ $transaction->cashier_id }}</td>
                                    <td>{{ $transaction->cashier_name }}</td>
                                    <td>{{ $transaction->customer_id }}</td>
                                    <td>{{ $transaction->customer_name }}</td>
                                    <td>{{ $transaction->chain }}</td>
                                    <td>{{ number_format($transaction->amount, 2) }}</td>
                                    <td>{{ date('Y-m-d', strtotime($transaction->created_at)) }}</td>
                                    <td id="action"><a href={{url('/single-transaction/'.$transaction->payment_id)}}><i class="fa-solid fa-eye" style="color: #ffffff;"></i></a>
                                        <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$transactions->links()}}
                </div>
            </div>
        </div>

    </section>
@endsection --}}
@section('content')
    <section class="section-two">
        <div class="row-sec">
            <div class="col-sec" style="width: 80%">
                <div class="history-table">
                    <div class="table-head">
                        <p>Transactions</p>
                    </div>
                    <table id="company-transactions">
                        <thead>
                            <tr>
                                <th>Client Name</th>
                                <th>Company Name</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Address</th>
                                <th>Contract No</th>
                                <th>Security Deposit</th>
                                <th>Monthly Payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $transaction)
                                <tr>
                                    <td>{{ $transaction->user->name }}</td>
                                    <td>{{ $transaction->company->name }}</td>
                                    <td>{{ $transaction->company->user->email }}</td>
                                    <td>{{ date('Y-m-d', strtotime($transaction->created_at)) }}</td>
                                    <td>{{ $transaction->street . ', ' . $transaction->city . ', ' . $transaction->country }}
                                    </td>
                                    <td>{{ $transaction->contract_no }}</td>
                                    <td>{{ number_format((float) $transaction->security_benefit, 2) }} EUR</td>
                                    <td>{{ number_format($transaction->monthly_payment, 2) }} EUR</td>
                                    {{-- <td>{{ $transaction->chain }}</td>
                                    <td>{{ number_format($transaction->amount, 2) }}</td>
                                    <td>{{ date('Y-m-d', strtotime($transaction->created_at)) }}</td> --}}
                                    <td id="action"> <a href="{{ url('/generate-receipt/' . $transaction->id) }}">
                                        <i class="fa-solid fa-eye" style="color: #007BFF;"></i>
                                    </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{$transactions->links()}} --}}
                </div>
            </div>
        </div>
        {{-- <div class="transaction" id="transaction">
            <div id="content">
                <!-- <span class="closeBtn" id="closeBtn">&times;</span> -->
                <div class="modal-heading">
                    <p>Transaction View</p>
                </div>
                <div class="transaction-grid">
                    <div class="stats-view">
                        <div class="stats-flex">
                            <p>Income</p>
                            <p>+12.5%</p>
                        </div>
                        <div class="stats-bottom">
                            <p>5428,25765 USD</p>
                        </div>
                    </div>
                    <div class="stats-view">
                        <div class="stats-flex">
                            <p>Income</p>
                            <p>+12.5%</p>
                        </div>
                        <div class="stats-bottom">
                            <p>5428,25765 USD</p>
                        </div>
                    </div>
                    <div class="stats-view">
                        <div class="stats-flex">
                            <p>Income</p>
                            <p>+12.5%</p>
                        </div>
                        <div class="stats-bottom">
                            <p>5428,25765 USD</p>
                        </div>
                    </div>
                    <div class="stats-view">
                        <div class="stats-flex">
                            <p>Income</p>
                            <p>+12.5%</p>
                        </div>
                        <div class="stats-bottom">
                            <p>5428,25765 USD</p>
                        </div>
                    </div>
                </div>
                <div class="transaction-table-grid">
                    <div class="table-left">
                        <div class="history-table">
                            <div class="table-head">
                                <p>Outgoing Transaction</p>
                                <p>7 Days</p>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>crypto trade</th>
                                        <th>id number</th>
                                        <th>type</th>
                                        <th>Status</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>deposit</td>
                                        <td><img src="./images/waiting.png" alt="">Waiting</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>deposit</td>
                                        <td><img src="./images/waiting.png" alt="">Waiting</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>deposit</td>
                                        <td><img src="./images/waiting.png" alt="">Waiting</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>deposit</td>
                                        <td><img src="./images/waiting.png" alt="">Waiting</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>deposit</td>
                                        <td><img src="./images/waiting.png" alt="">Waiting</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>deposit</td>
                                        <td><img src="./images/waiting.png" alt="">Waiting</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="table-right">
                        <div class="history-table">
                            <div class="t-head">
                                <p>Account View</p>
                            </div>
                            <table>
                                <thead>
                                    <tr>
                                        <th>crypto trade</th>
                                        <th>Account</th>
                                        <th>IBAN</th>
                                        <th>Total/Available</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>GB78Py..42</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>GB78Py..42</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>GB78Py..42</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>GB78Py..42</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>GB78Py..42</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                    <tr>
                                        <td>Bitcoin</td>
                                        <td>857465686BT</td>
                                        <td>GB78Py..42</td>
                                        <td>+210 BTC</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </section>
    {{-- <script>
        function downloadReceipt(paymentId) {
            const downloadURL = `/generate-receipt/${paymentId}?download=true`;
            window.location.href = downloadURL;
        }
    </script> --}}
@endsection
