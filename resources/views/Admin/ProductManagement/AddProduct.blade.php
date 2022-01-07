@extends('dashboard')
@section('content1')
<style>
    .back-btn{
        float: right;
    }
    .radio-btn{
        margin-right: 361px;
    }
    .image{
        margin-right:240px;
    }
</style>
<div class="bg-white">
    <a  class="back-btn mr-5 mt-4" href="{{url('products')}}">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
</svg> Back</a><br><br>
    <h2 class="text-center">Add Product</h2><br>
    <div class="container">
        <form class="text-center m-auto" enctype="multipart/form-data" action="/products" method="post">
            @csrf()
            @if(Session::has('msg'))
                <label class="alert alert-success col-9 mx-auto">{{Session::get('msg')}}</label>
            @endif
            @if($errors->has('category'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('category')}}</div>
            @endif
            <select class="form-control col-9 mx-auto" name="category">
                <option>Category</option>
            @foreach($data as $i)
                <option value="{{$i->id}}">{{$i->name}}</option>
            @endforeach
            </select><br> 
            @if($errors->has('name'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('name')}}</div>
            @endif
            <div class="form-group">
                <input type="text" class="form-control col-9 mx-auto" name="name" placeholder="Name">
            </div>
            @if($errors->has('description'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('description')}}</div>
            @endif
            <div class="form-group">
                <input type="text" class="form-control col-9  mx-auto" name="description"  placeholder="Description">
            </div>
            @if($errors->has('quantity'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('quantity')}}</div>
            @endif
            <div class="form-group">
                <input type="number" class="form-control col-9  mx-auto" name="quantity"  placeholder="Quantity">
            </div>
            @if($errors->has('price'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('price')}}</div>
            @endif
            <div class="form-group">
                <input type="number" class="form-control col-9  mx-auto" name="price"  placeholder="Price">
            </div>
            @if($errors->has('sale_price'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('sale_price')}}</div>
            @endif
            <div class="form-group">
                <input type="number" class="form-control col-9  mx-auto" name="sale_price"  placeholder="Sale_Price">
            </div>
            @if($errors->has('status'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('status')}}</div>
            @endif
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
<!---Products Images----->     
            <div class="image">
            @if($errors->has('image'))
            <div class="alert alert-danger">{{$errors->first('image')}}</div>
            @endif
                <input type="file" name="image[]"multiple>
            </div><br>
            <div class="form-group">
                <input type="submit" class="btn btn-primary text-center" value="submit" >
            </div>
            </form>
    </div>
</div>
@endsection 

