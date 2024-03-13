@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Users</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
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
                
              <!-- /.card-header -->
              <div class="card-body">
                <table id="users" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Pincode</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Registered on</th>
                    <th>Updated</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                      <td>{{ $user['id'] }}</td>
                      <td>{{ $user['name'] }}</td>
                      <td>{{ $user['address'] }}</td>
                      <td>{{ $user['city'] }}</td>
                      <td>{{ $user['state'] }}</td>
                      <td>{{ $user['country'] }}</td>
                      <td>{{ $user['pincode'] }}</td>
                      <td>{{ $user['mobile'] }}</td>
                      <td>{{ $user['email'] }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($user['created_at'])); }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($user['updated_at'])); }}</td>
                      <td>
                        @if($usersModule['edit_access']==1 || $usersModule['full_access']==1)
                          @if($user['status']==1)
                            <a class="updateUserStatus" id="user-{{ $user['id'] }}" user_id="{{ $user['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" style="color: #078aed;" status="Active"></i></a>
                          @else
                            <a class="updateUserStatus" id="user-{{ $user['id'] }}" user_id="{{ $user['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" style="color: grey;" status="Inactive"></i></a>
                          @endif
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