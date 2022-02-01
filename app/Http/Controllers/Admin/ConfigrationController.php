<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Configration;
use Illuminate\Http\Request;

class ConfigrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Configration::all();
        return view('Admin.ConfigrationManagement.ShowEmail',compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.ConfigrationManagement.AddEmail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Configration::all()->where('id',$id)->first();
        return view('Admin.ConfigrationManagement.EditEmail',compact('data'));
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
        $validateEmail = $request->validate([
            'notification_email'  => 'required',
            'mobile_number'       => 'required',
        ]);
        if ($validateEmail) {
            $data= Configration::where('id',$request->uid)->update([
                'notification_email' => $request->notification_email,
                'mobile_number'      => $request->mobile_number,
            ]);
        }
       return redirect('/configrations')->with('msg','successfully updated data');
    }
}
