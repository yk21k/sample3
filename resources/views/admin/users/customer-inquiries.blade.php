@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Customers Inquiries</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Customers Inquiries</li>
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
                  <h3 class="card-title">Customers Inquiries</h3>
                  
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="inquiryAnswers" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>Inquiry ID</th>
                    <th>Order Date</th>
                    <th>Updated</th>
                    <th>User ID</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($inquiryAnswers as $inquiryAnswer)
                    <tr>
                      <td>{{ $inquiryAnswer['id'] }}</td>
                      <td>{{ date("Y/m/d H:i:s", strtotime($inquiryAnswer['created_at'])); }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($inquiryAnswer['updated_at'])); }}</td>
                      <td>{{ $inquiryAnswer['user_id'] }}</td>
                      <td></td>
                      <td>
                        <a style='color:#078aed;'href="{{ url('admin/users-inquiries/'.$inquiryAnswer['user_id']) }}"><i class="fas fa-file"></i></a>
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