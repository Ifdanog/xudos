@extends('admin.layouts.master')


@section('content')
    <section class="section-two container">
        <style>
            @media only screen and (min-width: 1430px) {
                .container {
                    min-width: 1500px;
                }
            }

            #content {
                margin: 0;
            }
        </style>
        <div id="content">
            <div class="modal-heading">
                <p style="font-size: 18px">Company Details</p>
            </div>
            {{-- <div class="transaction-grid">
                <div class="stats-view">
                    <div class="stats-flex">
                        <p>BNB Wallet</p>
                        <button class="btn btn-danger bsc getBal"><i class="fa fa-refresh"></i></button>
                    </div>
                    <div class="stats-bottom">
                        <p style="cursor: pointer" onclick="copy('bnb')" title="Copy to Clipboard">Public
                            key:
                            {{ substr($bnb_wallet->wallet, 0, 6) . '...' . substr($bnb_wallet->wallet, -4) }} </p>
                        <p style="display: none" id="bnb-wallet">{{ $bnb_wallet->wallet }}</p>
                        <p id="bnb-balance">Balance: ${{ number_format($bnb_wallet->balance, 2) }}</p>
                    </div>
                </div>
                <div class="stats-view">
                    <div class="stats-flex">
                        <p>Solana Wallet</p>
                        <button class="btn btn-warning sol getBal"><i class="fa fa-refresh"></i></button>
                    </div>
                    <div class="stats-bottom">
                        <p style="cursor: pointer" onclick="copy('sol')" title="Copy to Clipboard">Public
                            key:
                            {{ substr($sol_wallet->sol_usdt, 0, 6) . '...' . substr($sol_wallet->sol_usdt, -4) }} </p>
                        <p style="display: none" id="sol-wallet">{{ $sol_wallet->sol_usdt }}</p>
                        <p id="sol-balance">Balance: ${{ number_format($sol_wallet->balance, 2) }}</p>
                    </div>
                </div>
                <div class="stats-view">
                    <div class="stats-flex">
                        <p>Tether Wallet</p>
                        <button class="btn btn-success tether getBal"><i class="fa fa-refresh"></i></button>
                    </div>
                    <div class="stats-bottom">
                        <p style="cursor: pointer" onclick="copy('tether')" title="Copy to Clipboard">
                            Public
                            key:
                            {{ substr($tether_wallet->wallet, 0, 6) . '...' . substr($tether_wallet->wallet, -4) }} </p>
                        <p style="display: none" id="tether-wallet">{{ $tether_wallet->wallet }}</p>
                        <p id="tether-balance">Balance: ${{ number_format($tether_wallet->balance, 2) }}</p>
                    </div>
                </div>
                <div class="stats-view">
                    <div class="stats-flex">
                        <p>Total Balance</p>
                    </div>
                    <div class="stats-bottom">
                        <p id="total-balance">Balance:
                            ${{ number_format($bnb_wallet->balance + $tether_wallet->balance + $sol_wallet->balance, 2) }}

                        </p>
                    </div>
                </div>
            </div> --}}
            <div>
                <div class="table-left">
                    <div class="history-table">
                        <div class="table-head">
                            <p>Cashiers</p>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th>Company ID</th>
                                    <th>Company Name</th>
                                    <th>Type</th>
                                    <th>Activation</th>
                                    <th>Email</th>
                                    <th>Profit %</th>
                                    <th>Valid Till</th>
                                    <th>Contact No</th>
                                    <th>IBAN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($store->cashiers as $cashier)
                                    <tr>
                                        <td>{{ $cashier->id }}</td>
                                        <td>{{ $cashier->user->name }}</td>
                                        <td>{{ $cashier->user->email }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="buttons-container">
                            <a href="{{url('/clients')}}" class="btn btn-primary left-button">View All Clients Data</a>
                            <div class="right-buttons">
                                <button class="btn btn-danger">Deactivate Company</button>
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

    {{-- <script>
        function copy(wallet) {
            if (wallet == 'bnb') {
                var walletAddressElement = document.getElementById("bnb-wallet");
                var walletAddressText = walletAddressElement.textContent;
            } else if (wallet == 'sol') {
                var walletAddressElement = document.getElementById("sol-wallet");
                var walletAddressText = walletAddressElement.textContent;
            } else {
                var walletAddressElement = document.getElementById("tether-wallet");
                var walletAddressText = walletAddressElement.textContent;
            }

            navigator.clipboard.writeText(walletAddressText)
                .then(() => {
                    alert("Wallet address copied to clipboard!");
                })
                .catch((error) => {
                    alert("Failed to copy wallet address.");
                });
        }
        async function getWalletBalance(walletAddress) {
            try {
                const url = 'https://solanapi-31eb640afdd2.herokuapp.com/wallets/usdt-balance'
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        address: walletAddress,
                    }),
                });

                const data = await response.json();
                if (data.err) {
                    throw new Error(data.err.name);
                }
                var balance = data;
                console.log(`Wallet balance: ${balance}`);
                return balance;
            } catch (error) {
                alert(error);
                console.error('Error:', error);
            }
        }
        async function getUSDTBalance(walletAddress) {
            console.log(walletAddress);
            const options = {
                method: 'GET',
                headers: {
                    accept: 'application/json'
                }
            };
            try {
                const tronGridUrl = 'https://api.trongrid.io'; // TRONGrid API URL
                const contractAddress =
                    'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t'; // USDT contract address on TRON (TRC20)

                // Make the API request to TRONGrid
                const response_raw = await fetch(`${tronGridUrl}/v1/accounts/${walletAddress}`, options);
                console.log(response_raw);
                const response = await response_raw.json();
                console.log(response);
                const tokenData = response.data.data;

                // Find the USDT token in the token list
                const usdtToken = tokenData.find(token => token.contract_address === contractAddress);

                if (usdtToken) {
                    const balance = usdtToken.balance;
                    console.log(`USDT balance: ${balance}`);
                    return balance;
                } else {
                    console.log('USDT token not found in the wallet');
                }
            } catch (error) {
                alert(error);
                console.error('Error:', error);
            }
        }
        async function getBNBBalance(walletAddress) {
            const bscscanUrl = 'https://api.bscscan.com/api';
            const apiKey = 'KYRTJ8HETTIIJMSV9H6ZDCMBKWDE84NCQ5';
            const usdtContractAddress = '0x55d398326f99059fF775485246999027B3197955'; // USDT contract address on BSC
            try {
                var response = await fetch(
                    `${bscscanUrl}?module=account&action=tokenbalance&contractaddress=${usdtContractAddress}&address=${walletAddress}&tag=latest&apikey=${apiKey}`
                );
                response = await response.json();
                const result = response.result;

                if (result) {
                    var balance = parseFloat(result) / 1e6;
                    console.log(`USDT balance: ${balance}`);
                    return balance;
                } else {
                    console.log('Unable to retrieve USDT balance');
                }
            } catch (error) {
                alert(error);
                console.error('Error:', error);
            }
        }

        function getNewBalance() {
            var total_balance = document.getElementById("total-balance");
            var bnb_balance = parseFloat(document.getElementById("bnb-balance").innerHTML.slice(10).replace(/,/g,
                ''));
            var sol_balance = parseFloat(document.getElementById("sol-balance").innerHTML.slice(10).replace(/,/g,
                ''));
            var tether_balance = parseFloat(document.getElementById("tether-balance").innerHTML.slice(10).replace(/,/g,
                ''));

            var updated_balance = bnb_balance + sol_balance + tether_balance;
            total_balance.innerHTML = 'Balance: $' + updated_balance.toLocaleString();
        }
        $(document).ready(function() {
            $('.getBal').click(function() {
                var clickedButton = $(this);
                if (clickedButton.hasClass('bsc')) {
                    var address = $("#bnb-wallet").text();
                    getBNBBalance(address).then(balance => {
                        $("#bnb-balance").html(balance ? 'Balance: $' + Number(balance)
                            .toLocaleString() : 'Balance: $0.00');
                        getNewBalance();
                        alert("Refresh Successfull");
                    }).catch(err => alert(err));


                } else if (clickedButton.hasClass('sol')) {
                    var address = $("#sol-wallet").text();
                    getWalletBalance(address).then(balance => {
                        $("#sol-balance").html(balance ? 'Balance: $' + Number(balance)
                            .toLocaleString() : 'Balance: $0.00');
                        getNewBalance();
                        alert("Refresh Successfull");
                    }).catch(err => alert(err));

                } else if (clickedButton.hasClass('tether')) {
                    var address = $("#tether-wallet").text();
                    console.log(address);
                    $.ajax({
                        type: "GET",
                        url: "/get-usdt-balance",
                        dataType: "json",
                        data: {
                            address: address
                        },
                        success: (response) => {

                            $($(this)[0].children[0]).removeClass('loader');
                            var balance = response;
                            $("#tether-balance").html(balance ? 'Balance: $' + Number(
                                    balance)
                                .toLocaleString() :
                                'Balance: $0.00');
                            getNewBalance();
                            alert("Refresh Successfull");
                        },
                        error: (response) => {
                            $($(this)[0].children[0]).removeClass('loader');
                            alert("Error Occured");
                        }
                    });


                }

            });
        });
    </script> --}}
@endsection
