<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = category::paginate(5);
      
        return view('Admin.CategoryManagement.ShowCategory', compact('data'));
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.CategoryManagement.AddCategory');
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
            $validateCategory = $request->validate([
            
                'name'        => 'required|unique:categories',
                'description' => 'required|max:300',
                'status'      => 'required'
            ]);

            if ($validateCategory) {
                $name        = $request->name;
                $description = $request->description;
                $status      = $request->status;
                $data        = new category();
                
            
                    /*store value*/
                $data->name        = $name;
                $data->description = $description;
                $data->status      = $status;  
                
                /*save data*/
                $data->save();
                return back()->with('msg','Successfully inserted');
            }
        } catch (Exception $e) {  
            return back()->with('error','something went wrong');
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
        $data = category::all()->where('id',$id)->first();
        return view('Admin.CategoryManagement.EditCategory',compact('data'));
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
            $validatecategory = $request->validate([
                'name'        => 'required',
                'description' => 'required',
                'status'      => 'required'
            ]);
            
            if ($validatecategory) {
                $data= category::where('id',$request->uid)->update([
                    'name'        => $request->name,
                    'description' => $request->description,
                    'status'      => $request->status
                ]);
                return back()->with('msg','successfully updated data');
            } 
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
        $data = category::find($id)->delete();
        return redirect('/categories');
    }
}
