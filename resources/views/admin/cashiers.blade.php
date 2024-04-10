@extends('admin.layouts.master')

@section('content')
    <section class="section-two container">
        <div class="row-sec">
            <div class="col-sec">
                <div class="history-table">
                    <div class="table-head">
                        <p>Cashiers</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Cashier ID</th>
                                <th>Cashier Name</th>
                                <th>Cashier Email</th>
                                <th>Store ID</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cashier_data as $cashier)
                                <tr>
                                    <td>{{ $cashier->id }}</td>
                                    <td>{{ $cashier->user->name }}</td>
                                    <td>{{ $cashier->user->email }}</td>
                                    <td>{{ $cashier->store->id }}</td>
                                    <td>{{ $cashier->created_at }}</td>
                                    <td style="display: flex; gap: 8px; margin-top: 15px"><a href={{ url('/edit-cashier/' . $cashier->id) }}><i
                                                class="fa-solid fa-pen-to-square"></i></a><a
                                            href={{url('/delete-cashier/'.$cashier->id)}} onclick="return confirm('Are you sure you want to delete this cashier?');"><i class="fa-solid fa-trash" ></i></a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$cashier_data->links()}}
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
@endsection
