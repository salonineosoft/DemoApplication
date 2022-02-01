<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\orderdetail;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /* Function For ShowOrder */

    public function order()
    {
    $order = orderdetail::paginate(5);
    return view('Admin.OrderManagement.ShowOrder',compact('order'));
    }

    /* Function For Edit */

    public function edit($id)
    {
        $data = orderdetail::all()->where('id',$id)->first();
        return view('Admin.OrderManagement.EditOrder',compact('data'));
    }

    /* Function For Update Data */

    public function update(Request $request)
    {
        $data= orderdetail::where('id',$request->uid)->update([
        
            'status' => $request->status,
        ]);
        return redirect('/ShowOrder')->with('msg','Successfully Updated.');
    }
}
