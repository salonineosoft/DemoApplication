<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\banner;
use Exception;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = banner::paginate(5);
        return view('Admin.BannerManagement.ShowBanner',compact('data'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.BannerManagement.AddBanner');
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
            $validatebanner =   $request->validate([
                'image'       => 'required|mimes:jpg,png,jpeg',
                'title'       => 'required|max:500',
                'description' => 'required|max:500'
            ]);
            if($validatebanner) {
                $title = $request->title;
                $description = $request->description;
                $status = "active";
                if($request->status) {
                    $status = $request->status;
                }
                $filename="Image-".time().".".$request->image->extension();
                if($request->image->move(public_path('uploads'),$filename)){
                    $data              = new banner();
            
                    $data->title       = $title;
                    $data->description = $description;
                    $data->status      = $status;
                    $data->image       = $filename;        
                    $data->save();
                    return back()->with('msg','successfully inserted data');
                } else {
                    return back()->with('err','something went wrong');
                }
            }
        } catch (Exception $e) {
            return back()->with('err','something went wrong');
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
        $data = banner::all()->where('id',$id)->first();
        return view('Admin.BannerManagement.EditBanner',compact('data'));
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
            $filename = $request->file('image');
            if ($filename) {
                $filename="Image-".time().".".$request->image->extension();
                if ($request->image->move(public_path('uploads'),$filename)) {
                    $data= banner::where('id',$request->uid)->update([
                        'title'       => $request->title,
                        'description' => $request->description,
                        'status'      => $request->status,
                        'image'       => $filename
                    ]);
                }
                return redirect('/banners');
            } else {
                $data= banner::where('id',$request->uid)->update([ 
                    'title'       => $request->title,
                    'description' => $request->description,
                    'status'      => $request->status,
                ]);
            }
            return back()->with('msg','successfully updated data'); 
        } catch(Exception $e) {  
            return back()->with('error','something went wrong');
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
        $data = banner::find($id)->delete();
        return redirect('/banners');
    }
}
