@extends('admin.layouts.master')


@section('content')
    <section class="section-two">
        <style>

            #content {
                margin: 0 auto;
                width: 90%
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
        <div id="content">
            <div class="modal-heading">
                <p style="font-size: 18px">Company Details</p>
            </div>

            <div>
                <div class="table-left">
                    <div class="history-table">
                        <div class="table-head">
                            <p>Info</p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Company ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Activation</th>
                                    <th>Profit %</th>
                                    <th>Valid Till</th>
                                    <th>Contact No</th>
                                    <th>IBAN</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{ $company->id }}</td>
                                    <td>{{ $company->user->name }}</td>
                                    <td style="text-align: left">{{ $company->user->email }}</td>
                                    <td>{{ $company->company_type }}</td>
                                    <td>{{ $company->is_active == 0 ? 'No' : 'Yes' }}</td>
                                    <td>{{ $company->profit_percentage }}</td>
                                    <td>{{ $company->valid_till }}</td>
                                    <td>{{ $company->user->mobile }}</td>
                                    <td>{{ $company->iban }}</td>
                                </tr>


                            </tbody>
                        </table>
                        <div class="buttons-container">
                            <a href="{{ url('/clients/' . $company->id) }}" class="btn btn-primary left-button">View All
                                Clients Data</a>
                            <div class="right-buttons">
                                <a onclick="confirmCancellation('{{ url('disable-company/' . $company->id) }}')" class="btn btn-danger">De-activate
                                    Company</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <style>
            .buttons-container {
                display: flex;
                justify-content: space-between;
                margin-top: 20px;
            }

            .left-button {
                margin-right: auto;
            }

            .right-buttons {
                display: flex;
                gap: 10px;
            }
        </style>
    </section>
    <script>
        function confirmCancellation(url) {
            if (confirm('Are you sure you want to De-activate the company?')) {
                window.location.href = url;
            }
        }
    </script>
@endsection
