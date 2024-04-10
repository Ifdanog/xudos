<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Client;
use App\Models\Company;
use App\Models\Payments;
use App\Models\Stores;
use App\Models\SystemWallets;
use App\Models\Transactions;
use App\Models\User;
use App\Models\Wallets;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Image;
use Illuminate\Support\Facades\Crypt;

class StoreOwnerController extends Controller
{
    public function dashboard()
    {
        // $storeWallets = [];
        // $user = Auth::id();

        // $store = Stores::where(['stowner_id' => $user])->first();
        // $storeId = $store['id'];
        // $systemWallets = SystemWallets::where(['store_id' => $storeId])->get();
        // foreach ($systemWallets as $wallet) {
        //     $storeWallets[$wallet->chain] = $wallet; // Assign the wallet to the corresponding chain key
        // }
        // $transactions = Payments::where(['store_id' => $storeId])->orderBy('created_at', 'desc')->with('Wallets')->get();
        // $list = Cashier::where('store_id', '=', $storeId)->get();
        // //  dd($list);
        // $url = asset('assets/' . Auth()->user()->image);
        // dd($url);
        // $company = Company::where('user_id', auth()->user()->id)->first();
        // $data['clients'] = Client::where('company_id', $company->id)->get();
        // $data['total_clients'] = count($data['clients']);
        // $data['total_monthly_payments'] = 0;
        // $data['total_security_benefits'] = 0;
        // foreach ($data['clients'] as $client) {
        //     $data['total_monthly_payments'] += $client['monthly_payment'];
        //     $data['total_security_benefits'] += $client['security_benefit'];
        // }
        $data['transactions'] = Transactions::limit(5)->get();

        $data['total_payments'] = 0;
        foreach ($data['transactions'] as $client) {
            $data['total_payments'] += str_replace(',', '', $client['amount']);
        }
        return view('company.index', $data);
        // return view('storeowner.store2', compact('transactions', 'storeWallets', 'list', 'url'));
    }
    public function getFilteredRecords(Request $request)
    {
        $user = Auth::user()->id;
        $store = Stores::where(['stowner_id' => $user])->first();
        $storeId = $store['id'];
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date') ? $request->input('end_date') : date('Y-m-d');
        $filteredData = Payments::where('store_id', $storeId)
            ->with('cashier', 'Wallets')
            ->whereBetween('created_at', [$startDate, $endDate])
            // ->whereHas('Wallets', function ($query) {
            //     $query->whereColumn('chain', '=', 'payments.chain');
            // })
            ->get();
        if (!empty($startDate) and !empty($endDate)) {
            $filteredData->whereBetween('created_at', [$startDate, $endDate]);
        } elseif (!empty($startDate)) {
            $filteredData->where('created_at', '>=', $startDate);
        } elseif (!empty($endDate)) {
            $filteredData->where('created_at', '<=', $endDate);
        }
        // Return the filtered data as a JSON response
        return response()->json(['data' => $filteredData], 200);
    }
    public function getBusdBal()
    {
        $user = Auth::id();
        $store = Stores::where(['stowner_id' => $user])->first();
        $storeId = $store['id'];
        $bscWallet = SystemWallets::where(['store_id' => $storeId, 'chain' => 'bsc'])->first();
        $address = $bscWallet->wallet;
        $chain = $bscWallet->chain;
        $balance = getTokenBalance($address, $chain) / 1000000000000000000;
        return $balance;
    }
    public function getSolanaBal()
    {
        $user = Auth::id();
        $store = Stores::where(['stowner_id' => $user])->first();
        $storeId = $store['id'];
        $solWallet = SystemWallets::where(['store_id' => $storeId, 'chain' => 'solana'])->first();
        $address = $solWallet->wallet;
        $url = 'http://localhost:3000/wallets/usdt-balance';
        $data = [
            'address' => $address, // Replace with the actual wallet address
        ];

        // Initialize cURL session
        $ch = curl_init($url);

        // Set cURL options
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        // Execute the cURL request
        $response = curl_exec($ch);
        curl_close($ch);

        return floatval($response);
    }
    public function getTetherBal()
    {
        $user = Auth::id();
        $store = Stores::where(['stowner_id' => $user])->first();
        $storeId = $store['id'];
        $tronWallet = SystemWallets::where(['store_id' => $storeId, 'chain' => 'tether'])->first();
        $address = $tronWallet->wallet;
        $balance = getTetherBalance($address);
        return $balance;
    }
    public function getCashierDashboard()
    {
        $currentlogin = Auth::id();
        $store = Stores::where(['stowner_id' => $currentlogin])->first();
        $storeId = $store['id'];
        dd($storeId);
        //  dd($list);
        return view('storeowner.cashierDashboard', compact('list'));
    }
    public function createCashier()
    {
        return view('storeowner.cashierForm');
    }
    public function storeCashier(Request $request)
    {
        $stores = Stores::all();
        $validator = Validator::make($request->all(), [
            // for user details
            'name' => 'required|string|min:4|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|same:confirm_password|min:8|max:20',
            'confirm_password' => 'required|min:8',
            'contact' => 'required',
        ]);
        if ($validator->fails()) {
            throw new HttpResponseException(
                redirect()->back()->withErrors($validator)->withInput()
            );
        } else {
            DB::beginTransaction();
            try {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'mobile' => $request->contact,
                    'role' => 'cashier',
                ]);

                $currentlogin = Auth::id();
                $store = Stores::where(['stowner_id' => $currentlogin])->first();
                $storeId = $store['id'];
                //  dd($storeId);
                $cashier = Cashier::create([
                    'store_id' => $storeId,
                    'cashier_id' => $user->id,
                ]);

                DB::commit();
            } catch (\Exception $e) {
                dd($e);
                DB::rollBack();
                p($e->getMessage());
            }
            return redirect()->route('storeowner.store-dashboard');
        }
    }
    public function editCashier(Request $request)
    {
        $cashierId = Cashier::find($request->id);
        return view('storeowner.editCashier', compact('cashierId'));
    }

    public function updateCashier(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|gt:0',
            'email' => 'required',
            'password' => 'required|alpha_num|same:confirm_password|min:8|max:20',
            'confirm_password' => 'required|alpha_num|min:8',
            'contact' => 'required',
        ]);
        if ($validator->fails()) {
            throw new HttpResponseException(
                redirect()->back()->withErrors($validator)->withInput()
            );
        } else {
            //updating cashier
            $cashier = cashier::find($request->id);
            $cashier->save();
            //update user
            $user = User::find($cashier->cashier_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->mobile = $request->contact;
            $user->save();
            return redirect()->route('storeowner.store-dashboard');
        }
    }
    public function deleteCashier(Request $request)
    {
        $cashier = Cashier::find($request->id);
        return view('storeowner.deleteCashier', compact('cashier'));
    }

    public function deleteCashierConfirm(Request $request)
    {
        try {
            $cashier = cashier::find($request->id);
            $cashier->delete();
            return redirect()->route('storeowner.store-dashboard')->with('success', 'Cashier deleted successfully');
        } catch (\Exception $e) {
            p($e->getMessage());
        }
    }
    public function getProfile(Request $request)
    {
        $url = asset('assets/' . Auth()->user()->image);
        $userId = User::find($request->id);
        $wallets = Wallets::where('user_id', Auth::user()->id)->get();
        return view('storeowner.profile', compact('userId', 'url', 'wallets'));
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'contact' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $user = User::find(auth()->user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->contact;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '.' . $file->getClientOriginalExtension();
                $path = 'uploads/' . Str::random(20) . '.' . $imageName;
                $file->move(public_path('assets/uploads'), $path);
                $user->image = $path;
            }
            $user->save();
            session()->flash('success', 'Profile Updated successfully');
            return redirect()->route('company.settings');
        }
    }
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|alpha_num|same:confirm_password|min:8|max:20',
            'confirm_password' => 'required|alpha_num|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $user = User::find(auth()->user()->id);
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
                session()->flash('success', 'Password changed successfully');
                return redirect()->route('company.settings');
            } else {
                session()->flash('error', 'Please Check your Old Password');
                return redirect()->route('company.settings');
            }
        }
    }

    public function addStoreWallets(Request $req)
    {
        $bsc_wallet = $req->bsc_wallet;
        $solana_wallet = $req->solana_wallet;
        $tether_wallet = $req->tether_wallet;

        $bscWallet = new Wallets();
        $bscWallet->user_id = Auth::user()->id;
        $bscWallet->wallet = $bsc_wallet;
        $bscWallet->chain = 'bsc';
        $bscWallet->save();

        $solanaWallet = new Wallets();
        $solanaWallet->user_id = Auth::user()->id;
        $solanaWallet->wallet = $solana_wallet;
        $solanaWallet->chain = 'solana';
        $solanaWallet->save();

        $tetherWallet = new Wallets();
        $tetherWallet->user_id = Auth::user()->id;
        $tetherWallet->wallet = $tether_wallet;
        $tetherWallet->chain = 'tether';
        $tetherWallet->save();

        session()->flash('success', 'Wallets saved successfully');
        return redirect()->back();
    }

    public function withdrawFunds(Request $req)
    {
        try {
            $address = $req->address;
            $chain = $req->chain;
            $contract_address = env('usdt_contract_address');
            $store_wallet = SystemWallets::where('wallet', $address)->first();
            if (!$store_wallet) {
                return ['error' => 'Store wallet not found'];
            }
            $store_id = $store_wallet['store_id'];
            $store = Stores::where('id', $store_id)->first();

            $user = User::where('role', 'superuser')->first();
            if ($chain === 'bsc') {
                $admin_wallet = Wallets::where(['user_id' => $user['id'], 'chain' => 'bsc'])->first();
                $store_bsc = Wallets::where(['user_id' => auth()->user()->id, 'chain' => 'bsc'])->first();

                if (!$store_bsc) {
                    return ['error' => 'Store Wallet not found'];
                }

                if (!$admin_wallet) {
                    return ['error' => 'Admin wallet not found'];
                }
                $profit = $store['profit_percentage'];
                $amountToSend = $store_wallet['balance'] * ($profit / 100);
                try {
                    $response_admin = sendTransaction($admin_wallet['wallet'], $address, $amountToSend, $contract_address);
                    $response_admin = json_decode($response_admin['data']);
                    if (isset($response_admin->hash)) {
                        $response_store = sendTransaction($store_bsc['wallet'], $address, ($store_wallet->balance - $amountToSend), $contract_address);
                        $response_store = json_decode($response_store['data']);
                        if (isset($response_store->hash)) {
                            return ['admin_hash' => $response_admin->hash, 'store_hash' => $response_store->hash];
                        } else {
                            return ['error' => 'Store Transaction failed'];
                        }
                    } else {
                        return ['error' => 'Admin Transaction failed'];
                    }
                } catch (Exception $e) {
                    return ['error' => 'Transaction failed: ' . $e->getMessage()];
                }
            } else if ($chain == 'tether') {
                $admin_wallet = Wallets::where(['user_id' => $user['id'], 'chain' => 'tether'])->first();
                $store_tether = Wallets::where(['user_id' => auth()->user()->id, 'chain' => 'tether'])->first();

                if (!$store_tether) {
                    return ['error' => 'Store Wallet not found'];
                }

                if (!$admin_wallet) {
                    return ['error' => 'Admin wallet not found'];
                }
                $profit = $store['profit_percentage'];
                $amountToSend = $store_wallet['balance'] * ($profit / 100);
                $key = Crypt::decryptString($store_wallet['private_key']);
                try {
                    $response_admin = transferUSDT($key, $admin_wallet['wallet'], $amountToSend, $address);
                    $response_admin = json_decode($response_admin['data']);
                    if (isset($response_admin->hash)) {
                        $response_store = transferUSDT($key, $store_tether['wallet'], ($store_wallet->balance - $amountToSend), $address);
                        $response_store = json_decode($response_store['data']);
                        if (isset($response_store->hash)) {
                            return ['admin_hash' => $response_admin->hash, 'store_hash' => $response_store->hash];
                        } else {
                            return ['error' => 'Store Transaction failed'];
                        }
                    } else {
                        return ['error' => 'Admin Transaction failed'];
                    }
                } catch (Exception $e) {
                    return ['error' => 'Transaction failed: ' . $e->getMessage()];
                }
            } else {
                $admin_wallet = Wallets::where(['user_id' => $user['id'], 'chain' => 'tether'])->first();
                $store_tether = Wallets::where(['user_id' => auth()->user()->id, 'chain' => 'tether'])->first();

                if (!$store_tether) {
                    return ['error' => 'Store Wallet not found'];
                }

                if (!$admin_wallet) {
                    return ['error' => 'Admin wallet not found'];
                }
                $profit = $store['profit_percentage'];
                $amountToSend = $store_wallet['balance'] * ($profit / 100);
                $key = Crypt::decryptString($store_wallet['private_key']);
                try {
                    $response_admin = transferSolUSDT($key, $admin_wallet['wallet'], $amountToSend);
                    $response_admin = json_decode($response_admin['data']);
                    if (isset($response_admin->hash)) {
                        $response_store = transferSolUSDT($key, $store_tether['wallet'], ($store_wallet->balance - $amountToSend));
                        $response_store = json_decode($response_store['data']);
                        if (isset($response_store->hash)) {
                            return ['admin_hash' => $response_admin->hash, 'store_hash' => $response_store->hash];
                        } else {
                            return ['error' => 'Store Transaction failed'];
                        }
                    } else {
                        return ['error' => 'Admin Transaction failed'];
                    }
                } catch (Exception $e) {
                    return ['error' => 'Transaction failed: ' . $e->getMessage()];
                }
            }
        } catch (Exception $e) {
            return ['error' => 'Transaction failed: ' . $e->getMessage()];
        }
    }

    public function get_add_client()
    {
        return view('company.add');
    }

    public function add_transaction(Request $req)
    {

        $validatedData = $req->validate([
            'to' => 'required',
            'date' => 'required',
            'fee' => 'required',
            'description' => 'required',
            'chain' => 'required',
            'amount' => 'required'
        ]);
        $user_ = Auth::user();
        if (!$user_) {
            session()->flash('error', 'Please Login');
            return redirect()->back();
        }
        $status = Transactions::create([
            'to' => $req->to,
            'date' => $req->date,
            'fee' => $req->fee,
            'description' => $req->description,
            'chain' => $req->chain,
            'amount' => $req->amount,
            'user_id' => Auth::user()->id
        ]);
        session()->flash('success', 'Transaction Added successfully');
        return view('company.add');
        // $user = new User;
        // $user->name = $req->name;
        // $user->email = $req->email;
        // if (!$user->name || !$user->email) {
        //     session()->flash('error', 'Invalid Name or Email');
        //     return redirect()->back();
        // }
        // $user->password = Hash::make('12345678');
        // $user->role = 'client';
        // $user->mobile = $req->phone_no;
        // $check = $user->save();
        // if ($check) {
        //     $client = $req->all();
        //     $user = User::where('email', $req->email)->first();
        //     $client['user_id'] = $user->id;
        //     $company = Company::where('user_id', auth()->user()->id)->first();
        //     $client['company_id'] = $company->id;
        //     $client['contract_no'] = strtoupper(substr($req->name, 0, 3)) . time();
        //     $client['contract_end_date'] = date('Y-m-d', strtotime($req->contract_start_date . ' +365 days'));
        //     $company = Client::create($client);
        //     session()->flash('success', 'Client Added successfully');
        //     return view('company.add');
        // }
    }

    public function get_clients()
    {
        $company = Company::where('user_id', auth()->user()->id)->first();
        $data['clients'] = Client::where('company_id', $company->id)->get();
        return view('company.clients', $data);
    }
    public function get_single_client($id)
    {
        $data['client'] = Client::where('id', $id)->first();
        return view('company.single-client', $data);
    }
    public function get_edit_client($id)
    {
        $data['client'] = Client::where('id', $id)->first();
        return view('company.edit-client', $data);
    }
    public function edit_client(Request $req)
    {
        $client = Client::where('id', $req->client_id)->first();
        $client->update([
            'iban' => $req->iban,
            'street' => $req->street,
            'zip' => $req->zip,
            'city' => $req->city,
            'country' => $req->country,
            'membership_payment' => $req->membership_payment,
            'monthly_payment' => $req->monthly_payment,
            'security_benefit' => $req->security_benefit,
            'is_active' => $req->is_active,
        ]);
        $user = User::where('id', $client->user_id)->first();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->mobile = $req->phone_no;
        $user->update();
        session()->flash("success", "Client Updated Successfully");
        return redirect()->back();
    }

    public function disable_client($id)
    {
        $client = Client::where('id', $id)->first();
        $client->is_active = 0;
        $client->update();
        session()->flash("success", "Subscription Cancelled Successfully");
        return redirect()->back();
    }
    public function extend_subscription($id)
    {
        $client = Client::where('id', $id)->first();
        $client['contract_end_date'] = date('Y-m-d', strtotime($client->contract_end_date . ' +365 days'));
        $client->update();
        session()->flash("success", "Subscription Updated Successfully");
        return redirect()->back();
    }

    public function get_transactions()
    {
        $user = Auth::user()->id;
        $data['transactions'] = Transactions::where('user_id', $user)->get();
        return view('company.transactions', $data);
    }
    public function delete_transaction($id)
    {
        $tx = Transactions::where('id', $id)->first();
        $tx->delete();
        session()->flash('success', 'Tx Deleted successfully');
        return redirect()->back();

    }

    public function get_settings()
    {
        $data['company'] = Company::where('user_id', auth()->user()->id)->first();
        return view('company.settings', $data);
    }
}
