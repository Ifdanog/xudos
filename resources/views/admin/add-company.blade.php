@extends('admin.layouts.master')


@section('content')
    <section class="section-one container">
        <div class="storesForm" id="storesForm">
            <div class="content">
                <!-- <span class="closeBtn" id="closeBtn">&times;</span> -->
                <p style="font-size: 16px">Register / Create Company</p>
                <div class="stores-form-grid">
                    <form action={{ url('/add-company') }} method="POST">
                        @csrf
                        <div class="form--div">
                            <div class="form--details form--details--left">
                                <div class="inner-form-details">
                                    <label for="store-name">Company ID</label>
                                    <input type="number" name="id" id="store-name" placeholder="ID" required></input>
                                </div>

                                <div class="inner-form-details">
                                    <label for="store-email">Company Type</label>

                                    <input type="text" id="store-email" name="company_type" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-email">Password *</label>
                                    <input type="password" id="store-email" name="password" placeholder="*****"
                                        required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-email">Contact Number</label>

                                    <input type="number" id="store-email" name="phone_no" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-email">IBAN Number</label>

                                    <input type="text" id="store-email" name="iban" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-email">Company Employee * </label>

                                    <input type="text" id="store-email" name="employee" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-email">Valid Till * </label>
                                    <input type="date" name="valid_till" placeholder="00-00-0000" required></input>
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
                                    <label for="store-contact">Company Name</label>
                                    <input type="text" name="name" id="store-contact" placeholder="Name"
                                        required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-name">Company Email</label>
                                    <img src="{{ asset('assets/images/alphanumeric@.svg') }}" width="20" alt="">
                                    <input type="email" name="email" placeholder="abc@example.com" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-name">Company Payment Method</label>
                                    <input type="text" name="payment_method" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-name">Profit %</label>
                                    <input type="text" name="profit_percentage" placeholder="0%" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="store-name">Issue Date</label>
                                    <input type="date" name="issued_date" placeholder="00-00-0000" required></input>
                                </div>
                                <div class="inner-form-details">
                                    <label for="activation">Activation</label>
                                    <div class="activation-options">
                                        <input type="radio" id="activation-yes" name="is_active" value="1" required>
                                        <label for="activation-yes">Yes</label>

                                        <input type="radio" id="activation-no" name="is_active" value="0" required>
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
