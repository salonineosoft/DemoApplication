<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\configration;
use App\Mail\userRegister;
use App\Mail\adminRegister;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class JWTController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register']]);
    }

    /* Function For User-Register*/
    /* inserting Data with Proper validations*/
    /* After Successfully Registered it Will Recived Mail*/
    public function register(Request $request){
        $validator=Validator::make($request->all(),[
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'email'       => 'required|string|email',
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
                'status'     => "active"
            ]);
            Mail::to($request->email)->send(new userRegister($request->all()));
            Mail::to($request->email)->send(new adminRegister($request->all()));
            return response()->json([
                'message'=>'User Create Successfully',
                'user'=>$user
            ],201);
        }
    }

    /* Function For Login */

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
           return response()->json(['access_token' => $token, "email" => $request->email], 200);
        }
    }

    /* Function For Logout*/

    public function logout(){
        auth()->guard('api')->logout();
        return response()->json(["message"=>"User Logout Successfully"]);
    }
    protected function respondWithToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
           'expires_in'    => auth()->guard('api')->factory()->getTTL()*60
        ]);
    }

    /* Fuction For Refresh */

    public function refresh(){
        return $this->responseWithToken(auth()->guard('api')->refresh());
    }

    public function profile(){
        $profile=auth('api')->user();
        return response()->json(['profile'=>$profile]);
    }

    /* Function For Update Profile */
    public function updateProfile(Request $request){
        $validator=Validator::make($request->all(),[
            'first_name' => 'required|min:2|alpha',
            'last_name'  => 'required|min:2|alpha',
            'email'      => 'required|email',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            $user=User::find($request->user()->id);
                $user->first_name = $request->first_name;
                $user->last_name  = $request->last_name;
                $user->email      = $request->email;
                $user->update();
            return response()->json([
                'message'        => "Profile Updated Successfully",
                'updatedprofile' => $user
            ]);
        }
     }
    
     /* Function For ChangePassword */

     public function changepassword(Request $request) {
     $validator=Validator::make($request->all(),[
        'old_password'     => 'required',
        'new_password'     => 'required',
        'confirm_password' => 'required|same:new_password',

    ]);
    if($validator->fails()){
        return response()->json($validator->errors());
    }
    else {
        $user=$request->User();
        if(Hash::check($request->old_password,$user->password)){
           $user->update([
               'password'=>Hash::make($request->new_password)
           ]);
           return response()->json([
            'message' => "Password Successfully Updated",
            'status'  => 1
            ],200);
        }
       else{
            return response()->json([
                'message'=>"Old Password does not Match.",
            ],400);
       }
    }
    return response()->json([
        'message'  => "Password Successfully Updated",
        'status'   => 1
    ]);
}

    /* Function For Configrations */
    public function configration()
    {
        $configration=configration::all();
        return response()->json($configration);

    }

}

