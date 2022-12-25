<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Hash;

class authTokensController extends Controller
{
    public function store(Request $request){
        $request->validate([
         'email' => 'required',
         'password' => 'required',
         'name' => 'required',
        ]);

        $user = user::where('email',$request->email)->first();
        
        if($user && Hash::check($request->password ,$user->password)){
            $token = $user->createToken($request->name,['*']);
             return response()->json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ],201);
        }else{
            return response()->json([
                'message' => 'invald'
            ],401);
        }

    }
}
