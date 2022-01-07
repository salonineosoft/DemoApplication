@extends('dashboard')
@section('content1')
<style>
    .back-btn{
        float: right;
    }
    .radio-btn{
        margin-right: 345px;
    }
</style>
<div class="bg-white">
<a  class="back-btn ml-5 mt-4" href="{{url('banners')}}">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
</svg> Back</a><br><br>
<style>
.image{
    margin-right:430px;
}
</style>
    <h2 class="text-center">Update Banner</h2>
    <div class="container">
        <form class="text-center m-auto" action="/banners/{{$data->id}}" method="post" enctype="multipart/form-data">
            @csrf()
            @method('put')
            @if(Session::has('msg'))
                <label class="alert alert-success col-9 mx-auto">{{Session::get('msg')}}</label>
            @endif
            <div class="form-group">
                <input type="text" class="form-control col-9 mx-auto" name="title" value="{{$data->title}}"  placeholder="Title">
            </div>
            <div class="form-group">
                <input type="text" class="form-control col-9  mx-auto" name="description" value="{{$data->description}}" placeholder="Description">
            </div>
            <div class="form-group">
                <input type="file" class="form-control col-9   mx-auto" name="image">
            </div>
            <div class="form-group">
                 <img src='{{url("uploads/$data->image")}}' class="image" width="85px">
            </div>
            <div class="radio-btn">
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="{{$data->status}}" name="status" value="active" {{($data->status =="active")?'checked':''}}>active
                </label>
            </div>
           <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" value="{{$data->status}}" name="status" value="inactive" {{($data->status =="inactive")?'checked':''}}>
                </label>inactive
                </label>
           </div>
            </div><br>
            <input type="hidden" name="uid" value="{{$data->id}}"/>
            <div class="form-group">
                   <input type="submit" class="btn btn-primary text-center" value="Update" >
            </div>
        </form>
    </div>
</div>
@endsection 

