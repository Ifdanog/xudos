@extends('admin.layouts.master')

@section('content')
    <section class="section-two container">
        <div class="row-sec">
            <div class="col-sec" style="width: 100%">
                <div class="history-table">
                    <div class="table-head">
                        <p>Stores</p>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Store ID</th>
                                <th>Store Name</th>
                                <th>Store Email</th>
                                <th>Store Type</th>
                                <th>Profit %</th>
                                <th>Store Contact</th>
                                <th>Valid Till</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stores_data as $store)
                                <tr>
                                    <td>{{ $store->id }}</td>
                                    <td>{{ $store->name }}</td>
                                    <td>{{ $store->email }}</td>
                                    <td>{{ $store->store_type }}</td>
                                    <td>{{ $store->profit_percentage }}</td>
                                    <td>{{ $store->mobile }}</td>
                                    <td>{{ $store->valid_till }}</td>
                                    <td id="action" style="margin-top: 15px">
                                        <a href={{url('/single-store/'. $store->id)}} style="text-decoration: none"><i class="fa-solid fa-eye" style="color: #ffffff;"></i></a>
                                        <a href={{ url('/edit-store/' . $store->id) }}><i class="fa-solid fa-pen-to-square"
                                                style="color: #ffffff;"></i></a><a
                                            href={{ url('/delete-store/' . $store->id) }}
                                            onclick="return confirm('Are you sure you want to delete this store?');"><i
                                                class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{$stores_data->links()}}
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
