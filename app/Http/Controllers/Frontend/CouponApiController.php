<?php


namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\coupon;
use Illuminate\Http\Request;

class CouponApiController extends Controller
{
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coupon = coupon::where('code',$id)->first();
        if($coupon->status =='active') {
            return response()->json(['coupon' => $coupon ]);
        } else {
            return response()->json(['coupon' => $coupon ]);
        }
    }

}
