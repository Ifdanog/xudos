<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Http\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     * as cashier is logged in, so no cashier id is required in request, instead use auth()->id
     */
    public function getPayments()
    {
        $paymentList = Payments::all();
        return response()->json(['Transactions' => $paymentList], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createPayment(Request $request)
    {
        // remove cashier id from request, as the auth has its id line no 29, 41
        $validator = Validator::make($request->all(), [
            //'cashier_id' => 'required|exists:cashiers,id',
            'customer_id' => 'required|exists:users,id',
            'amount' => 'required',
            'chain' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $paymentId = Str::uuid()->toString();
            $cashier = Payments::create([
                'cashier_id' => auth()->user()->id,
                'customer_id' => $request->customer_id,
                'amount' => $request->amount,
                'chain' => $request->chain,
                'status' => $request->status,
                'unique_id' => $paymentId,

            ]);
            return response()->json([
                'message' => 'store created sucessfully',
                'cashier' => $cashier
            ], 201);
        }
    }

    public function updatePayment(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|gt:0',
            'cashier_id' => 'required',
            'customer_id' => 'required',
            'amount' => 'required',
            'chain' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $payment = Payments::find($request->id);
            $payment->cashier_id = $request->auth()->user()->id;
            $payment->customer_id = $request->customer_id;
            $payment->amount = $request->amount;
            $payment->chain = $request->chain;
            $payment->save();
            return response()->json([
                'message' => 'payment updated sucessfully'
            ], 200);
        }
    }


    public function createInvoice(Request $request)
    {
        $payment = '';
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|exists:payments,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $payment = Payments::find($request->payment_id);

            $cashier = Invoices::create([
                'cashier_id' => auth()->user()->id,
                'payment_id' => $request->payment_id,
                'customer_id' => $payment->customer_id
            ]);
            return response()->json([
                'message' => 'invoice created sucessfully',
                'cashier' => $cashier
            ], 201);
        }
    }

    public function updateInvoice(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|gt:0',
           // 'cashier_id' =>'required|exists:cashiers,id',
            'payment_id' => 'required|exists:payments,id',
            'customer_id' => 'required|exists:users,id',

        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $invoice = Invoices::find($request->id);
            $invoice->cashier_id = auth()->user()->id;
            $invoice->payment_id = $request->payment_id;
            $invoice->customer_id = $request->customer_id;
            $invoice->save();
            return response()->json([
                'message' => 'invoice updated sucessfully'
            ], 200);
        } //
    }

}
