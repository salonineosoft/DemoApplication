@extends('dashboard')
@section('content1')
<div class="bg-white">
<style>
   .btn{
    float: right;
    }
    .container{
      background-color: white;
    }
</style>
     <div class="container">
    <h2 class="text-center">Orders</h2>
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">User Email</th>
      <th scope="col">Product Id</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>
      @php
       $sn=1;
      @endphp
      @foreach($order as $i)
    <tr>
      <td>{{$sn}}</td>
      <td>{{$i->user_email}}</td>
      <td>{{$i->product_id}}</td>
      <td>{{$i->price}}</td>
      <td>{{$i->quantity}}</td>
      <td>{{$i->total}}</td>
  <!-----endmodal--------->
      </td>
      @php
     $sn++;
  @endphp
    </tr> 
    @endforeach
</tbody>
</table>
{{$order->links("pagination::bootstrap-4")}}
  </div><br><br>
</div>
@endsection
