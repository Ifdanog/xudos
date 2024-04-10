<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Cashier;
use App\Models\Invoices;
use App\Models\Payments;
use App\Models\SystemWallets;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CashierController extends Controller
{
    public function index()
    {
        $storeWallets = [];
        $user_id = Auth::id();
        $cashier = Cashier::where('cashier_id', $user_id) // Replace $cashierId with the ID of the cashier you want to fetch
            ->first();
        $storeId = $cashier->store_id;
        $url = asset('assets/' . Auth()->user()->image);

        $wallet_addresses = SystemWallets::where('store_id', $storeId)->get();
        $currentDate = now()->toDateString();
        $list = Payments::whereDate('created_at', '=', $currentDate)->with('customer')->get();
        return view('cashier.CashierDashboard', compact('url', 'wallet_addresses', 'list'));
    }
    public function storePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|gt:0',
            'chain' => 'required',
            'wallet_address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages(), 'status' => 0], 400);
        } else {
            $user_id = Auth::id();
            $cashier = Cashier::where('cashier_id', $user_id)
                ->first();
            $storeId = $cashier->store_id;
            $wallet_address = $request->input('wallet_address');
            $amount = $request->input('amount');
            $uuid = generateUuidV4();
            $chain = $request->input('chain');

            $reponse = Payments::create([
                'cashier_id' => $user_id,
                'store_id' => $storeId,
                'amount' => $amount,
                'chain' => $chain,
                'status' => 'pending',
                'unique_id' => $uuid,

            ]);
        }
        return response()->json(['message' => 'Payment information stored successfully.', 'payment' => $reponse, 'status' => 1]);
    }
    public function showPrintQrForm(Request $request)
    {
        $qr_query = $request->get('query');
        $json_query = json_decode($qr_query);
        $payment = Payments::where(['unique_id' => $json_query->UUID])
            ->with(['store', 'cashier'])
            ->first();
        return view('cashier.printQrForm', compact('qr_query', 'json_query', 'payment'));
    }
    public function verifyPayment(Request $request)
    {
        $payment = Payments::where(['unique_id' => $request->get('uuid')])
            ->with(['store', 'cashier'])
            ->first();
        $status = $payment->status;
        $customer_id = $payment->customer_id;

        if ($status == 'completed') {
            $invoice = Invoices::create([
                'customer_id' => $customer_id,
                'cashier_id' => Auth::id(),
                'payment_id' => $payment->id,
                'invoice_no' => generateInvoiceId(),
            ]);
            return response()->json(['payment' => $payment, 'invoice' => $invoice, 'status' => 'completed']);
        } else {
            return response()->json(['status' => $payment->status]);
        }
    }

    public function getWalletAddress($chain)
    {
        $wallet = SystemWallets::where('chain', $chain)->first();
        $wallet_address = $wallet->wallet;
        if ($wallet_address) {
            return response()->json(['address' => $wallet_address], 200);
        }
        return response()->json(['error' => 'Wallet not found'], 404);
    }
    public function getProfile(Request $request)
    {
        $url = asset('assets/' . Auth()->user()->image);
        $userId = User::find($request->id);
        return view('cashier.profile', compact('userId', 'url'));
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
            $user = User::find($request->id);
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

            return redirect()->route('cashier.cashier-dashboard');
        }
    }
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|gt:0',
            'password' => 'required|alpha_num|same:confirm_password|min:8|max:20',
            'confirm_password' => 'required|alpha_num|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $user = User::find($request->id);
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();
                session()->flash('success', 'Password has been changed successfully');
                return redirect()->route('cashier.get-profile', ['id' => $request->id]);
            } else {
                 session()->flash('error', 'Please Check your Old Password');
                 return redirect()->route('cashier.get-profile', ['id' => $request->id]);
            }
        }
    }

    function getInvoice(Request $request)
    {
        $request->get('invoice_id');
        $invoice_id = $request->get('invoice_id');
        $invoice = Invoices::where(['invoice_no' => $invoice_id])->first();
        $payment = Payments::where(['id' => $invoice->payment_id])
            ->with(['store', 'cashier'])
            ->first();
        return view('cashier.invoiceForm', ['payment' => $payment, 'invoice' => $invoice]);
    }
    function EditPayment($id, Request $request)
    {
        $url = asset('assets/' . Auth()->user()->image);
        $payment = Payments::where(['id' => $id])->with('Wallets')->first();
        $query = '{"Chain":"' . $payment->chain . '","To":"' . $payment->Wallets->wallet . '","Amount":"' . $payment->amount . '","UUID": "' . $payment->unique_id . '"}';
        return view('cashier.verify', compact('url', 'payment', 'query'));
    }
    function UpdatePayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|gt:0',
            'chain' => 'required',
            'wallet_address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->messages(), 'status' => 0], 400);
        } else {
            $user = User::find($request->id);

            $user->save();
            return redirect()->route('cashier.cashier-dashboard');
        }
    }
    function ApprovePayment(Request $request)
    {
        $Payment = Payments::where(['id' => $request->id])->first();
        if ($Payment) {
            $Payment->status = "completed";
            $Payment->customer_id = 4;
            $Payment->save();
            echo 'payment approved';
        } else {
            echo 'Payment not found';
        }
    }
}
