 @extends('dashboard')
@section('content1')
<style>
    .back-btn{
        float:right;
    }
    .radio-btn{
        margin-right:385px;
    }
    .image{
        margin-right:230px;
    }
</style>
<div class="bg-white">
<a  class="back-btn mr-5 mt-4" href="{{url('products')}}">
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-return-left" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14.5 1.5a.5.5 0 0 1 .5.5v4.8a2.5 2.5 0 0 1-2.5 2.5H2.707l3.347 3.346a.5.5 0 0 1-.708.708l-4.2-4.2a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 8.3H12.5A1.5 1.5 0 0 0 14 6.8V2a.5.5 0 0 1 .5-.5z"/>
</svg> Back</a><br><br>
    <h2 class="text-center">Edit Product</h2>
    <div class="container">
        <form class="text-center m-auto" action="/products/{{$data->id}}" method="Post" enctype="multipart/form-data">
            @csrf()
            @method('put')
            @if(Session::has('msg'))
                <label class="alert alert-success col-9 mx-auto">{{Session::get('msg')}}</label>
            @endif
            <select class="form-control col-9 mx-auto" name="category">
                <option value="">Category</option>
            @foreach($category as $i)
                <option value="{{$i->id}}">{{$i->name}}</option>
            @endforeach
            </select><br> 
            @if($errors->has('name'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('name')}}</div>
            @endif
            <div class="form-group">
                <input type="text" class="form-control col-9 mx-auto" name="name" value="{{$data->name}}" placeholder="Name">
            </div>
            @if($errors->has('description'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('description')}}</div>
            @endif
            <div class="form-group">
                <input type="text" class="form-control col-9  mx-auto" name="description" value="{{$data->description}}"  placeholder="Description">
            </div>
            @if($errors->has('quantity'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('quantity')}}</div>
            @endif
            <div class="form-group">
                <input type="number" class="form-control col-9  mx-auto" name="quantity" value="{{$data->quantity}}" placeholder="Quantity">
            </div>
            @if($errors->has('price'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('price')}}</div>
            @endif
            <div class="form-group">
                <input type="number" class="form-control col-9  mx-auto" name="price" value="{{$data->price}}" placeholder="Price">
            </div>
            @if($errors->has('sale_price'))
                <div class="alert alert-danger col-9 mx-auto">{{$errors->first('sale_price')}}</div>
            @endif
            <div class="form-group">
                <input type="number" class="form-control col-9  mx-auto" name="sale_price" value="{{$data->sale_price}}" placeholder="Sale_Price">
            </div>
            <div class="radio-btn">
            <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="status"  value="active" {{($data->status =="active")?'checked':''}}>active
                </label>
            </div>
           <div class="form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="status"  value="inactive" {{($data->status =="inactive")?'checked':''}}>inactive
                </label>
           </div>
            </div><br>
            <div class="image">
                <input type="file" name="image[]"multiple>
            <br><br> 
            @foreach($product_image as $image)
             <img src="{{url('uploads/' .$image->image)}}" width="100px">
                <a href="/Image/{{$image->id}}">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                </svg></a>
            @endforeach 
            </div>
                <input type="hidden" name="uid" value="{{$data->id}}"/> 
            <div class="form-group">
                <input type="submit" class="btn btn-primary text-center" value="Update" >
            </div>
        </form>
    </div>
</div>
@endsection 
 

 