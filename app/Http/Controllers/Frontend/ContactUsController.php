<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\contactus;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactToAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'          => 'required|string',
            'email'         => 'required|string|email|unique:contactus',
            'message'       => 'required|string|max:40',
            'mobile_number' => 'required',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors());
        }
        else {
            $contact=contactus::insert([
                'name'          => $request->name,
                'email'         => $request->email,
                'message'       => $request->message,
                'mobile_number' => $request->mobile_number,
            ]);
            Mail::to($request->email)->send(new ContactToAdmin($request->all()));
            return response()->json([
                'message'=>'contact create successfully',
                'contact'=>$contact
            ],201);
        }
    
    }
}
