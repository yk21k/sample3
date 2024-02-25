@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Brands</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Brands</li>
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
              @if($brandsModule['edit_access']==1 || $brandsModule['full_access']==1)
                <div class="card-header">
                  <h3 class="card-title">Brands</h3>
                  <a style="max-width: 150px; float:right; display:inline-block; "href="{{ url('admin/add-edit-brand') }}" class="btn btn-block btn-info">Add BRAND</a>
                </div>
              @endif  
              <!-- /.card-header -->
              <div class="card-body">
                <table id="brands" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Created on</th>
                    <th>Updated</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($brands as $brand)
                    <tr>
                      <td>{{ $brand['id'] }}</td>
                      <td>
                          {{ $brand['brand_name'] }}
                      </td>
                      <td>{{ $brand['url'] }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($brand['created_at'])); }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($brand['updated_at'])); }}</td>
                      <td>
                        @if($brandsModule['edit_access']==1 || $brandsModule['full_access']==1)
                          @if($brand['status']==1)
                            <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" style="color: #078aed;" status="Active"></i></a>
                          @else
                            <a class="updateBrandStatus" id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" style="color: grey;" status="Inactive"></i></a>
                          @endif
                        @endif
                        @if($brandsModule['edit_access']==1 || $brandsModule['full_access']==1)    
                          &nbsp;&nbsp;
                          <a style='color:#078aed;' href="{{ url('admin/add-edit-brand/'.$brand['id']) }}"><i class="fas fa-edit"></i></a>
                          &nbsp;&nbsp;
                        @endif
                        @if($brandsModule['full_access']==1)    
                          <a style='color:#078aed;' class="confirmDelete" name="brand" title="Delete Brand" href="javascript:void(0)" record="brand" recordid="{{ $brand['id'] }}" <?php /* href="{{ url('admin/delete-brand/'.$brand['id']) }}" */ ?>  ><i class="fas fa-trash"></i></a>
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