@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Banners</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Banners</li>
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
              @if($bannersModule['edit_access']==1 || $bannersModule['full_access']==1)
                <div class="card-header">
                  <h3 class="card-title">Banners</h3>
                  <a style="max-width: 150px; float:right; display:inline-block; "href="{{ url('admin/add-edit-banner') }}" class="btn btn-block btn-info">Add Banner</a>
                </div>
              @endif  
              <!-- /.card-header -->
              <div class="card-body">
                <table id="banners" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Link</th>
                    <th>Title</th>
                    <th>Alt</th>
                    <th>Created on</th>
                    <th>Updated</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($banners as $banner)
                    <tr>
                      <td>{{ $banner['id'] }}</td>
                      <td>
                        <a href="{{ url('front/images/banners/'.$banner['image']) }}">
                          <img style="width:180px;" src="{{ asset('front/images/banners/'.$banner['image']) }}" >
                        </a>
                      </td>
                      <td>{{ $banner['type'] }}</td>
                      <td>{{ $banner['link'] }}</td>
                      <td>{{ $banner['type'] }}</td>
                      <td>{{ $banner['title'] }}</td>
                      <td>{{ $banner['alt'] }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($banner['created_at'])); }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($banner['updated_at'])); }}</td>
                      <td>
                        @if($bannersModule['edit_access']==1 || $bannersModule['full_access']==1)
                          @if($banner['status']==1)
                            <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" style="color: #078aed;" status="Active"></i></a>
                          @else
                            <a class="updateBannerStatus" id="banner-{{ $banner['id'] }}" banner_id="{{ $banner['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" style="color: grey;" status="Inactive"></i></a>
                          @endif
                        @endif
                        @if($bannersModule['edit_access']==1 || $bannersModule['full_access']==1)    
                          &nbsp;&nbsp;
                          <a style='color:#078aed;' href="{{ url('admin/add-edit-banner/'.$banner['id']) }}"><i class="fas fa-edit"></i></a>
                          &nbsp;&nbsp;
                        @endif
                        @if($bannersModule['full_access']==1)    
                          <a style='color:#078aed;' class="confirmDelete" name="banner" title="Delete Banner" href="javascript:void(0)" record="banner" recordid="{{ $banner['id'] }}" <?php /* href="{{ url('admin/delete-banner/'.$banner['id']) }}" */ ?>  ><i class="fas fa-trash"></i></a>
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