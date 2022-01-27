@extends('dashboard')
@section('content1')
<style>
    .back-btn{
        float: right;
    }
</style>
<div class="bg-white">
    <a  class="back-btn mr-5 mt-4" href="{{url('configrations')}}">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
</svg> Back</a><br><br>
    <h2 class="text-center">Update Email</h2>
    <div class="container">
        <form class="text-center m-auto" enctype="multipart/form-data" action="/configrations/{{$data->id}}" method="post">
            @csrf()
            @method('put')
            @if(Session::has('msg'))
                <label class="alert alert-success col-9 mx-auto">{{Session::get('msg')}}</label>
            @endif
          
            @if($errors->has('notification_email'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('notification_email')}}</div>
            @endif
            <div class="form-group">
                <input type="email" class="form-control col-9  mx-auto" value="{{$data->notification_email}}" name="notification_email"  placeholder="Email">
            </div>
            <div class="form-group">
                <input type="number" class="form-control col-9  mx-auto" value="{{$data->mobile_number}}" name="mobile_number"  placeholder="Mobile Number">
            </div>
            <input type="hidden" name="uid" value="{{$data->id}}"/>
            <div class="form-group">
                <input type="submit" class="btn btn-primary text-center" value="Upadte" >
            </div>
            </form>
    </div>
</div>
@endsection 
