<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Company;
use App\Models\Client;
use App\Models\Payments;
use App\Models\Store;
use App\Models\Stores;
use App\Models\SystemWallets;
use App\Models\User;
use App\Models\Wallets;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //

    public function index()
    {
        // Artisan::call('cache:clear');
        // Artisan::call('optimize');
        // Artisan::call('route:cache');
        // Artisan::call('route:clear');
        // Artisan::call('view:clear');
        // Artisan::call('config:cache');
        // Artisan::call('config:clear');
        // return "All Cache Cleared !!!";
        return view('index');
    }
    public function get_login()
    {
        return view('login');
    }

    public function post_login(Request $req)
    {
        $user = User::where(['email' => request('email')])->first();
        if ($user) {
            if (auth()->attempt(['email' => request('email'), 'password' => request('password')])) {
                Auth::login($user);
                $data['payments'] = Payments::get();
                $data['graph_data'] = [];
                $allMonths = array(
                    "Jan", "Feb", "Mar", "Apr", "May", "Jun",
                    "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
                );

                $data['graph_data'] = array_fill_keys($allMonths, 0);

                foreach ($data['payments'] as $payment) {
                    $month = date("M", strtotime($payment->created_at));
                    $data['graph_data'][$month] += $payment->amount;
                }
                $prices = apiRequest("https://api.coingecko.com/api/v3/simple/price?ids=tether,binancecoin,solana&vs_currencies=usd");
                if ($prices['status'] == 500) {
                    $data['tether'] = 0.0;
                    $data['bnb'] = 0.0;
                    $data['sol'] = 0.0;
                } else {
                    $data['tether_price'] = $prices['tether'];
                    $data['bnb_price'] = $prices['bnb'];
                    $data['sol_price'] = $prices['sol'];
                }
                $data['stores_data'] = Stores::with(['wallets'])->latest()->limit(6)->get();
                return view('admin.index', $data);
            } else {
                session()->flash('error', 'Invalid Password');
                return redirect('/login');
            }
        } else {
            session()->flash('error', 'Invalid Email');
            return redirect('/login');
        }
    }
    public function get_add_stores()
    {
        $data['stores_data'] = Stores::with(['wallets'])->latest()->limit(8)->get();
        $data['cashier_data'] = Cashier::with(['user', 'store'])->latest()->limit(8)->get();
        return view('admin.add', $data);
    }
    public function get_dashboard()
    {
        $data['companies'] = Company::get();
        $data['clients'] = Client::get();
        $data['total_clients'] = count($data['clients']);
        $data['total_monthly_payments'] = 0;
        $data['total_security_benefits'] = 0;

        foreach ($data['clients'] as $client) {
            $data['total_monthly_payments'] += $client['monthly_payment'];
            $data['total_security_benefits'] += $client['security_benefit'];
        }
        return view('admin.index', $data);
    }

    public function get_transactions()
    {
        // $data['transactions'] = Payments::join('cashiers', 'payments.cashier_id', '=', 'cashiers.cashier_id')
        //     ->join('stores', 'cashiers.store_id', '=', 'stores.id')
        //     ->select('payments.*', 'payments.id as payment_id', 'cashiers.id', 'stores.id as store_id_new', 'stores.name')
        //     ->orderBy('payments.created_at', 'asc')
        //     ->paginate(10);

        // $users = User::latest()->get();
        // foreach ($users as $user) {
        //     foreach ($data['transactions'] as &$transaction) {
        //         if ($transaction['cashier_id'] == $user->id) {
        //             $transaction['cashier_name'] = $user->name;
        //         }
        //         if ($transaction['customer_id'] == $user->id) {
        //             $transaction['customer_name'] = $user->name;
        //         }
        //     }
        // }

        $data['clients'] = Client::get();
        return view('admin.transactions', $data);
    }
    public function get_cashiers()
    {
        $data['cashier_data'] = Cashier::with(['user', 'store'])->latest()->paginate(10);
        return view('admin.cashiers', $data);
    }
    public function get_stores()
    {
        $data['stores_data'] = Stores::with(['wallets'])->latest()->paginate(10);
        return view('admin.stores', $data);
    }

    public function add_store(Request $req)
    {
        $user_ = User::where('email', $req->email)->first();
        if ($user_) {
            session()->flash('error', 'Email Already Exists');
            return redirect()->back();
        }
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        if (!$user->name || !$user->email) {
            session()->flash('error', 'Invalid Name or Email');
            return redirect()->back();
        }
        $user->password = Hash::make($req->password);
        $user->role = 'storeowner';
        $check = $user->save();
        if ($check) {
            $store = $req->all();
            $user = User::where('email', $req->email)->first();
            $store['stowner_id'] = $user->id;
            $store_ = Stores::create($store);
            $response = SystemWalletsCreate($store_);
            if ($response['status'] == 200) {
                session()->flash('success', 'Store Added');
                return redirect()->back();
            } else {
                session()->flash('error', 'Error Occured, Please Try Again');
                return redirect()->back();
            }
        }
    }
    public function add_cashier(Request $req)
    {
        $user_ = User::where('email', $req->email)->first();
        if ($user_) {
            session()->flash('error', 'Email Already Exists');
            return redirect()->back();
        }
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        if (!$user->name || !$user->email) {
            session()->flash('error', 'Invalid Name or Email');
            return redirect()->back();
        }
        $user->password = Hash::make($req->password);
        $user->role = 'cashier';
        $check = $user->save();

        if ($check) {
            $cashier = new Cashier;
            $cashier->store_id = $req->store_id;
            $user = User::where('email', $req->email)->first();
            $cashier->cashier_id = $user->id;
            $cashier->save();
            session()->flash('success', 'Cashier Added');
            return redirect()->back();
        }
    }
    public function get_single_transaction($id)
    {
        $data['transaction'] = Payments::where('id', $id)->with(['store', 'customer', 'cashier'])->first();
        return view('admin.single-transaction', $data);
    }
    public function get_edit_store($id)
    {
        $data['store'] = Stores::where('id', $id)->first();
        return view('admin.edit-store', $data);
    }

    public function edit_store(Request $req)
    {
        $store = Stores::where('id', $req->id)->first();
        $store->name = $req->name;
        $store->email = $req->email;
        if ($req->password != null) {
            $store->password = Hash::make($req->password);
        }
        $store->mobile = $req->mobile;
        $store->store_type = $req->store_type;
        $store->profit_percentage = $req->profit_percentage;
        $store->valid_till = $req->valid_till;
        $store->update();
        $user = User::where('id', $store->stowner_id)->first();
        $user->name = $req->name;
        $user->email = $req->email;
        if ($req->password != null) {
            $user->password = Hash::make($req->password);
        }
        $user->update();
        session()->flash("success", "Store Updated Successfully");
        return redirect('/stores');
    }

    public function delete_store($id)
    {
        $store = Stores::where('id', $id)->first();
        $user = User::where('id', $store->stowner_id)->first();
        $user->delete();
        $store->delete();
        session()->flash("success", "Store Deleted Successfully");
        return redirect('/stores');
    }

    public function get_edit_cashier($id)
    {

        $data['cashier'] = Cashier::where('id', $id)->with(['user', 'store'])->first();
        $data['stores_data'] = Stores::get();
        return view('admin.edit-cashier', $data);
    }

    public function edit_cashier(Request $req)
    {
        $cashier = Cashier::where('id', $req->id)->first();
        $user = User::where('id', $cashier->cashier_id)->first();
        $user->name = $req->name;
        $user->email = $req->email;
        if ($req->password != null) {
            $user->password = Hash::make($req->password);
        }
        $user->update();
        $cashier->store_id = $req->store_id;
        $cashier->update();
        session()->flash("success", "Cashier Details Edited successfully!");
        return redirect('/cashiers');
    }
    public function delete_cashier($id)
    {
        $cashier = Cashier::where('id', $id)->first();
        $user = User::where('id', $cashier->cashier_id)->first();
        $user->delete();
        $cashier->delete();
        session()->flash("success", "Cashier Deleted Successfully");
        return redirect('/cashiers');
    }

    public function get_single_store($id)
    {
        $data['store'] = Stores::where('id', $id)->with(['cashiers.user'])->first();
        $data['bnb_wallet'] = SystemWallets::where(['store_id' => $id, 'chain' => 'bsc'])->first();
        $data['sol_wallet'] = SystemWallets::where(['store_id' => $id, 'chain' => 'solana'])->first();
        $data['tether_wallet'] = SystemWallets::where(['store_id' => $id, 'chain' => 'tether'])->first();

        return view('admin.single-store', $data);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/login');
    }

    public function refresh_usdt(Request $req)
    {
        if ($req->address) {
            $response =  _getTokenBalance($req->address);
            return $response;
        } else {
            return null;
        }
    }

    public function test_wallet()
    {
        createSolanaWallet();
    }

    public function addAdminWallets(Request $req)
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

    public function withdrawFunds()
    {
    }

    public function get_settings()
    {
        $data['user'] = User::where('role', 'superuser')->first();
        return view('admin.settings', $data);
    }
    public function updatePassword(Request $request)
    {
        $user = User::find(auth()->user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();
            session()->flash('success', 'Password has been changed successfully');
            return redirect()->route('settings');
        } else {
            session()->flash('error', 'Please Check your Old Password');
            return redirect()->back();
        }
    }
    public function updateProfile(Request $request)
    {
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
        return redirect()->route('settings');
    }
    public function get_add_company()
    {
        return view('admin.add-company');
    }
    public function get_clients($id)
    {
        $data['clients'] = Client::where('company_id', $id)->get();
        return view('admin.clients', $data);
    }
    public function get_single_client($id)
    {
        $data['client'] = Client::where('id', $id)->first();
        return view('admin.single-client', $data);
    }
    public function get_single_company($id)
    {
        $data['company'] = Company::where(['id' => $id])->with('user')->first();
        return view('admin.single-store', $data);
    }

    public function add_company(Request $req)
    {
        $validatedData = $req->validate([
            'name' => 'required',
            'company_type' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone_no' => 'required',
            'payment_method' => 'required',
            'iban' => 'required',
            'employee' => 'required',
            'valid_till' => 'required|date',
            'issued_date' => 'required|date',
            'profit_percentage' => 'required|numeric',
        ]);
        $user_ = User::where('email', $req->email)->first();
        if ($user_) {
            session()->flash('error', 'Email Already Exists');
            return redirect()->back();
        }
        $user_ = User::where('id', $req->id)->first();
        if ($user_) {
            session()->flash('error', 'Id Already Exists');
            return redirect()->back();
        }
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        if (!$user->name || !$user->email) {
            session()->flash('error', 'Invalid Name or Email');
            return redirect()->back();
        }
        $user->password = Hash::make($req->password);
        $user->role = 'company';
        $user->mobile = $req->phone_no;
        $check = $user->save();
        if ($check) {
            $store = $req->all();
            $user = User::where('email', $req->email)->first();
            $store['user_id'] = $user->id;
            $company = Company::create($store);
            session()->flash('success', 'Company Added successfully');
            return redirect('/dashboard');
        }
    }
    public function get_companies()
    {
        $data['stores_data'] = Company::with(['user'])->latest()->paginate(10);
        return view('admin.add', $data);
    }
    public function get_edit_company($id)
    {
        $data['company'] = Company::where(['id' => $id])->with('user')->first();
        return view('admin.edit-store', $data);
    }
    public function edit_company(Request $req)
    {
        $company = Company::where('id', $req->id)->first();
        $company->update([
            'name' => $req->name,
            'company_type' => $req->company_type,
            'payment_method' => $req->payment_method,
            'iban' => $req->iban,
            'employee' => $req->employee,
            'valid_till' => $req->valid_till,
            'issued_date' => $req->issued_date,
            'profit_percentage' => $req->profit_percentage,
            'is_active' => $req->is_active
        ]);
        $user = User::where('id', $company->user_id)->first();
        $user->name = $req->name;
        $user->email = $req->email;
        if ($req->password != null) {
            $user->password = Hash::make($req->password);
        }
        $user->mobile = $req->phone_no;
        $user->update();
        session()->flash("success", "Company Updated Successfully");
        return redirect()->back();
    }

    public function disable_company($id)
    {
        $company = Company::where('id', $id)->first();
        $company->is_active = 0;
        $company->update();
        session()->flash("error", "Company De-activated Successfully");
        return redirect()->back();
    }
    public function get_edit_client($id)
    {
        $data['client'] = Client::where('id', $id)->first();
        return view('admin.edit-client', $data);
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

    public function get_receipt($id)
    {
        $data['transaction'] = Client::where('id', $id)->first();
        return view('receipt', $data);
    }
}
