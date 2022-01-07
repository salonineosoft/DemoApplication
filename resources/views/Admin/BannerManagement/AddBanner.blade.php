@extends('dashboard')
@section('content1')
<style>
    .back-btn{
        float: right;
    }
    .radio-btn{
        margin-right: 349px;
    }
</style>
<div class="bg-white">
<a  class="back-btn mr-5 mt-4" href="{{url('banners')}}">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
</svg> Back</a><br><br>
    <h2 class="text-center">Add Banner</h2>
    <div class="container">
        <form class="text-center m-auto" action="/banners" method="post" enctype="multipart/form-data">
            @csrf()
            @if(Session::has('msg'))
                <label class="alert alert-success col-9 mx-auto">{{Session::get('msg')}}</label>
            @endif
            @if(Session::has('err'))
                <label class="alert alert-danger col-9 mx-auto">{{Session::get('err')}}</label>
            @endif
            @if($errors->has('title'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('title')}}</div>
            @endif
            <div class="form-group">
                <input type="text" class="form-control col-9 mx-auto" name="title"  placeholder="Title">
            </div>
            @if($errors->has('description'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('description')}}</div>
            @endif
            <div class="form-group">
                <input type="text" class="form-control col-9  mx-auto" name="description" placeholder="Description">
            </div>
            @if($errors->has('image'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('image')}}</div>
            @endif
            <div class="form-group">
                <input type="file" class="form-control col-9  mx-auto" name="image">
            </div>
            <div class="radio-btn">
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="status" value="active">active
                </label>
            </div>
           <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="status" value="inactive">inactive
                </label>
           </div>
            </div><br>
            <div class="form-group">
                    <input type="submit" class="btn btn-primary text-center" value="submit" >
            </div>
        </form>
    </div>
</div>
@endsection 

