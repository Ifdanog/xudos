<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Systemwallets;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
       $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->messages(), 400);
           }else{
            DB::beginTransaction();
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'remember_token' => sendmail(132),
            ];
            try{
                $user = User::create($data);

                if($user->role != 'cashier'){
                    bsc_wallet_create($user);
                    tether_wallet_create($user);
                }
                DB::commit();
            }catch(\Exception $e){
                DB::rollBack();
                p($e->getMessage());
                $user = null;
            }
            if($user != null){

                return response()->json([
                    'message' => 'user registered sucessfully'
                ], 200);
            }else{
                return response()->json([
                    'message' => 'internal server error'
                ], 500);
            }
           }

}

function verify_user(Request $request) {
    // veification code
    // user where
    // status = 1
    // return success
    
}
}
