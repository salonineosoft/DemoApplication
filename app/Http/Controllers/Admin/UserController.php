<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\user;
use App\Models\role;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = user::where('email','!=','admin@gmail.com')->paginate(5);
        return view('Admin.UserManagement.showuser',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = role::all()->where('id','!=',1);
        return view('Admin.UserManagement.AddUser',compact('data'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateuser = $request->validate([
            'name'            => 'required',
            'lastName'        => 'required',
            'email'           => 'required|unique:users',
            'password'        => 'required|max:12|min:8',
            'ConfirmPassword' => 'required|same:password',
            'role'            => 'required',
            'status'          => 'required'
       ]);
       if ($validateuser){
            $name            = $request->name;
            $lastName        = $request->lastName;
            $email           = $request->email;
            $password        = $request->password;
            $ConfirmPassword = $request->ConfirmPassword;
            $role            = $request->role;
            $status          = $request->status; 
            $data            = new User();
        try{
            /*store data*/
            $data->first_name = $name;
            $data->last_name  = $lastName;
            $data->email      = $email;
            $data->password   = $password;
            $data->role_id    = $role;
            $data->status     = $status;
            $data->save();
                return back()->with('msg','successfully added');
        } catch (Exception $e) {
                return back()->with('err','uploading error');
            }
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
        $role = role::all();
        $data = user::all()->where('id',$id)->first();
        return view('Admin.UserManagement.EditUser',compact('data','role'));
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
        $validateUser = $request->validate([
            'name'     => 'required|max:10',
            'lastName' => 'required|max:10',
            'email'    => 'required',
            'status'   => 'required'
        ]);
        try{
            if ($validateUser) {
                $data= user::where('id',$request->uid)->update([
                    'first_name' => $request->name,
                    'last_name'  => $request->lastName,
                    'email'      => $request->email,
                    'status'     => $request->status
                ]);
                return back()->with('msg','successfully updated data');
            }
        } catch(Exception $e) {
            return back()->with('err','something went wrong');
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
        $data = user::find($id)->delete();
        return redirect('/users');
    }
}
