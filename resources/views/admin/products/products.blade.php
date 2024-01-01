@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Products</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Products</li>
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
                <div class="card-header">
                  <h3 class="card-title">Products</h3>
                  <a style="max-width: 150px; float:right; display:inline-block; "href="{{ url('admin/add-edit-product') }}" class="btn btn-block btn-info">Add PRODUCTS</a>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="products" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Color</th>
                    <th>Created on</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $product)
                    <tr>
                      <td>{{ $product['id'] }}</td>
                      <td>{{ $product['product_name'] }}</td>
                      <td>{{ $product['product_code'] }}</td>
                      <td>{{ $product['product_color'] }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($product['created_at'])); }}</td>
                      <td>
                          @if($product['status']==1)
                            <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" style="color: #078aed;" status="Active"></i></a>
                          @else
                            <a class="updateProductStatus" id="product-{{ $product['id'] }}" product_id="{{ $product['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" style="color: grey;" status="Inactive"></i></a>
                          @endif
                          &nbsp;&nbsp;
                          <a style='color:#078aed;' href="{{ url('admin/add-edit-product/'.$product['id']) }}"><i class="fas fa-edit"></i></a>
                          &nbsp;&nbsp;
                          <a style='color:#078aed;' class="confirmDelete" name="product" title="Delete Product" href="javascript:void(0)" record="product" recordid="{{ $product['id'] }}"><i class="fas fa-trash"></i></a>
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