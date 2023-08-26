<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Penulis;
use Hash;
use Validator;
use Auth;

class LoginController extends Controller
{
/**
     * Write code on Method
     *
     * @return response()
     */
    public function userDashboard()
    {
        $users = User::where('id',Auth::user()->id)->first();
        $success =  $users;

        return response()->json($success, 200);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function penulisDashboard()
    {
        $users = Penulis::where('id',Auth::user()->id)->first();
        $success =  $users;

        return response()->json($success, 200);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('user')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'user']);
            
            $user = User::select('users.*')->find(auth()->guard('user')->user()->id);
            $success =  $user;
            $success['token'] =  $user->createToken('MyApp',['user'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function penulisLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()->all()]);
        }

        if(auth()->guard('penulis')->attempt(['email' => request('email'), 'password' => request('password')])){

            config(['auth.guards.api.provider' => 'penulis']);
            
            $penulis = Penulis::select('penulis.*')->find(auth()->guard('penulis')->user()->id);
            $success =  $penulis;
            $success['token'] =  $penulis->createToken('MyApp',['penulis'])->accessToken; 

            return response()->json($success, 200);
        }else{ 
            return response()->json(['error' => ['Email and Password are Wrong.']], 200);
        }
    }
}