<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\cms;
use Exception;
use Illuminate\Http\Request;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cmss= cms::latest()->paginate(5);
        return view('Admin.CMS.ShowCms',compact('cmss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.CMS.AddCms');
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
            $validate =   $request->validate([
                'image'  => 'required|mimes:jpg,png,jpeg',
                'title'  => 'required|max:100',
                'body'   => 'required|max:100'
            ]);
            if($validate) {
                $title = $request->title;
                $body = $request->body;
                $filename="Image-".time().".".$request->image->extension();
                if($request->image->move(public_path('uploads'),$filename)){
                    $data         = new cms();

                    /*save data*/
                    $data->title  = $title;
                    $data->body   = $body;
                    $data->image  = $filename;        
                    $data->save();
                    return redirect('/cms')->with('msg','Successfully Inserted data.');
                } else {
                    return back()->with('err','Something went wrong');
                }
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
        $cms=cms::where('id',$id)->first();
        return view('Admin.CMS.EditCms',compact('cms'));
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
                    $data= cms::where('id',$request->uid)->update([
                        'title'  => $request->title,
                        'body'   => $request->body,
                        'image'  => $filename
                    ]);
                }
                return redirect('/cms');
            } else {
                $data= cms::where('id',$request->uid)->update([ 
                    'title' => $request->title,
                    'body'  => $request->body,
                ]);
            }
            return redirect('/cms')->with('msg','Successfully Updated data.'); 
        } catch(Exception $e) {  
            return back()->with('error','Something went wrong');
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
        cms::find($id)->delete();
        return redirect('/cms');
    }
}
