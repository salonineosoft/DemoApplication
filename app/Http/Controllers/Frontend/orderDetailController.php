<?php
namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Mail\userOrder;
use App\Mail\adminOrder;
use App\Models\orderdetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class orderDetailController extends Controller
{
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=orderdetail::insert([
            "user_email"   => $request->user_email,
            "product_id"   => $request->product_id,
            "price"        => $request->price,
            "quantity"     => $request->quantity,
            "image"        => $request->image,
            "product_name" => $request->product_name,
            "status"       => "pending",
            "payment_mode" => $request->payment_mode,
            "total"        => $request->total
        ]);

         Mail::to($request->user_email)->send(new adminOrder($request->all()));
         Mail::to($request->user_email)->send(new userOrder($request->all()));
        return response()->json(["data"=>$data,"message"=>"sucess"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=orderdetail::where('user_email',$id)->get();
        return response()->json(["order"=>$order]);

    }
   
}
