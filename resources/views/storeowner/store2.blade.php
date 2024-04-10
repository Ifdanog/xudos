@extends('storeowner.layouts.app2')
@section('content')
    <style>
        .xlsx {
            background-color: #040B11;
            border: none;
            border-radius: 11px;
            padding: 15px 10px;
            color: white;
            text-align: end;
            margin-top: 3px;
        }

        .csv,
        .txt {
            display: none;
        }

        .tableexport-caption {
            caption-side: top !important;
            text-align: end;
        }

        .col-md-4 {
            width: 25%
        }
    </style>
    <section class="section-two container">
        <div class="row-sec">
            <div class="col-sec">
                <div class="history-table" style="overflow-x: hidden">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-xl-3">
                                <div class="card-1">
                                    <div class="card-block">
                                        <h6 class="m-b-1">Overall Balance</h6>
                                        <p class="m-b-0">
                                            <span id="total-balance"></span> USD<span class="f-right"> <img
                                                    src="{{ asset('assets') }}/images/overall-img.svg"
                                                    class="overall-svg"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-green order-card">
                                    <div class="card-block">
                                        <h6 class="m-b-20">BNB</h6>
                                        <h2 class="text-right">
                                            <img src="{{ asset('assets') }}/images/bnb.png" class="Img-bnb">
                                            <a class="get-bnbBal">
                                                <i class="fas fa-refresh"
                                                    style="cursor: pointer;position: relative;top: 54px;left: 67px; font-size: 20px;"></i>
                                            </a>
                                            <img src="{{ asset('assets') }}/images/slash-21.svg" class="slash-img-1">
                                        </h2>
                                        <p class="m-b-12">
                                            <span id="busdBal">
                                                <input type="hidden" id="busdBal1"
                                                    value="{{ $storeWallets['bsc']->balance ? $storeWallets['bsc']->balance : 0 }}">
                                                {{ $storeWallets['bsc']->balance ? number_format($storeWallets['bsc']->balance, 4) : 0 }}
                                            </span>
                                            USD
                                            <span class="f-right"><img src="{{ asset('assets') }}/images/bnb-img.png"
                                                    class="bnb-svg"></span>
                                        </p>
                                        <!-- Add the "Transfer Funds" button here -->
                                        <a style="position: relative; top: -103px; right: -138px; padding: 8px 15px; background-color: white; color: black; cursor: pointer"
                                            onclick="withdraw('bsc', '{{ $storeWallets['bsc']->wallet }}')">Withdraw</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-yellow order-card">
                                    <div class="card-block">
                                        <h6 class="ethrium-text">Tether</h6>
                                        <h2 class="text-right"><img src="{{ asset('assets') }}/images/Etherium (2).png"
                                                class="Img-Etherium">
                                            <a class="get-tetherBal"><i
                                                    class="fas fa-refresh"style="cursor: pointer; position: relative; top: 54px; left: 101px; font-size: 20px;">
                                                </i></a><img src="{{ asset('assets') }}/images/slash-21.svg"
                                                class="slash-img-2"><span class="Digits-3"></span>
                                        </h2>
                                        <p class="m-b-13"><span id="tetherBal">
                                                <input type="hidden" id="tetherBal1"
                                                    value="{{ $storeWallets['tether']->balance ? $storeWallets['tether']->balance : 0 }}">
                                                {{ $storeWallets['tether']->balance ? number_format($storeWallets['tether']->balance, 3) : 0 }}</span>
                                            USD<span class="f-right">
                                                <img src="{{ asset('assets') }}/images/ethrium-img.png"
                                                    class="ethrium-svg"></span></p>
                                        <a style="position: relative; top: -111px; right: -138px; padding: 8px 15px; background-color: white; color: black; cursor: pointer"
                                            onclick="withdraw('tether', '{{ $storeWallets['tether']->wallet }}')">Withdraw</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-3">
                                <div class="card-4">
                                    <a style="position: relative; top: -18px; right: -130px; padding: 8px 15px; background-color: white; color: black; cursor: pointer"
                                        onclick="withdraw('solana', '{{ $storeWallets['solana']->wallet }}')">Withdraw</a>
                                    <div class="card-block">
                                        <h6 class="m-b-21" style="bottom: 40px">Solana</h6>
                                        <h2 class="text-right"><img style="bottom: 58px"
                                                src="{{ asset('assets') }}/images/Assests.png" class="Img-Assets">

                                            <a class="get-solanaBal" id="get-solanaBal">
                                                <i class="fas fa-refresh"
                                                    style="cursor: pointer;position: relative; top: 54px; left: 107px; font-size: 20px;"></i>
                                            </a>
                                            <img src="{{ asset('assets') }}/images/slash-21.svg" class="slash-img-3"><span
                                                class="Digits-4"></span>
                                        </h2>
                                        <p class="m-b-14"> <span id="solanaBal">
                                                <input type="hidden" id="solanaBal1"
                                                    value="{{ $storeWallets['solana']->balance ? $storeWallets['solana']->balance : 0 }}">
                                                {{ $storeWallets['solana']->balance ? number_format($storeWallets['solana']->balance, 4) : 0 }}</span>
                                            USD<span class="f-right"><img
                                                    src="{{ asset('assets') }}/images/assests-img.png"
                                                    class="assests-svg" /></span></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Transaction Component -->

                    <div class="component-container">
                        <div class="component-header">
                            <div class="component-option2 active" id="transactionOption">Transaction History</div>
                            <div class="component-option" id="cashierOption">Cashier Management</div>
                        </div>
                        <div class="component-content" id="transactionComponent">
                            <div class="table-head">
                                <p></p>
                                <button class="download-button" id="calendarButton">
                                    <label for="startDate"></label>
                                    <input type="date"name="start-date" id="start-date"
                                        style=" margin-left: 12px;
                                        margin-right: 12px;
                                        height: 31px;
                                        padding: 0 3px;
                                        border-radius: 7px;
                                        border: 1px solid silver;
                                        color: white;
                                        background-color: #060C11;">
                                    <label for="endDate" style="margin-right: 12px;">To</label>
                                    <input type="date" name="end-date" id="end-date"
                                        style=" margin-left: 12px;
                                    margin-right: 12px;
                                    height: 31px;
                                    padding: 0 3px;
                                    border-radius: 7px;
                                    border: 1px solid silver;
                                    color: white;
                                    background-color: #060C11;">


                                </button>

                            </div>
                            <table class="transaction-table" id="tranxTable">

                                <thead>
                                    <tr>
                                        <th>Cashier ID</th>
                                        <th>Cashier Name</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Chain</th>
                                        <th>Wallet Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transactions as $item)
                                        <tr>
                                            <td>{{ $item->cashier_id }}</td>
                                            <td>{{ $item->cashier->name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->chain }}</td>
                                            <td>{{ $item->Wallets->wallet }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>


                        </div>
                        <div class="component-content" id="cashierComponent" style="display: none;">
                            <div class="table-head">
                                <p></p>
                            </div>
                            <table class="Cashier-table">
                                <thead>
                                    <tr>
                                        <th>Cashier ID</th>
                                        <th>Cashier Name</th>
                                        <th>Created At</th>
                                        <th>Contact</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>{{ $item->user->contact }}</td>
                                            <td>
                                                <a href="{{ route('storeowner.edit-cashier', $item->id) }}">
                                                    <i class="fa-solid fa-pen-to-square" style="color: #ffffff;"></i>
                                                </a>


                                                <a href="{{ route('storeowner.delete-cashier', $item->id) }}"><i
                                                        class="fa-solid fa-trash" style="color: #ffffff;"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="table-footer">
                                <a href="#" id="addCashier">Add Cashier</a>
                            </div>
                            <div class="cashierForm" id="cashierForm" style="display: none;">
                                <div id="content">
                                    <p>Form</p>
                                    <div class="stores-form-grid">
                                        <form action="{{ route('storeowner.store-cashier') }}" method="POST">
                                            @csrf
                                            <div class="cashier--form--div" id="cashier--form--div">
                                                <div class="form--details form--details--left">
                                                    <div class="inner-form-details">
                                                        <label for="Cashier-name">Cashier Name *</label>
                                                        <input type="name" name="name" value="{{ old('name') }}"
                                                            placeholder="Enter name">
                                                        @error('name')
                                                            <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="inner-form-details">
                                                        <label for="email">Email *</label>
                                                        <input type="email" name="email" value="{{ old('email') }}"
                                                            placeholder="Enter email">
                                                        @error('email')
                                                            <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="inner-form-details">
                                                        <label for="password"> Create Password *</label>
                                                        <input type="password" name="password" placeholder="********">
                                                        @error('password')
                                                            <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="inner-form-details">
                                                        <label for="confirm-password">Confirm Password *</label>
                                                        <input type="password" name="confirm_password"
                                                            placeholder="********">
                                                        @error('confirm_password')
                                                            <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="inner-form-details">
                                                        <label for="Cashier-contact">Cashier Contact *</label>
                                                        <input type="number" id="Cashier-contact"
                                                            value="{{ old('contact') }}" name="contact"
                                                            placeholder="+92-854785784">
                                                        @error('contact')
                                                            <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div id="form-btns">
                                                        <input type="reset" id="cashierCloseBtn" class="closeBtn"
                                                            value="Cancel">
                                                        <button type="submit"
                                                            style="
                                                            width: 100%;
                                                            border-radius: 9px;
                                                            background: white;
                                                            color: black;
                                                            font-weight: 500;
                                                            font-family: Montserrat;
                                                        ">Submit</button>
                                                    </div>
                                                </div>
                                                <div class="form--details form--details--right">
                                                    <div class="form--details--right--img">
                                                        <img src="{{ asset('assets') }}/images/6248754 1.png"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script>
        // make ajax call
        // request for current balance
        $(document).ready(function() {
            $('.get-bnbBal').click(function() {
                $($(this)[0].children[0]).addClass('loader');
                $.ajax({
                    type: "GET",
                    url: "/storeowner/getBusdBal",
                    data: "json",
                    success: (response) => {

                        $($(this)[0].children[0]).removeClass('loader');
                        var balance = parseFloat(response).toFixed(4);
                        $('#busdBal').html(balance);
                        var total_balance = $("#total-balance").text().replace(/,/g, '');
                        var bnb_balance = $("#busdBal").text().replace(/,/g, '');
                        var tether_balance = $("#tetherBal").text().replace(/,/g, '');
                        var sol_balance = $("#solanaBal").text().replace(/,/g, '');
                        var updated_balance = Number(bnb_balance) + Number(sol_balance) +
                            Number(tether_balance);
                        //toFixed(4)
                        $("#total-balance").text(updated_balance);
                    },
                    error: (response) => {
                        $($(this)[0].children[0]).removeClass('loader');
                        alert("error");
                    }
                });
            });
            $('.get-tetherBal').click(function() {
                $($(this)[0].children[0]).addClass('loader');
                $.ajax({
                    type: "GET",
                    url: "/storeowner/getTetherBal",
                    data: "json",
                    success: (response) => {
                        $($(this)[0].children[0]).removeClass('loader');
                        var balance = parseFloat(response).toFixed(4);
                        $('#tetherBal').html(balance);
                        var total_balance = $("#total-balance").text().replace(/,/g, '');
                        var bnb_balance = $("#busdBal").text().replace(/,/g, '');
                        var tether_balance = $("#tetherBal").text().replace(/,/g, '');
                        var sol_balance = $("#solanaBal").text().replace(/,/g, '');
                        var updated_balance = parseFloat(bnb_balance) + parseFloat(
                            sol_balance) + parseFloat(tether_balance);
                        console.log(parseFloat(bnb_balance) + parseFloat(
                            sol_balance) + parseFloat(tether_balance));
                        $("#total-balance").text(updated_balance.toFixed(4));
                    },
                    error: (response) => {
                        $($(this)[0].children[0]).removeClass('loader');
                        alert("error");
                    }
                });
            });
            $('#get-solanaBal').click(function() {
                $($(this)[0].children[0]).addClass('loader');
                $.ajax({
                    type: "GET",
                    url: "/storeowner/getSolanaBal",
                    data: "json",
                    success: (response) => {
                        $($(this)[0].children[0]).removeClass('loader');
                        var balance = Number(response).toFixed(4);

                        $('#solanaBal').html(balance);
                        var total_balance = $("#total-balance").text().replace(/,/g, '');
                        var bnb_balance = $("#busdBal").text().replace(/,/g, '');
                        var tether_balance = $("#tetherBal").text().replace(/,/g, '');
                        var sol_balance = $("#solanaBal").text().replace(/,/g, '');
                        var updated_balance = parseFloat(bnb_balance) + parseFloat(
                            sol_balance) + parseFloat(tether_balance);
                        console.log((bnb_balance) + (
                            sol_balance) + (tether_balance));
                        $("#total-balance").text(updated_balance.toFixed(4));
                    },
                    error: (response) => {
                        $($(this)[0].children[0]).removeClass('loader');
                        alert("error");
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#tranxTable").dataTable({
                ordering: true,
                "order": [
                    [0, "desc"]
                ],

                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel'
                ]
            });




            function updateTableWithFilter() {
                $('#tranxTable tbody').html('loading...');
                var startDate = $('#start-date').val();
                var endDate = $('#end-date').val();

                $.ajax({
                    url: '/storeowner/records-filter',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function(response) {
                        $('#tranxTable tbody').empty();
                        $('#tranxTable tbody').html('');
                        //Destroy the old Datatable
                        $('#tranxTable').DataTable().clear().destroy();

                        //Create new Datatable

                        console.log(response.data.length);
                        if (response.data.length) {
                            response.data.forEach(function(row) {

                                var newRow = '<tr>' +
                                    '<td>' + row.cashier_id + '</td>' +
                                    '<td>' + (row.cashier ? row.cashier.name : '') + '</td>' +
                                    '<td>' + row.created_at + '</td>' +
                                    '<td>' + row.amount + '</td>' +
                                    '<td>' + row.chain + '</td>' +
                                    '<td>' + row.wallets.wallet + '</td>' +
                                    // Add other table data cells as needed
                                    '</tr>';

                                $('#tranxTable tbody').append(newRow);
                            });
                            $("#tranxTable").dataTable({
                                ordering: true,
                                "order": [
                                    [0, "desc"]
                                ],

                                dom: 'Bfrtip',
                                buttons: [
                                    'copy', 'csv', 'excel'
                                ]
                            });
                        } else {
                            $('#tranxTable tbody').html('<p>No record found</p>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }

            // Apply filter button click event
            $(document).on('change', '#start-date, #end-date', function() {
                updateTableWithFilter();
            });


        });
    </script>
    <script>
        const withdraw = async (chain, address) => {
            console.log(address);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                const response = await fetch("/storeowner/withdraw", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    body: JSON.stringify({
                        address,
                        chain,
                    }),
                });

                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }

                const data = await response.json();
                console.log(data);
            } catch (err) {
                console.error(err);
            }

        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
@endsection
