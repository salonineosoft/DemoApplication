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
      <th scope="col">Product Name</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">status</th>
      <th scope="col">Payment Mode</th>
      <th scope="col">Total</th>
      <th scope="col">Action</th>
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
      <td>{{$i->product_name}}</td>
      <td>&#x20B9;{{$i->price}}.00</td>
      <td>{{$i->quantity}}</td>
      <td>
      @if($i->status=="cancelled")
      <span class="badge badge-danger">{{$i->status}}</span>
      @elseif($i->status=="pending")
      <span class="badge badge-primary">{{$i->status}}</span>
      @else
      <span class="badge badge-success">{{$i->status}}</span>
      @endif
      </td>
      <td>{{$i->payment_mode}}</td>
      <td>&#x20B9;{{$i->total}}.00</td>
      <td>
        <a href="/EditOrder/{{$i->id}}" class="btn btn-success"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
        </svg></a></td>
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
