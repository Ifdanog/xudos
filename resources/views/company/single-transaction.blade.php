@extends('admin.layouts.master')


@section('content')
<section class="section-two container">
    <style>
        @media only screen and (min-width: 1430px){
            .container{
                min-width: 1500px;
            }
        }
        #content{
            margin: 0;
        }
        /* @media only screen and (min-width: 1000px){
            .container{
                min-width: 1200px;
            }
        } */
        </style>
        <div id="content">
            <!-- <span class="closeBtn" id="closeBtn">&times;</span> -->
            <div class="modal-heading">
                <p>Single Transaction</p>
            </div>
            <div class="transaction-grid">
                <div class="stats-view">
                    <div class="stats-flex">
                        <p>Cashier</p>
                        <p>ID - {{$transaction->cashier->id}}</p>
                    </div>
                    <div class="stats-bottom">
                        <p>{{ucwords($transaction->cashier->name)}}</p>
                    </div>
                </div>
                <div class="stats-view">
                    <div class="stats-flex">
                        <p>Customer</p>
                        <p>ID - {{$transaction->customer->id}}</p>
                    </div>
                    <div class="stats-bottom">
                        <p>{{ucwords($transaction->customer->name)}}</p>
                    </div>
                </div>
                <div class="stats-view">
                    <div class="stats-flex">
                        <p>Amount</p>

                    </div>
                    <div class="stats-bottom">
                        <p>$ {{number_format($transaction->amount, 2)}}</p>
                    </div>
                </div>
                <div class="stats-view">
                    <div class="stats-flex">
                        <p>Chain</p>
                    </div>
                    <div class="stats-bottom">
                        <p>{{ucwords($transaction->chain)}}</p>
                    </div>
                </div>
            </div>
            <div >
                <div class="table-left">
                    <div class="history-table">
                        <div class="table-head">
                            <p>Details</p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Unique ID</th>
                                    <th>Store ID</th>
                                    <th>Store Name</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->unique_id}}</td>
                                    <td>{{$transaction->store->id ? $transaction->store->id : 'Not Available'}}</td>
                                    <td>{{$transaction->store->name ? $transaction->store->name  : 'Not Available'}}</td>
                                    <td>{{ucwords($transaction->status)}}</td>
                                    <td>{{$transaction->created_at}}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

</section>
@endsection
