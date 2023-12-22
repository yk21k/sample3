@extends('admin.layout.layout')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">CMS Pages</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">CMS Pages</li>
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
                <h3 class="card-title">CMS Pages</h3>
                <a style="max-width: 150px; float:right; display:inline-block; "href="{{ url('admin/add-edit-cms-page') }}" class="btn btn-block btn-info">Add CMS PAGE</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="cmspages" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>URL</th>
                    <th>Created on</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach($CmsPages as $page)
                    <tr>
                      <td>{{ $page['id'] }}</td>
                      <td>{{ $page['title'] }}</td>
                      <td>{{ $page['url'] }}</td>
                      <td>{{ date("Y-m-d H:i:s", strtotime($page['created_at'])); }}</td>
                      <td>
                        @if($page['status']==1)
                          <a class="updateCmsPageStatus" id="page-{{ $page['id'] }}" page_id="{{ $page['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-on" style="color: #078aed;" status="Action"></i></a>
                        @else
                          <a class="updateCmsPageStatus" id="page-{{ $page['id'] }}" page_id="{{ $page['id'] }}" href="javascript:void(0)"><i class="fas fa-toggle-off" style="color: grey;" status="Inaction"></i></a>
                        @endif
                        &nbsp;&nbsp;
                        <a style='color:#078aed;' href="{{ url('admin/add-edit-cms-page/'.$page['id']) }}"><i class="fas fa-edit"></i></a>
                        &nbsp;&nbsp;
                        <a style='color:#078aed;' class="confirmDelete" name="CMS Page" title="Delete CMS Page" href="javascript:void(0)" record="cms-page" recordid="{{ $page['id'] }}" <?php /* href="{{ url('admin/delete-cms-page/'.$page['id']) }}" */ ?>><i class="fas fa-trash"></i></a>  
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