<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\coupon;
use Exception;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = coupon::paginate(5);
        return view('Admin.CouponManagement.ShowCoupon',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.CouponManagement.AddCoupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validateCoupons = $request->validate([
                'code'   => 'required|unique:coupons',
                'type'   => 'required',
                'value'  => 'required|numeric',
                'status' => 'required'
            ]);
            if ($validateCoupons) {
                $code   = $request->code;
                $type   = $request->type;
                $value  = $request->value;
                $status = $request->status;
                $data   = new coupon();
            
                /* value store in data*/
                $data->code   = $code;
                $data->type   = $type;
                $data->value  = $value;
                $data->status = $status;
                $data->save(); 
                return back()->with('msg','successfully added'); 
            }
        } catch (Exception $e) {
            return back()->with('err','Something went wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = coupon::all()->where('id',$id)->first();
        return view('Admin.CouponManagement.EditCoupon',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $validateCoupon = $request->validate([
                'code'   => 'required',
                'value'  => 'required',
                'status' => 'required',
                'type'   => 'required'
            ]);
       
            if ($validateCoupon) {
                $data= coupon::where('id',$request->uid)->update([
                    'code'   => $request->code,
                    'value'  => $request->value,
                    'status' => $request->status,
                    'type'   => $request->type
                ]);
                return back()->with('msg',' Coupon code successfully updateded.');
            }
        } catch (Exception $e) {
            return back()->with('err','Something went wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        coupon::find($id)->delete();
        return redirect('coupons');
    }
}
