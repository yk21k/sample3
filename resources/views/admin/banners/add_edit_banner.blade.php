@extends('admin.layout.layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{ $title }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-6">
                @if ($errors->any())
                  <div class="alert alert-danger alert-dismissible fade show">
                    @foreach ($errors->all() as $error)
                      <div>
                        <strong>Error: </strong> {{ $error }}  
                        <button style="float:right; display:inline-block;" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                      </div>  
                    @endforeach
                  </div>
                @endif
                <!-- form start -->
                <form name="bannerForm" id="bannerForm" @if(empty($banner['id'])) action="{{ url('admin/add-edit-banner') }}" @else action="{{ url('admin/add-edit-banner/'.$banner['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
                  <div class="card-body">
                    <div class="form-group">
                      <label for="type">Banner Type</label>
                      <select class="form-control" id="type" name="type">
                        <option value="">Select</option>
                        <option @if(!empty($banner['type'])&&$banner['type']=="Slider") selected @endif value="Slider">Slider</option>  
                        <option @if(!empty($banner['type'])&&$banner['type']=="Fix 1") selected @endif value="Fix">Fix</option>  
                         
                      </select> 
                    </div>
                    <div class="form-group">
                      <label for="banner_image">Banner Image</label>
                      <input type="file" class="form-control" id="banner_image" name="banner_image">
                      @if(!empty($banner['image']))
                        <a target="_blank" href="{{ url('front/images/banners/'.$banner['image']) }}"><img style="width:100px; margin-top:10px;" src="{{ asset('front/images/banners/'.$banner['image']) }}"></a>
                        <a style='color:#078aed;' class="confirmDelete" name="banner" title="Delete Banner Image" href="javascript:void(0)" record="banner" recordid="{{ $banner['id'] }}">&nbsp;<i style="color:#fff;" class="fas fa-trash"></i></a>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="title">Banner Title*</label>
                      <input type="text" class="form-control" id="title" name="title" placeholder="Enter Banner Name" @if(!empty($banner['title'])) value="{{ $banner['title'] }}" @else value="{{ old('title') }}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="alt">Banner Alt*</label>
                      <input type="text" class="form-control" id="alt" name="alt" placeholder="Enter Banner Name" @if(!empty($banner['alt'])) value="{{ $banner['alt'] }}" @else value="{{ old('alt') }}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="link">Banner Link*</label>
                      <input type="text" class="form-control" id="link" name="link" placeholder="Enter Page Banner Link" @if(!empty($banner['link'])) value="{{ $banner['link'] }}" @else value="{{ old('link') }}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="sort">Banner Sort*</label>
                      <input type="number" class="form-control" id="sort" name="sort" placeholder="Enter Page Banner Link" @if(!empty($banner['sort'])) value="{{ $banner['sort'] }}" @else value="{{ old('sort') }}" @endif>
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection