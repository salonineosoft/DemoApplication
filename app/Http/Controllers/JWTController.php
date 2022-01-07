<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class JWTController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register']]);
    }
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'email'       => 'required|string|email|unique:users',
            'password'    => 'required|string|min:8',
            'status'      => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            $user=User::insert([
                'first_name' => $request->first_name,
                'last_name'  => $request->last_name,
                'email'      => $request->email,
                'role_id'    => 5,
                'password'   => Hash::make($request->password),
                'status'     => $request->status
            ]);
            return response()->json([
                'message'=>'User create successfully',
                'user'=>$user
            ],201);
        }
    }
    public function login(Request $request){
        $validator=Validator::make($request->all(),[
            'email'    => 'required|string|email',
            'password' => 'required|string|min:8'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            if(!$token=auth()->guard('api')->attempt($validator->validated())){
               return response()->json(['error'=>'user is Unauthorized,registerd first'],401);
            }
            return $this->respondWithToken($token);
        }
    }
    public function logout(){
        auth()->guard('api')->logout();
        return response()->json(["message"=>"User Logout Successfully"]);
    }
    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
           'expires_in'=>auth()->guard('api')->factory()->getTTL()*60
        ]);
    }
    public function refresh(){
        return $this->responseWithToken(auth()->refresh());
    }
}

