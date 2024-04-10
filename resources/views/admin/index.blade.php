@extends('admin.layouts.master')
@section('content')
<section class="section-two container">
    <style>
        /* @media only screen and (min-width: 1430px) {
            .container {
                min-width: 1500px;
            }
        } */

        #content {
            margin: 0;
        }
    </style>
    <div id="content">
        <div class="modal-heading">
            <p style="font-size: 18px">Overview</p>
        </div>
        <div class="transaction-grid">
            <div class="stats-view">
                <div class="stats-flex">
                    <p>Total Companies</p>
                </div>
                <div class="stats-bottom">
                    <p id="bnb-balance"> {{ count($companies) }}</p>
                </div>
            </div>
            <div class="stats-view">
                <div class="stats-flex">
                    <p>Total Monthly Payments</p>
                </div>
                <div class="stats-bottom">
                    <p id="bnb-balance"> {{ number_format($total_monthly_payments, 2) }} EUR</p>
                </div>
            </div>
            <div class="stats-view">
                <div class="stats-flex">
                    <p>Total Clients</p>
                </div>
                <div class="stats-bottom">
                    <p id="sol-balance"> {{ number_format($total_clients) }}</p>
                </div>
            </div>
            <div class="stats-view">
                <div class="stats-flex">
                    <p>Total Security Benefits (Euro)</p>
                </div>
                <div class="stats-bottom">
                    <p id="sol-balance">{{ number_format($total_security_benefits, 2) }} EUR</p>
                </div>
            </div>
            {{-- <div class="stats-view">
                <div class="stats-flex" style="flex-direction: column;justify-content: center; gap: 14px">
                    <button class="btn btn-success">Extend For 365 days</button>
                    <button class="btn btn-danger">Cancel Subscription</button>

                </div>
            </div> --}}
        </div>
        <div>
            <div class="table-left">
                <div class="history-table">
                    <div class="table-head">
                        <p>Active Clients</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Contract No</th>
                                <th>Name</th>
                                <th>Email</th>
                                {{-- <th>Contact</th> --}}
                                <th>IBAN</th>
                                {{-- <th>Street</th>
                                <th>Zip</th>
                                <th>City</th>
                                <th>Country</th> --}}
                                <th>Start Date</th>
                                {{-- <th>End Date</th> --}}
                                <th>Security Deposit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                               @if($client->is_active)
                               <tr>
                                <td>{{ $client->contract_no }}</td>
                                <td>{{ $client->user->name }}</td>
                                <td>{{ $client->user->email }}</td>
                                {{-- <td>{{ $client->user->mobile }}</td> --}}
                                <td>{{ $client->iban }}</td>
                                {{-- <td>{{ $client->street }}</td>
                                <td>{{ $client->city }}</td>
                                <td>{{ $client->country }}</td> --}}
                                <td>{{ $client->contract_start_date }}</td>
                                <td style="text-align: center">{{ number_format((float)$client->security_benefit, 2)}} EUR</td>
                            </tr>
                               @endif
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</section>
        <style>
            .activation-options {
                display: flex;
                align-items: center;
            }

            .activation-options input[type="radio"] {
                display: none;
                /* Hide the default radio buttons */
            }

            .activation-options label {
                margin-right: 10px;
                /* Adjust spacing between the radio button and label */
                padding: 8px 16px;
                background-color: #3498db;
                color: #fff;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s;
            }

            .activation-options label:hover {
                background-color: #2980b9;
                /* Change background color on hover */
            }

            .activation-options input[type="radio"]:checked+label {
                background-color: #2ecc71;
                /* Change background color for the selected option */
            }
        </style>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var payments = JSON.parse(document.getElementById('graph_data').value);
        var graphData = [];
        var keys = Object.keys(payments);
        for (var i = 0; i < keys.length; i++) {
            graphData[i] = payments[keys[i]];
        }
        const ctx = document.getElementById("myChart");
        new Chart(ctx, {
            type: "line",
            data: {
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                datasets: [{
                    label: "Transactions",
                    data: graphData,
                    borderWidth: 2,
                }, ],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                },
            },
        });
    </script>
@endsection
