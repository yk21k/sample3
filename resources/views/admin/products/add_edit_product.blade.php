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
              <div class="col-12">
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
	              <form name="productForm" id="productForm" @if(empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$product['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
	                <div class="card-body">
                    <div class="form-group">
                      <label for="product_level">Select Category*</label>
                      <select name="category_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($getCategories as $cat)
                          <option value="{{ $cat['id'] }}">{{ $cat['category_name'] }}</option>
                          @if(!empty($cat['subcategories']))
                            @foreach($cat['subcategories'] as $subcat)
                              <option value="{{ $subcat['id'] }}" @if(isset($product['category_id'])&&$product['category_id']==$subcat['id']) selected @endif>&nbsp;&nbsp;&raquo;{{ $subcat['category_name'] }}</option>
                              @if(!empty($subcat['subcategories']))
                                @foreach($subcat['subcategories'] as $subsubcat)
                                  <option value="{{ $subsubcat['id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;{{ $subsubcat['category_name'] }}</option>
                                @endforeach
                              @endif
                            @endforeach
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="product_name">Product Name</label>
                      <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name">
                    </div>
                    <div class="form-group">
                      <label for="product_code">Product Code</label>
                      <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter Product Code">
                    </div>
                    <div class="form-group">
                      <label for="product_color">Product Color</label>
                      <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter Product Color">
                    </div>
                    <div class="form-group">
                      <label for="family_color">Family Color</label>
                      <select name="family_color" class="form-control">
                        <option value="">Select</option>
                        <option value="Red">Red</option>
                        <option value="Green">Green</option>
                        <option value="Yellow">Yellow</option>
                        <option value="Black">Black</option>
                        <option value="Blue">Blue</option>
                        <option value="Orange">Orange</option>
                        <option value="White">White</option>
                        <option value="Grey">Grey</option>
                        <option value="Silver">Silver</option>
                        <option value="Golden">Golden</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="group_code">Group Code</label>
                      <input type="text" class="form-control" id="group_code" name="group_code" placeholder="Enter Group Code">
                    </div>
                    <div class="form-group">
                      <label for="product_price">Product Price</label>
                      <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Price">
                    </div>
	                  <div class="form-group">
	                    <label for="product_price">Product Discount (%)</label>
	                    <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Discount (%)">
	                  </div>
                    <div class="form-group">
                      <label for="product_weight">Product Weight</label>
                      <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter Product Code">
                    </div>
                    <div class="form-group">
                      <label for="product_video">Product Video</label>
                      <input type="file" class="form-control" id="product_id" name="product_id">
                    </div>
                    <!-- textarea -->
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter Product Descrption"></textarea>
                    </div>
                    <!-- textarea -->
                    <div class="form-group">
                      <label for="wash_care">Wash Care</label>
                      <textarea class="form-control" rows="3" id="wash_care" name="wash_care" placeholder="Enter Product Wash Care"></textarea>
                    </div>
                    <!-- textarea -->
                    <div class="form-group">
                      <label for="search_keywords">Search Keywords</label>
                      <textarea class="form-control" rows="3" id="search_keywords" name="search_keywords" placeholder="Enter Product Search Keywords"></textarea>
                    </div>
	                  <div class="form-group">
	                    <label for="meta_title">Meta Title</label>
	                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Page Meta Title">
	                  </div>
	                  <div class="form-group">
	                    <label for="meta_description">Meta Description</label>
	                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Page Meta Description">
	                  </div>
	                  <div class="form-group">
	                    <label for="meta_keywords">Meta Keyword</label>
	                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta Keyword">
	                  </div>
                    <div class="form-group">
                      <label for="is_featured">Featured Item</label>
                      <input type="checkbox" name="is_featured" value="Yes">
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