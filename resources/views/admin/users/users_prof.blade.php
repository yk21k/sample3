@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users Prof(ID)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Users Prof(ID)</li>
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
                  <h3 class="card-title">Users Prof(ID)</h3>
                  
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="orders" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                  	<th>ID</th>
                    <th>User ID</th>
                    <th>Created Date</th>
                    <th>Updated</th>
                    <th>ID Image</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($usersProfiles as $usersProfile)
                    <tr>
                      <td>{{ $usersProfile['id'] }}</td>
                      <td>{{ $usersProfile['user_id'] }}</td>
                      <td>{{ date("Y/m/d H:i:s", strtotime($usersProfile['created_at'])); }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($usersProfile['updated_at'])); }}</td>
                      <td>
                        <img style="width: 200px;" src="{{ url('/storage/'.$usersProfile['image_path']) }}" alt="" width="40%">
                        
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