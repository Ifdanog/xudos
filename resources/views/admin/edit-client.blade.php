@extends('admin.layouts.master')

@section('content')
    <section class="section-one container">
        <div class="storesForm" id="storesForm">
            <div class="content">
                <!-- <span class="closeBtn" id="closeBtn">&times;</span> -->
                <p style="font-size: 16px">Edit Clients</p>
                <div class="stores-form-grid">
                    <form action={{ url('/edit-client') }} method="POST">
                        @csrf
                        <div class="form--div">
                            <div class="form--details form--details--left">
                                <div class="inner-form-details">
                                    <label for="store-name">Full Name</label>
                                    <input type="text" name="name" id="store-name" value="{{ $client->user->name }}"
                                        required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-name">Email</label>
                                    <img src="{{ asset('assets/images/alphanumeric@.svg') }}" width="20" alt="">
                                    <input type="email" name="email" value="{{ $client->user->email }}"
                                        required></input>
                                </div>

                                <div class="inner-form-details">
                                    <label for="store-email">Contact Number</label>

                                    <input type="number" id="store-email" name="phone_no"
                                        value="{{ $client->user->mobile }}" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-email">IBAN Number</label>

                                    <input type="text" id="store-email" name="iban" value="{{ $client->iban }}"
                                        required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-email">Street </label>
                                    <input type="text" id="store-email" value="{{ $client->street }}" name="street"
                                        required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-email">Zip Code</label>

                                    <input type="text" id="store-email" name="zip" value="{{ $client->zip }}"
                                        required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-email">City </label>
                                    <input type="text" name="city" value="{{ $client->city }}" required></input>
                                </div>
                                {{-- <div class="inner-form-details">
                                    <!-- <img src="./images/down-arrow.png" alt=""> -->
                                    <label for="select-store">Store Type</label>
                                    <select name="store_type" id="select-store" required>
                                        <option value="e-commerce">E-commerce</option>
                                        <option value="e-commerce-1">E-commerce-1</option>
                                    </select>
                                </div> --}}
                                <div id="form-btns">
                                    <input type="reset" id="cashierCloseBtn" class="closeBtn" value="Cancel">
                                    <input type="submit" value="Submit">
                                </div>
                            </div>
                            <div class="form--details form--details--right">
                                <div class="inner-form-details">
                                    <img src="{{ asset('assets/images/phone.svg') }}" alt="">
                                    <label for="store-contact">Country</label>
                                    <input type="text" name="country" id="store-contact" value="{{ $client->country }}"
                                        required></input>
                                </div>

                                <div class="inner-form-details">
                                    <label for="store-name">Start Date</label>
                                    <input type="date" name="contract_start_date" placeholder="00-00-0000"
                                        value="{{ $client->contract_start_date }}" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-name">Membership Payment (EURO)</label>
                                    <input type="text" name="membership_payment"
                                        value="{{ $client->membership_payment }}" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-name">Security Deposit (EURO)</label>
                                    <input type="text" name="security_benefit" value="{{$client->security_benefit}}"
                                        required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-name">Monthly Payment</label>
                                    <input type="text" name="monthly_payment" value="{{ $client->monthly_payment }}"
                                        required></input>
                                </div>
                                <div class="inner-form-details">
                                    <input type="hidden" name="client_id" value="{{ $client->id }}" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="activation">Activation</label>
                                    <div class="activation-options">
                                        <input type="radio" id="activation-yes" name="is_active" value="1"
                                            {{ $client->is_active ? 'checked' : '' }} required>
                                        <label for="activation-yes">Yes</label>

                                        <input type="radio" id="activation-no" name="is_active" value="0"
                                            {{ !$client->is_active ? 'checked' : '' }} required>
                                        <label for="activation-no">No</label>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
