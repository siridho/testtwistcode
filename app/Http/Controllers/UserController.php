<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use JWTFactory;
use JWTAuth;
use Validator;
use Response;
use Cookie;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_hp' => 'required|string|max:15|unique:users',
            'name' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $data=$request->all();
        $data['password']=bcrypt($request->password);
        $user=User::create($data);
        $user = User::first();
        $token = JWTAuth::fromUser($user);
        
        return Response::json(compact('token',"user"));
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'no_hp' => 'required|string|max:15',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
        $credentials = $request->only('no_hp', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
            	$error=array("error"=>'invalid credentials');
         		return response()->json($error);   	
                // return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
        	$error=array("error"=>'could not create token');
         		return response()->json($error);
            // return response()->json(['error' => 'could_not_create_token'], 500);
        }
        $user=User::whereNoHp($request->no_hp)->first();
        // Cookie::queue("Authorization", "Bearer ".$token, 10);
         return response()->json(compact('token',"user"));
       // return response()->redirectTo('api/product')
        //->header('Authorization',"Bearer ".$token);
    }
}
