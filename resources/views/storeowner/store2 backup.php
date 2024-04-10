@extends('storeowner.layouts.app2')
@section('content')
    <style>
        .xlsx {
            background-color: white;
            border: none;
            border-radius: 7px;
            padding: 5px;
            color: black;
            text-align: end;
        }

        .csv,
        .txt {
            display: none;
        }

        .tableexport-caption {
            caption-side: top !important;
            text-align: end;
        }
    </style>
    <section class="section-two container">
        <div class="row-sec">
            <div class="col-sec">
                <div class="history-table">
                    <!-- Cards -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-xl-3">
                                <div class="card-1">
                                    <div class="card-block">
                                        <h6 class="m-b-1">Overall Balance</h6>
                                        <h2 class="text-right">
                                            <span class="Digits-1"></span>
                                        </h2>
                                        <p class="m-b-0">
                                            <span id="total-balance"></span> USD
                                            <span class="f-right"> <img src="{{ asset('assets') }}/images/overall-img.svg" class="overall-svg"></span>
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
                                            <a class="get-bnbBal"><i class="fas fa-refresh"style="cursor: pointer;position: relative;top: 43px;left: 101px; font-size: 20px;">
                                                </i></a>
                                            <img src="{{ asset('assets') }}/images/slash-21.svg" class="slash-img-1">
                                        </h2>
                                        <p class="m-b-0">
                                            <span id="busdBal">
                                                {{ $storeWallets['bsc']->balance ? number_format($storeWallets['bsc']->balance, 4) : 0 }}</span>
                                            USD
                                            <span class="f-right"><img src="{{ asset('assets') }}/images/bnb-img.png"
                                                    class="bnb-svg"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-3">
                                <div class="card bg-c-yellow order-card">
                                    <div class="card-block">
                                        <h6 class="ethrium-text">Tether</h6>
                                        <h2 class="text-right">
                                            <img src="{{ asset('assets') }}/images/Etherium (2).png" class="Img-Etherium">
                                            <a class="get-tetherBal"><i
                                                    class="fas fa-refresh"style="cursor: pointer;position: relative;top: 43px; left: 79px; font-size: 20px;">
                                                </i></a><img src="{{ asset('assets') }}/images/slash-21.svg"
                                                class="slash-img-2"><span class="Digits-3"></span>
                                        </h2>
                                        <p class="m-b-0">
                                            <span id="tetherBal">
                                                {{ $storeWallets['tron']->balance ? number_format($storeWallets['tron']->balance, 3) : 0 }}</span>
                                            USD <span class="f-right"><img
                                                    src="{{ asset('assets') }}/images/ethrium-img.png"
                                                    class="ethrium-svg"></span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-xl-3">
                                <div class="card-4">
                                    <div class="card-block">
                                        <h6 class="m-b-21">Solana</h6>
                                        <h2 class="text-right">
                                            <img src="{{ asset('assets') }}/images/Assests.png" class="Img-Assets">
                                            <a class="get-solanaBal" id="get-solanaBal">
                                                <i class="fas fa-refresh"
                                                    style="cursor: pointer;position: relative; top: 43px; left: 55px; font-size: 20px;"></i>
                                            </a>
                                            <img src="{{ asset('assets') }}/images/slash-21.svg" class="slash-img-3"><span
                                                class="Digits-4"></span>
                                        </h2>
                                        <p class="m-b-0">
                                            <span id="solanaBal">
                                                {{ $storeWallets['solana']->balance ? number_format($storeWallets['solana']->balance, 4) : 0 }}</span>
                                            USD <span class="f-right"><img
                                                    src="{{ asset('assets') }}/images/assests-img.png"
                                                    class="assests-svg"></span>
                                        </p>
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
                                        style="margin-left: 12px; margin-right: 12px;">
                                    <label for="endDate" style="margin-right: 12px;">To</label>
                                    <input type="date" name="end-date" id="end-date" style="margin-right: 12px;">
                                    {{-- <a href="#"  tableexport-id="0f0f55-xlsx" onClick="$('#tranxTable').tableExport()" id="downloadExcel">
                                        <i class="fas fa-arrow-down"></i>
                                    </a> --}}
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
                                                        <input type="name" name="name" placeholder="Enter name">
                                                        @error('name')
                                                            <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="inner-form-details">
                                                        <label for="email">Email *</label>
                                                        <input type="email" name="email" placeholder="Enter email">
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
                                                        <input type="number" id="Cashier-contact" name="contact"
                                                            placeholder="+92-854785784">
                                                        @error('contact')
                                                            <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div id="form-btns">
                                                        <input type="reset" id="cashierCloseBtn" class="closeBtn"
                                                            value="Cancel">
                                                        <input type="submit" value="Submit">
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
    </section>
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
                        var balance = parseFloat(response.balance).toFixed(4);
                        $('#busdBal').html(balance);
                        // var total_balance = $(".total-balance").html(parseFloat($(".busdBal")
                        //     .text()) + parseFloat($(
                        //     ".tetherBal").text()) + parseFloat($(".solanaBal").text()));
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
                        var balance = parseFloat(response.balance).toFixed(4);
                        $('#tetherBal').html(balance);
                        // var total_balance = $(".total-balance").html(parseFloat($(".busdBal")
                        //     .text()) + parseFloat($(
                        //     ".tetherBal").text()) + parseFloat($(".solanaBal").text()));
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
                        var balance = parseFloat(response.balance).toFixed(4);
                        $('#solanaBal').html(balance);
                    },
                    error: (response) => {
                        $($(this)[0].children[0]).removeClass('loader');
                        alert("error");
                    }
                });
            });

            var total_balance = $("#total-balance").text();
            var bnb_balance = $("#busdBal").text();
            var tether_balance = $("#tetherBal").text();
            var sol_balance = $("#solanaBal").text();
            var updated_balance = parseFloat(bnb_balance) + parseFloat(sol_balance) + parseFloat(tether_balance);
            $("#total-balance").text(updated_balance.toFixed(4));
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#tranxTable').tableExport({
                fileName: 'Transaction Data',
                type: 'xlsx'
            });
            $('.xlsx').html('<i class="fas fa-file-excel"></i> Download Excel');

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
    <script>
        $(document).ready(function() {
            // $('#downloadExcel').click(function() {
            //     return;
            //     $('#tranxTable').tableExport({fileName: 'eststs', type:'xlsx'});
            //     return;
            //     // Generate the Excel file data
            //     var excelData = generateExcelData();

            //     // Convert the data to a Blob
            //     var blob = new Blob([excelData], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });

            //     // Create a download URL
            //     var url = URL.createObjectURL(blob);

            //     // Set the download attribute of the anchor tag
            //     $(this).attr('href', url).attr('download', 'table_data.xlsx');
            // });
        });

        function generateExcelData() {
            // Get the table element
            var table = document.getElementById('tranxTable');

            // Create a new workbook and add a worksheet
            var wb = XLSX.utils.book_new();
            var ws = XLSX.utils.table_to_sheet(table);

            // Add the worksheet to the workbook
            XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

            // Generate Excel file data
            var excelData = XLSX.write(wb, {
                bookType: 'xlsx',
                type: 'binary'
            });

            return excelData;
        }
    </script>
@endsection
