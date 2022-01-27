@extends('dashboard')
@section('content1')
<section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
              <h3 class="text-center">Products</h3>
               <h5 class="h5 mb-0 font-weight-bold text-gray-800 text-center">Active-{{number_format($totalActiveProduct,2)}}</h5>
                <h5 class="h5 mb-0 font-weight-bold text-danger text-center">Inactive-{{number_format($totalInactiveProduct,2)}}</h5>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>       
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 class="text-center">Category<sup style="font-size: 20px"></h3>
                <h5 class="h5 mb-0 font-weight-bold text-gray-800 text-center">Active-{{number_format($totalActiveCategory,2)}}</h5>
                <h5 class="h5 mb-0 font-weight-bold text-danger text-center">Inactive-{{number_format($totalInactiveCategory,2)}}</h5>
              </div>
              <div class="icon">
              <i class="ion ion-pie-graph"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="text-center">Coupons<sup style="font-size: 20px"></h3>
                <h5 class="h5 mb-0 font-weight-bold text-gray-800 text-center">Active-{{number_format($totalActiveCoupons,2)}}</h5>
                <h5 class="h5 mb-0 font-weight-bold text-danger text-center">Inactive-{{number_format($totalInactiveCoupons,2)}}</h5>
              </div>
              <div class="icon">
                <i class="ion ion-box-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-grey">
              <div class="inner">
              <h3 class="text-center">Users<sup style="font-size: 20px"></h3>
                <h5 class="h5 mb-0 font-weight-bold text-gray-800 text-center">Active-{{number_format($totalActiveUser,2)}}</h5>
                <h5 class="h5 mb-0 font-weight-bold text-danger text-center">Inactive-{{number_format($totalInactiveUser,2)}}</h5>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
         
    </section>
@endsection