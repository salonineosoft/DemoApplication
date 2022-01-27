<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\userdetail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Exception;
class UserDetailController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'email'       => 'required|string',
            'address'     => 'required|string|max:100',
            'mobile'      => 'required',
            'city'        => 'required',
            'pin_code'    => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            $orderDetail=userdetail::insert([
                'first_name'  => $request->first_name,
                'last_name'   => $request->last_name,
                'email'       => $request->email,
                'address'     => $request->address,
                'mobile'      => $request->mobile,
                'city'        => $request->city,
                'pin_code'    => $request->pin_code,
            ]);
            return response()->json([
                'userdetail'=>$orderDetail
            ],201);
        }
    
    }

}
