<?php

use App\Models\SystemWallets;
use App\Models\Wallets;
use IEXBase\TronAPI\Provider\HttpProvider;
use IEXBase\TronAPI\Tron;
use IEXBase\TronAPI\TRC20Contract;
use IEXBase\TronAPI\Exception\TronException;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Illuminate\Support\Str;

if (!function_exists('p')) {
    function p($data)
    {
        echo "<pre>";
        print_r($data);
        echo "<pre>";
    }
}
// -------------wallet create section start-----------------
function CreateWallet()
{
    // $wallet_api = env('erc_api');
    $wallet_api = env('erc_api');
    $data['query'] = $wallet_api . 'bsc/mainnet/create_wallet';
    $data['method'] = 'get';
    $data['function_called'] = 'Create Wallet';
    // $requests = new ApiRequests();
    return ApiRequestsExecute($data);
}

function ApiRequestsExecute($data = null)
{
    // dd($data);
    $auth = isset($data['auth']) ? $data['auth'] : 'Z4beILBI8a7zYjSW0Jg0oNRyllXCrRdeAgmArQqgCfWB3t9F';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $data['query']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    if ($data['method'] == 'post') {
        curl_setopt($curl, CURLOPT_ENCODING, '');
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        if (isset($data['fields'])) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data['fields']));
        }
    }
    if ($data['method'] == 'get') {
        if (isset($data['fields'])) {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data['fields']));
        }
    }
    if (isset($data['data_type'])) {
        if ($data['data_type'] == 'urlencoded') {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array(
                "Authorization: " . $auth,
                "Content-Type: application/x-www-form-urlencoded",
                'api-key: ' . $auth
            ));
        }
    } else {
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Authorization: " . $auth,
            "Content-Type: application/json",
            'api-key: ' . $auth
        ));
    }
    // RESPONSE
    $response = curl_exec($curl);
    $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    //dd($response);
    return ['data' => $response, 'response_code' => $httpcode];
}
function bsc_wallet_create($user)
{
    $wallet = CreateWallet();
    $wallet = json_decode($wallet['data'])->data->wallet;
    $data = [
        'user_id' => $user->id,
        'wallet' => $wallet->public,
        'private_key' => Crypt::encryptString($wallet->private),
        'chain' => 'bsc',
        //'raw_data' => json_encode($wallet),
    ];
    Wallets::create($data);
    $data = [
        'user_id' => $user->id,
        'wallet' => $wallet->public,
        'private_key' => Crypt::encryptString($wallet->private),
        'chain' => 'solana',
        //'raw_data' => json_encode($wallet),
    ];
    $wallet = Wallets::create($data);
}
function tether_wallet_create($user)
{
    $wallet = CreateWallet();
    $wallet = json_decode($wallet['data'])->data->wallet;
    $data = [
        'user_id' => $user->id,
        'wallet' => $wallet->public,
        'private_key' => Crypt::encryptString($wallet->private),
        'chain' => 'tether',
        // 'raw_data' => json_encode($wallet),
    ];
    $wallet = Wallets::create($data);
}
//for store
function SystemWalletsCreate($store)
{
    try {
        $wallet = CreateWallet();
        $wallet = json_decode($wallet['data'])->data->wallet;
        if (!isset($wallet->public) || !isset($wallet->private)) {
            throw new Exception("Invalid wallet data");
        }
        $data = [
            'store_id' => $store->id,
            'wallet' => $wallet->public,
            'private_key' => Crypt::encryptString($wallet->private),
            'chain' => 'bsc',
        ];
        $response['bnb_wallet'] = SystemWallets::create($data);
        $solana_wallet = createSolanaWAllet();
        $data = [
            'store_id' => $store->id,
            'wallet' => $solana_wallet->wallet->publicKey,
            'private_key' => Crypt::encryptString($solana_wallet->wallet->encodedKey),
            'sol_usdt' => $solana_wallet->usdtAddress,
            'chain' => 'solana',
        ];
        $response['sol_wallet'] = SystemWallets::create($data);
        $tether_wallet = createWalletTron();
        $data = [
            'store_id' => $store->id,
            'wallet' => $tether_wallet->getAddress(true),
            'private_key' => Crypt::encryptString($tether_wallet->getPrivateKey()),
            'chain' => 'tether',
        ];
        $response['tether_wallet'] = SystemWallets::create($data);
        $response['status'] = 200;
    } catch (Exception $e) {
        $response['status'] = 500;
        $response['error'] = $e->getMessage();
    }
    return $response;
}
function tether_systemWallet_create($store)
{
    $wallet = CreateWallet();
    $wallet = json_decode($wallet['data'])->data->wallet;
    $data = [
        'store_id' => $store->id,
        'wallet' => $wallet->public,
        'private_key' => Crypt::encryptString($wallet->private),
        'chain' => 'tether',
    ];
    $wallet = Systemwallets::create($data);
}
// -------------wallet crate section end-----------------


