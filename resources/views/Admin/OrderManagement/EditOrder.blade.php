@extends('dashboard')
@section('content1')
<style>
    .back-btn{
        float: right;
    }
    .radio-btn{
        margin-right: 360px;
    }
</style>
<div class="bg-white">
<a  class="back-btn mt-4 mr-4" href="{{url('ShowOrder')}}">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
</svg> Back</a><br><br>
    <h2 class="text-center">Update Payment Mode</h2><br>
    <div class="container">
        <form class="text-center m-auto" action="/UpdateOrder" method="post">
            @csrf()
           
            @if(Session::has('msg'))
                <label class="alert alert-success col-9 mx-auto">{{Session::get('msg')}}</label>
            @endif
            @if(Session::has('error'))
                <label class="alert alert-danger col-9 mx-auto">{{Session::get('error')}}</label>
            @endif
            <div class="radio-btn">
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input"  name="status" value="active" {{($data->status =="pending")?'checked':''}}>pending
                </label>
                </label>
            </div>
           <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input"   name="status" value="delivered" {{($data->status =="delivered")?'checked':''}}>Delivered
                </label>
           </div>
           <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input"   name="status" value="cancelled" {{($data->status =="cancelled")?'checked':''}}>cancelled
                </label>
           </div>
            </div><br>
            <input type="hidden" name="uid" value="{{$data->id}}"/>
            <div class="form-group">
            <input type="submit" class="btn btn-primary text-center" value="Update">
            </div>
        </form>
    </div>
</div>
@endsection 