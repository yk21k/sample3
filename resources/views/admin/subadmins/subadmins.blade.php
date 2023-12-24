@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sub Admins</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Sub Admins</li>
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
                <h3 class="card-title">Sub Admins</h3>
                <a style="max-width: 150px; float:right; display:inline-block; "href="{{ url('admin/add-edit-subadmins') }}" class="btn btn-block btn-info">Add Sub Admins</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="subadmins" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Created on</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($subadmins as $subadmin)
                    <tr>
                      <td>{{ $subadmin->id }}</td>
                      <td>{{ $subadmin->name }}</td>
                      <td>{{ $subadmin->mobile }}</td>
                      <td>{{ $subadmin->email }}</td>
                      <td>{{ $subadmin->type }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($subadmin->created_at)); }}</td>
                      <td>
                        @if($subadmin['status']==1)
                          <a class="updateSubadminStatus" id="subadmin-{{ $subadmin->id }}" subadmin_id="{{ $subadmin->id }}" href="javascript:void(0)"><i class="fas fa-toggle-on" style="color: #078aed;" status="Action"></i></a>
                        @else
                          <a class="updateSubadminStatus" id="subadmin-{{ $subadmin->id }}" subadmin_id="{{ $subadmin->id }}" href="javascript:void(0)"><i class="fas fa-toggle-off" style="color: grey;" status="Inaction"></i></a>
                        @endif
                        &nbsp;&nbsp;
                        <?php /* <a style='color:#078aed;' href="{{ url('admin/add-edit-subadmin/'.$subadmin->id) }}"><i class="fas fa-edit"></i></a>
                        &nbsp;&nbsp; */ ?>
                        <a style='color:#078aed;' class="confirmDelete" name="Subadmin" title="Delete Sub Admin" href="javascript:void(0)" record="subadmin" recordid="{{ $subadmin->id }}" <?php /* href="{{ url('admin/delete-subadmin/'.$subadmin->id) }}" */ ?> ><i class="fas fa-trash"></i></a>
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