// -------------get balance section start-----------------
function getTokenBalance($address, $chain)
{
    if (substr($address, 0, 2) === "0x" && strlen($address) == 42) {
        if ($chain == "bsc") {
            $url = 'https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0xe9e7cea3dedca5984780bafc599bd69add087d56&address=' . $address . '&tag=latest&apikey=KYRTJ8HETTIIJMSV9H6ZDCMBKWDE84NCQ5';
        } else if ($chain == "solana") {
            $url = 'https://api.bscscan.com/api?module=account&action=tokenbalance&contractaddress=0xe9e7cea3dedca5984780bafc599bd69add087d56&address=' . $address . '&tag=latest&apikey=KYRTJ8HETTIIJMSV9H6ZDCMBKWDE84NCQ5';
        }
        $response = apiRequest($url);
        return $response['result'];
    }
}
function apiRequest($url)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $data = json_decode($response, true);
    return $data;
}


function getTetherBalance($address)
{
    $contract = tron();
    if (array_key_exists('contract', $contract)) {
        return $contract['contract']->balanceOf($address);
    }
}
function generateUuidV4()
{
    $data = openssl_random_pseudo_bytes(16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // Set the version to 4
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // Set the variant

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function generateInvoiceId()
{
    $prefix = 'INV'; // Invoice prefix
    $date = Carbon::now()->format('Ymd'); // Current date in YYYYMMDD format
    $uniqueId = Str::random(6); // Random unique identifier

    return $prefix . '-' . $date . '/' . $uniqueId;
}
// -------------get balance section end-----------------

function tron($private_key = null)
{
    try {
        $fullNode = new HttpProvider('https://api.trongrid.io');
        $solidityNode = new HttpProvider('https://api.trongrid.io');
        $eventServer = new HttpProvider('https://api.trongrid.io');
        $tron = new Tron($fullNode, $solidityNode, $eventServer, null, null, $private_key);
        $contract = new TRC20Contract($tron, 'TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');
        return ['tron' => $tron, 'contract' => $contract];
    } catch (TronException $e) {
        exit($e->getMessage());
    }
}

function _getTokenBalance($address)
{
    $contract = tron();
    if (array_key_exists('contract', $contract)) {
        return $contract['contract']->balanceOf($address);
    }
}
function getTRXBalance($address)
{
    $tron = tron();
    if (array_key_exists('tron', $tron)) {
        return $tron['tron']->getBalance($address) / 1000000;
    }
}
function createWalletTron()
{
    $tron = tron()['tron'];
    $wallet = $tron->createAccount();
    return $wallet;
}
function user_wallet($user)
{
    $wallet = Wallets::where(['user_id' => $user->id])->first();
    $trxBalance = getTRXBalance($wallet->wallet);
    $usdtBalance = _getTokenBalance($wallet->wallet);
    $wallet->balance = round($usdtBalance, 2);
    //  $wallet->trx_balance = round($trxBalance, 3);
    $wallet->save();
    return $wallet;
}
function transferUSDT($from_privateKey, $address, $amount, $from_address)
{
    $contract = tron($from_privateKey);
    if (array_key_exists('contract', $contract)) {
        return $contract['contract']->transfer($address, $amount, $from_address);
    }
}

function getTrc20TokenTransactions($wallet_address)
{
    $tron = tron();
    $contract = $tron['contract'];
    $response = $contract->getTransactions($wallet_address);
    return $response;
}
function createSolanaWallet()
{
    $data['query'] = 'https://solanapi-31eb640afdd2.herokuapp.com/wallets/create';
    $data['method'] = 'get';
    $wallet = ApiRequestsExecute($data);
    $wallet = json_decode($wallet['data']);
    return $wallet;
}
function sendTransaction($to, $from, $amount, $contract_address = null)
{
    $wallet = SystemWallets::where(['wallet' => $from])->first()->makeVisible('private_key');
    $nonce = getNonce($from, false);
    $nonce = json_decode($nonce['data']);
    $transaction_data = [
        'from_address' => $from,
        'to_address' => $to,
        'value' => $amount,
        'nonce' => $nonce->nonce,
        'from_private_key' => Crypt::decryptString($wallet->private_key)
    ];

    $gas_price = validate_gas_price();
    if ($gas_price) {
        $transaction_data['gasLimit'] = '180000';
        $transaction_data['gasPrice'] = $gas_price;
    }
    if ($contract_address != null) {
        $transaction_data['contract_address'] = $contract_address;
        $response = Transfer($transaction_data, false);
    } else {
        $response = SendTxn($transaction_data, false);
    }
    return $response;
}

function getNonce($address)
{
    $wallet_api = env('erc_api');
    $data['query'] = $wallet_api . 'ether/mainnet/nonce/' . $address;
    $data['method'] = 'get';
    $data['function_called'] = 'Get Balance';
    // $requests = new ApiRequests();
    return  ApiRequestsExecute($data);
}

function validate_gas_price()
{
    $ch = curl_init();
    $url = 'https://api.etherscan.io/api?module=gastracker&action=gasoracle&apikey=ANTYVRGFKMYV9SI34S28IG3EXR1EPXETNZ';
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    $data = json_decode($response);
    if ($data->result->FastGasPrice) {
        $safeGasPrice = $data->result->FastGasPrice;
        return $safeGasPrice * 1000000000;
    } else {
        return 0;
    }
}
function Transfer($post_data)
{
    $wallet_api = env('erc_api');
    $data['query'] = $wallet_api . 'token/mainnet/transfer';
    $data['method'] = 'post';
    $data['function_called'] = 'Send Transaction';
    $data['fields'] = $post_data;
    // $requests = new ApiRequests();
    return ApiRequestsExecute($data);
}

function SendTxn($post_data)
{
    $wallet_api = env('erc_api');
    $data['query'] = $wallet_api . 'ether/mainnet/transfer';
    $data['method'] = 'post';
    $data['function_called'] = 'Send Transaction';
    $data['fields'] = $post_data;
    return  ApiRequestsExecute($data);
}
function transferSolUSDT($senderPrivateKey, $receiverPublicKey, $amount)
{
    // Define the endpoint URL
    $url = 'https://solanapi-31eb640afdd2.herokuapp.com/wallets/transfer-usdt'; // Replace with your actual endpoint URL

    // Define the JSON payload
    $data = [
        'senderPrivateKey' => $senderPrivateKey,
        'receiverPublicKey' => $receiverPublicKey,
        'amount' => $amount,
    ];

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); // Convert data to JSON
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
    ]);

    try {
        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }

        // Close the cURL session
        curl_close($ch);

        // Process the response data here
        return json_decode($response, true);
    } catch (Exception $e) {
        // Handle exceptions that may occur during the request
        return ['error' => 'Request failed: ' . $e->getMessage()];
    }
}
