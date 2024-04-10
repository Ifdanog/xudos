<?php

namespace App\Http\Controllers;

use App\Models\Payments;
use App\Models\User;
use App\Models\Wallets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function getWallets(Request $request)
    {
        $wallet = Wallets::where('user_id', Auth::user()->id)->first();
        return response()->json(['wallets'=> $wallet ], 200);
    }
    public function getPayments(Request $request)
    {
        $paymentList = Payments::where('user_id', Auth::user()->id)->first();
        return response()->json(['Transactions'=> $paymentList ], 200);
    }

}
