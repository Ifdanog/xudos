<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Invoices;
use App\Models\Payments;
use App\Models\Stores;
use App\Models\User;
use App\Models\Wallets;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SuperuserController extends Controller
{

    public function getUsers()
    {
        $users = User::all();
        return response()->json(['Users' => $users], 200);
    }
    public function updateUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|gt:0',
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:8'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json([
                'message' => 'user updated sucessfully'
            ], 200);
        }
    }
    public function getWallets()
    {
        $wallet = Wallets::all();
        return response()->json(['Wallets' => $wallet], 200);
    }
    public function getStores()
    {
        $stores = Stores::all();
        return response()->json(['Stores' => $stores], 200);
    }

    public function createStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:stores',
            'mobile' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            DB::beginTransaction();
            try {
                $store = Stores::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile' => $request->mobile
                ]);
                //wallet create
                if ($store) {
                    SystemWallets($store);
                    tether_systemWallet_create($store);
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                p($e->getMessage());
                // $store = null;
                //  dd($store);
            }
            if ($store != null) {

                return response()->json([
                    'message' => 'store created sucessfully'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'internal server error'
                ], 500);
            }
        }
    }
    public function updateStores(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|gt:0',
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $store = Stores::find($request->id);
            $store->name = $request->name;
            $store->email = $request->email;
            $store->mobile = $request->mobile;
            $store->save();
            return response()->json([
                'message' => 'store updated sucessfully'
            ], 200);
        }
    }
    public function deleteStores(string $id)
    {
        $store = Stores::find($id);
        if (is_null($store)) {
            return response()->json([
                "message" => "store doesn't exist",
                "status" => 0
            ]);
        } else {

            $store->delete();
            return response()->json([
                'message' => 'store deleted sucessfully', 'status' => 1
            ], 200);
        }
    }

    public function createCashier(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|alpha|min:4|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|alpha_num|min:8|max:20',
            'role' => 'required|string|alpha',
            'store_id' => 'required|exists:stores,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            DB::beginTransaction();
            try{
            // create user with cashier details, cashier_id will be the id of the newly created user.
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => hash::make($request->password),
                'role' => $request->role,
            ]);
           // dd($user_id);
            $cashier = Cashier::create([
                'store_id' => $request->store_id,
                'cashier_id' => $user->id,

            ]);
            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
            p($e->getMessage());
            $cashier = null;
        }
        if($cashier != null){
            return response()->json([
                'message' => 'Cashier is created sucessfully',
                'cashier' => $cashier
            ], 200);
        }else{
            return response()->json([
                'message' => 'internal server error'
            ], 500);

        }
        }
    }

    public function updateCashier(Request $request, string $id)
    {

        $validator = Validator::make($request->all(), [
            'id' => 'required|gt:0',
            'name' => 'required|string|alpha|min:4|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|alpha_num|min:8|max:20',
            'store_id' => 'required|exists:stores,id',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        } else {
            $cashier = Cashier::find($request->id);
            $cashier->store_id = $request->store_id;
            $cashier->save();
            $user = User::find($cashier->cashier_id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = $request->password;
            $user->save();
            return response()->json([
                'message' => 'Cashier updated sucessfully'
            ], 200);
        }
    }
    public function deleteCashier(string $id)
    {
        $cashier = Cashier::find($id);
        if (is_null($cashier)) {
            return response()->json([
                "message" => "cashier doesn't exist",
                "status" => 0
            ]);
        } else {

            $cashier->delete();
            return response()->json([
                'message' => 'cashier deleted sucessfully', 'status' => 1
            ], 200);
        }
    }
    public function getPaymentlist()
    {
        $payments = Payments::all();
        return response()->json(['Transaction' => $payments], 200);
    }
    public function getInvoices()
    {
        $invoices = Invoices::all();
        return response()->json(['Transaction' => $invoices], 200);
    }
}
