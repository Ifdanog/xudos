@extends('admin.layouts.master')

@section('content')
    <section class="section-two">
        <style>
            #content {
                margin: 0;
            }

            .btn-info {
                display: inline-block;
                padding: 5px 16px;
                font-size: 16px;
                font-weight: bold;
                text-align: center;
                text-decoration: none;
                background-color: #5cd274;
                color: #fff;
                border-radius: 5px;
                transition: background-color 0.3s, color 0.3s;
                border: none
            }

            .btn-info:hover {
                background-color: #216932;
            }

            .btn-success {
                display: inline-block;
                padding: 8px 10px;
                font-size: 16px;
                text-align: center;
                text-decoration: none;
                background-color: #3498db;
                color: #fff;
                border: 2px solid #3498db;
                border-radius: 5px;
                transition: background-color 0.3s, color 0.3s;
                margin-top: 5px;
            }

            .btn-success:hover {
                background-color: #217dbb;
                border-color: #217dbb;
            }

            .btn-danger {
                display: inline-block;
                padding: 8px 10px;
                font-size: 16px;
                text-align: center;
                text-decoration: none;
                background-color: #d9534f;
                color: #fff;
                border: 2px solid #d9534f;
                border-radius: 5px;
                transition: background-color 0.3s, color 0.3s;
                margin-top: 5px;
            }

            .btn-danger:hover {
                background-color: #c9302c;
                border-color: #c9302c;
            }
        </style>
        <div id="content">
            <div class="modal-heading">
                <p style="font-size: 18px">Client Details</p>
            </div>
            <div class="transaction-grid">
                <div class="stats-view">
                    <div class="stats-flex">
                        <p>Monthly Payment</p>
                    </div>
                    <div class="stats-bottom">
                        <p id="bnb-balance">{{ number_format($client->monthly_payment, 2) }} EUR</p>
                    </div>
                </div>
                <div class="stats-view">
                    <div class="stats-flex">
                        <p>Security Deposit</p>
                    </div>
                    <div class="stats-bottom">
                        <p id="sol-balance">{{ number_format((float) $client->security_benefit, 2) }} EUR</p>
                    </div>
                </div>
                <div class="stats-view">
                    <div class="stats-flex" style="flex-direction: column;justify-content: center; gap: 14px">
                        <a class="btn btn-success" href="{{ url('/extend-subscription/' . $client->id) }}">Extend For
                            365 days</a>
                        <a onclick="confirmCancellation('{{url('/disable-client/'. $client->id)}}')" class="btn btn-danger">Cancel
                            Subscription</a>

                    </div>
                </div>
            </div>
            <div>
                <div class="table-left">
                    <div class="history-table">
                        <div class="table-head">
                            <p>Client</p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Contract No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>IBAN</th>
                                    <th>Street</th>
                                    <th>Zip</th>
                                    <th>City</th>
                                    <th>Country</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>

                                </tr>
                            </thead>
                            <tbody>

                                <td>{{ $client->contract_no }}</td>
                                <td>{{ $client->user->name }}</td>
                                <td>{{ $client->user->email }}</td>
                                <td>{{ $client->user->mobile }}</td>
                                <td>{{ $client->iban }}</td>
                                <td>{{ $client->street }}</td>
                                <td>{{ $client->zip }}</td>
                                <td>{{ $client->city }}</td>
                                <td>{{ $client->country }}</td>
                                <td>{{ $client->contract_start_date }}</td>
                                <td>{{ $client->contract_end_date }}</td>



                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <script>
            function confirmCancellation(url) {
                if (confirm('Are you sure you want to cancel the subscription?')) {
                    window.location.href = url;
                }
            }
        </script>
    </section>

@endsection
