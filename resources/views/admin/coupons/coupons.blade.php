@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Coupons</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Coupons</li>
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
          <div class="col-12">
            @if(Session::has('success_message'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success:</strong> {{ Session::get('success_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="card">
              @if($couponsModule['edit_access']==1 || $couponsModule['full_access']==1)
                <div class="card-header">
                  <h3 class="card-title">Coupons</h3>
                  <a style="max-width: 150px; float:right; display:inline-block; "href="{{ url('admin/add-edit-coupon') }}" class="btn btn-block btn-info">Add COUPON</a>
                </div>
              @endif  
              <!-- /.card-header -->
              <div class="card-body">
                <table id="coupons" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Coupon Type</th>
                    <th>Amount</th>
                    <th>Expiry Date</th>
                    <th>Created on</th>
                    <th>Updated</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($coupons as $coupon)
                    <tr>
                      <td>{{ $coupon['id'] }}</td>
                      <td>
                          {{ $coupon['coupon_code'] }}
                      </td>
                      <td>
                          {{ $coupon['coupon_type'] }}
                      </td>
                      <td>{{ $coupon['amount'] }}
                        @if($coupon['amount']=="Percentage") % @else INR @endif
                      </td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($coupon['expiry_date'])); }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($coupon['created_at'])); }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($coupon['updated_at'])); }}</td>
                      <td>
                        @if($couponsModule['edit_access']==1 || $couponsModule['full_access']==1)
                          @if($coupon['status']==1)
                            <a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" style="color: #078aed;" status="Active"></i></a>
                          @else
                            <a class="updateCouponStatus" id="coupon-{{ $coupon['id'] }}" coupon_id="{{ $coupon['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" style="color: grey;" status="Inactive"></i></a>
                          @endif
                        @endif
                        @if($couponsModule['edit_access']==1 || $couponsModule['full_access']==1)    
                          &nbsp;&nbsp;
                          <a style='color:#078aed;' href="{{ url('admin/add-edit-coupon/'.$coupon['id']) }}"><i class="fas fa-edit"></i></a>
                          &nbsp;&nbsp;
                        @endif
                        @if($couponsModule['full_access']==1)    
                          <a style='color:#078aed;' class="confirmDelete" name="coupon" title="Delete Coupon" href="javascript:void(0)" record="coupon" recordid="{{ $coupon['id'] }}" <?php /* href="{{ url('admin/delete-coupon/'.$coupon['id']) }}" */ ?>  ><i class="fas fa-trash"></i></a>
                        @endif  
                      </td>
                    </tr>
                    @endforeach 
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection 