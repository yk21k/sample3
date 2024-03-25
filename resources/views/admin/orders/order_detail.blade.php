@php use App\Models\Product; @endphp
@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Orders #{{ $orderDetails['id'] }} Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Order Summary</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <!-- <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead> -->
                  <tbody>
                    <tr>
                      <td>Order ID</td>
                      <td>{{ $orderDetails['id'] }}</td>
                    </tr>
                    <tr>
                      <td>Order Status</td>
                      <td>{{ $orderDetails['order_status'] }}</td>
                    </tr>
                    <tr>
                      <td>Order Total</td>
                      <td>{{ $orderDetails['grand_total'] }}</td>
                    </tr>
                    <tr>
                      <td>Shipping Charge</td>
                      <td>{{ $orderDetails['shipping_charges'] }}</td>
                    </tr>
                    <tr>
                      <td>Coupon Code</td>
                      <td>{{ $orderDetails['coupon_code'] }}</td>
                    </tr>
                    <tr>
                      <td>Coupon Amount</td>
                      <td>{{ $orderDetails['coupon_amount'] }}</td>
                    </tr>
                    <tr>
                      <td>Payment Method</td>
                      <td>{{ $orderDetails['payment_method'] }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>  
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Billing/Customer Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <!-- <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead> -->
                  <tbody>
                    <tr>
                      <td>Name</td>
                      <td>{{ $orderDetails['id'] }}</td>
                    </tr>
                    <tr>
                      <td>Address</td>
                      <td>{{ $orderDetails['user']['name'] }}</td>
                    </tr>
                    <tr>
                      <td>Email</td>
                      <td>{{ $orderDetails['user']['email'] }}</td>
                    </tr>
                    <tr>
                      <td>Shipping Charge</td>
                      <td>{{ $orderDetails['shipping_charges'] }}</td>
                    </tr>
                    <tr>
                      <td>Coupon Code</td>
                      <td>{{ $orderDetails['coupon_code'] }}</td>
                    </tr>
                    <tr>
                      <td>Coupon Amount</td>
                      <td>{{ $orderDetails['coupon_amount'] }}</td>
                    </tr>
                    <tr>
                      <td>Payment Method</td>
                      <td>{{ $orderDetails['payment_method'] }}</td>
                    </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Billing Address</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <!-- <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead> -->
                  <tbody>
                    <tr>
                      <td>Name</td>
                      <td>{{ $orderDetails['user']['name'] }}</td>
                    </tr>
                    <tr>
                      <td>Address</td>
                      <td>{{ $orderDetails['user']['address'] }}</td>
                    </tr>
                    <tr>
                      <td>City</td>
                      <td>{{ $orderDetails['user']['city'] }}</td>
                    </tr>
                    <tr>
                      <td>State</td>
                      <td>{{ $orderDetails['user']['state']  }}</td>
                    </tr>
                    <tr>
                      <td>Country</td>
                      <td>{{ $orderDetails['user']['country']  }}</td>
                    </tr>
                    <tr>
                      <td>Pincode</td>
                      <td>{{ $orderDetails['user']['pincode']  }}</td>
                    </tr>
                    <tr>
                      <td>Payment Method</td>
                      <td>{{ $orderDetails['payment_method']  }}</td>
                    </tr>
                    <tr>
                      <td>Mobile</td>
                      <td>{{ $orderDetails['mobile']  }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Delivelly Address</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <!-- <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead> -->
                  <tbody>
                    <tr>
                      <td>Name</td>
                      <td>{{ $orderDetails['user']['name'] }}</td>
                    </tr>
                    <tr>
                      <td>Address</td>
                      <td>{{ $orderDetails['user']['address'] }}</td>
                    </tr>
                    <tr>
                      <td>City</td>
                      <td>{{ $orderDetails['user']['city'] }}</td>
                    </tr>
                    <tr>
                      <td>State</td>
                      <td>{{ $orderDetails['user']['state']  }}</td>
                    </tr>
                    <tr>
                      <td>Country</td>
                      <td>{{ $orderDetails['user']['country']  }}</td>
                    </tr>
                    <tr>
                      <td>Pincode</td>
                      <td>{{ $orderDetails['user']['pincode']  }}</td>
                    </tr>
                    <tr>
                      <td>Payment Method</td>
                      <td>{{ $orderDetails['payment_method']  }}</td>
                    </tr>
                    <tr>
                      <td>Mobile</td>
                      <td>{{ $orderDetails['mobile']  }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Update Order Status</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <!-- <thead>                  
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Task</th>
                      <th>Progress</th>
                      <th style="width: 40px">Label</th>
                    </tr>
                  </thead> -->
                  <tbody>
                    <tr>
                      <td>Select Status</td>
                      <td><button>Update</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Ordered Products</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Product Image</th>
                      <th>Product Code</th>
                      <th>Product Name</th>
                      <th>Product Size</th>
                      <th>Product Color</th>
                      <th>Product Qty</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($orderDetails['orders_products'] as $product)
                    @php $getProductImage = Product::getProductImage($product['product_id']) @endphp
                    <tr>
                      <td>
                        @php 
                          $getProductImage = Product::getProductImage($product['product_id'])
                        @endphp
                        @if($getProductImage!="")
                          <a target="_blank" href="{{ url('product/'.$product['product_id']) }}"><img style="width: 80px;" src="{{ asset('front/images/products/small/'.$getProductImage) }}" alt=""></a>
                        @else
                          <a target="_blank" href="{{ url('product/'.$product['product_id']) }}"><img style="width: 80px;" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">  
                        @endif
                      </td>
                      <td>{{ $product['product_code'] }}</td>
                      <td>{{ $product['product_name'] }}</td>
                      <td>{{ $product['product_size'] }}</td>
                      <td>{{ $product['product_color'] }}</td>
                      <td>{{ $product['product_qty'] }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Fixed Header Table</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>User</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Reason</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>183</td>
                      <td>John Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-success">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>219</td>
                      <td>Alexander Pierce</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-warning">Pending</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>657</td>
                      <td>Bob Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-primary">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>175</td>
                      <td>Mike Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-danger">Denied</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>134</td>
                      <td>Jim Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-success">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>494</td>
                      <td>Victoria Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-warning">Pending</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>832</td>
                      <td>Michael Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-primary">Approved</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                    <tr>
                      <td>982</td>
                      <td>Rocky Doe</td>
                      <td>11-7-2014</td>
                      <td><span class="tag tag-danger">Denied</span></td>
                      <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection  