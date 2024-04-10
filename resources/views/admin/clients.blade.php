@extends('admin.layouts.master')

@section('content')
    <section class="section-two">
        <div class="row-sec">
            <div class="col-sec" style="width: 100%">
                <div class="history-table">
                    <div class="table-head">
                        <p style="font-size: 16px">Clients Info</p>
                    </div>
                    <table id="companies-table">
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
                                <th>Security Benefit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr>
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
                                    <td>
                                        <p>{{ number_format($client->security_benefit, 2) }}</p> <a href="#" class="btn btn-info"
                                            data-toggle="modal" data-target="#cycleModal">View Cycle</a>
                                        <div class="modal fade" id="cycleModal" tabindex="-1" role="dialog"
                                            aria-labelledby="cycleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                                <div class="modal-content">

                                                    <div class="row">


                                                        <!-- First Column (25%) - Start and End Date -->
                                                        <div class="col-md-3 items-cent">
                                                            <div class="modal-body text-center">
                                                                <p style="color: black">Start Date:
                                                                    {{$client->contract_start_date}}
                                                                </p>
                                                                <p style="color: black">End Date:
                                                                   {{$client->contract_end_date}}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="modal-body custom-calendar text-center">
                                                                <div class="dates">
                                                                    <p style="color: white; font-size: 16px">Start Date:
                                                                        {{$client->contract_start_date}}
                                                                    </p>
                                                                    <p style="color: white; font-size: 16px">End Date:
                                                                        {{$client->contract_end_date}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 items-cent">
                                                            <div class="modal-body text-center">
                                                                <a type="button" class="btn btn-primary"
                                                                    style="margin-top: 5px" href="{{url('/extend-subscription/'. $client->id)}}">Extend for 365 days</a>
                                                                    <a onclick="confirmCancellation('{{url('/disable-client/'. $client->id)}}')" style="margin-top: 5px" class="btn btn-danger">Cancel Subscription</a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="payment-div">
                                                        <h4 style="color: black">Monthly Payment: {{number_format($client->monthly_payment, 2)}} EUR</h4>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td id="action" style="margin-top: 46px">
                                        <a href={{ url('/single-client/' . $client->id) }} style="text-decoration: none"><i
                                                class="fa-solid fa-eye" style="color: #ffffff;"></i></a>
                                                <a href={{ url('/edit-client/' . $client->id) }}><i class="fa-solid fa-pen-to-square"
                                                    style="color: #ffffff;"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>
    <style>
        .custom-calendar {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 15%;
            margin: 20px 0px;
            text-align: center;
            background-color: gray;
            border-radius: 10px
        }

        .dates {
            display: flex;
            justify-content: space-between;
            gap: 5px;
            width: 90%
        }

        .items-cent{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 15%;
            margin-top: 15px
        }
        .payment-div{
            display: flex;
            justify-content: center;
            align-items: center;
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

        .btn-primary {
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

        .btn-primary:hover {
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
    <script>
        function closeCashier() {
            document.getElementById("cashierForm").style.display = "none";
        }
    </script>
    <script>
        function confirmCancellation(url) {
            if (confirm('Are you sure you want to cancel the subscription?')) {
                window.location.href = url;
            }
        }
    </script>
@endsection
