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
                @if(Session::has('success_message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
	              <!-- form start -->
	              <form name="productForm" id="productForm" @if(empty($product['id'])) action="{{ url('admin/add-edit-product') }}" @else action="{{ url('admin/add-edit-product/'.$product['id']) }}" @endif method="post" enctype="multipart/form-data">@csrf
	                <div class="card-body">
                    <div class="form-group">
                      <label for="category_id">Select Category*</label>
                      <select name="category_id" class="form-control">
                        <option value="">Select</option>
                        @foreach($getCategories as $cat)
                          <option @if(!empty(@old('category_id')) && $cat['id']==@old('category_id')) selected="" @elseif(!empty($product['category_id']) && $product['category_id']==$cat['id']) selected="" @endif value="{{ $cat['id'] }}">{{ $cat['category_name'] }}</option>
                          @if(!empty($cat['subcategories']))
                            @foreach($cat['subcategories'] as $subcat)
                              <option @if(!empty(@old('category_id')) && $subcat['id']==@old('category_id')) selected="" @elseif(!empty($product['category_id']) && $product['category_id']==$subcat['id']) selected="" @endif value="{{ $subcat['id'] }}">&nbsp;&nbsp;&raquo;{{ $subcat['category_name'] }}</option>
                              @if(!empty($subcat['subcategories']))
                                @foreach($subcat['subcategories'] as $subsubcat)
                                  <option @if(!empty(@old('category_id')) && $subsubcat['id']==@old('category_id')) selected="" @elseif(!empty($product['category_id']) && $product['category_id']==$subsubcat['id']) selected="" @endif value="{{ $subsubcat['id'] }}">&nbsp;&nbsp;&nbsp;&nbsp;&raquo;&raquo;{{ $subsubcat['category_name'] }}</option>
                                @endforeach
                              @endif
                            @endforeach
                          @endif
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="product_name">Product Name*</label>
                      <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter Product Name" @if(!empty($product['product_name'])) value="{{ $product['product_name'] }}" @else value="{{ @old('product_name') }}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="product_code">Product Code*</label>
                      <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter Product Code" @if(!empty($product['product_code'])) value="{{ $product['product_code'] }}" @else value="{{ @old('product_code') }}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="product_color">Product Color*</label>
                      <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter Product Color" @if(!empty($product['product_color'])) value="{{ $product['product_color'] }}" @else value="{{ @old('product_color') }}" @endif>
                    </div>
                    @php $familyColors = \App\Models\Color::colors() @endphp
                    <div class="form-group">
                      <label for="family_color">Family Color*</label>
                      <select name="family_color" class="form-control">
                        <option value="">Select</option>
                        @foreach($familyColors as $color)
                          <option value="{{ $color['color_name'] }}" @if(!empty(@old('family_color')) && @old('family_color')==$color['color_name']) selected="" @elseif(!empty($product['family_color']) && $product['family_color']==$color['color_name']) selected="" @endif>{{ $color['color_name'] }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="group_code">Group Code</label>
                      <input type="text" class="form-control" id="group_code" name="group_code" placeholder="Enter Group Code" @if(!empty($product['group_code'])) value="{{ $product['group_code'] }}" @else value="{{ @old('product_color') }}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="product_price">Product Price*</label>
                      <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter Product Price" @if(!empty($product['product_price'])) value="{{ $product['product_price'] }}" @else value="{{ @old('product_price') }}" @endif required="">
                    </div>
	                  <div class="form-group">
	                    <label for="product_discount">Product Discount (%)</label>
	                    <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Enter Product Discount (%)" @if(!empty($product['product_discount'])) value="{{ $product['product_discount'] }}" @elseif(@old('product_discount')==0) value="0" @else value="{{ @old('product_discount') }}" @endif>
	                  </div>
                    <div class="form-group">
                      <label for="product_weight">Product Weight</label>
                      <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter Product Code" @if(!empty($product['product_weight'])) value="{{ $product['product_weight'] }}" @else value="{{ @old('product_weight') }}" @endif>
                    </div>
                    <div class="form-group">
                      <label for="product_video">Product Image's</label>
                      <input type="file" class="form-control" id="product_images" name="product_images[]" multiple="">
                      <table cellpadding="4" cellspacing="4" border="1" style="margin-top:5px;"><tr>
                        @foreach($product['images'] as $image)
                          <td style="background-color:#f9f9f9;">
                            <a target="_blank" href="{{ url('front/images/products/medium/'.$image['image']) }}"><img style="width:80px;" src="{{ asset('front/images/products/small/'.$image['image']) }}"></a>&nbsp;
                            <input type="hidden" name="image[]" value="{{ $image['image'] }}">
                            <input style="width:30px;" type="text" name="image_sort[]" value="{{ $image['image_sort'] }}">&nbsp;
                            <a style='color:#078aed;' class="confirmDelete" title="Delete Product Image" href="javascript:void(0)" record="product-image" recordid="{{ $image['id'] }}"><i class="fas fa-trash"></i></a>
                          </td>  
                        @endforeach
                      </table>
                    </div>
                    <div class="form-group">
                      <label for="product_video">Product Video</label>
                      <input type="file" class="form-control" id="product_video" name="product_video">
                      @if(!empty($product['product_video']))
                        <a target="_blank" href="{{ url('front/videos/products/'.$product['product_video']) }}" style="color:#FF9900;">
                          View</a> | <a class="confirmDelete" title="Delete Product Video" href="javascript:void(0)" record="product-video" recordid="{{ $product['id'] }}" style="color:#FF00CC;">Delete</a>
                        </a>
                      @endif
                    </div>
                    <div class="form-group">
                      <label>Added Attributes</label>
                        <table style="background-color: #264D80; width:60%; cellpadding:"5";>
                          <tr>
                            <th>ID</th>
                            <th>Size</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Actions</th>
                          </tr>
                          @foreach($product['attributes'] as $attribute)
                            <tr>
                              <td>{{ $attribute['id'] }}</td>
                              <td>{{ $attribute['size'] }}</td>
                              <td>{{ $attribute['sku'] }}</td>
                              <td>{{ $attribute['price'] }}</td>
                              <td>{{ $attribute['stock'] }}</td>
                              <td></td>
                            </tr>
                          @endforeach
                        </table>
                    </div>
                    <div class="form-group">
                      <label>Product Attributes</label>
                      <div class="field_wrapper">
                        <div>
                          <input type="text" name="size[]" id="size" placeholder="Size" style="width:120px;" value=""/>
                          <input type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px;" value=""/>
                          <input type="text" name="price[]" id="price" placeholder="Price" style="width:120px;" value=""/>
                          <input type="text" name="stock[]" id="stock" placeholder="Stock" style="width:120px;" value=""/>
                          <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="fabric">Fabric</label>
                      <select name="fabric" class="form-control">
                        <option value="">Select</option>
                        @foreach($productsFilters['fabricArray'] as $fabric)
                          <option value="{{ $fabric }}" @if(!empty(@old('fabric')) && @old('fabric')==$fabric)) selected="" @elseif(!empty($product['fabric']) && $product['fabric']==$fabric) selected="" @endif>{{ $fabric }}</option>
                        @endforeach  
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="sleeve">Sleeve</label>
                      <select name="sleeve" class="form-control">
                        <option value="">Select</option>
                        @foreach($productsFilters['sleeveArray'] as $sleeve)
                          <option value="{{ $sleeve }}" @if(!empty(@old('sleeve')) && @old('sleeve')==$sleeve)) selected="" @elseif(!empty($product['sleeve']) && $product['sleeve']==$sleeve) selected="" @endif>{{ $sleeve }}</option>
                        @endforeach  
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="pattern">Pattern</label>
                      <select name="pattern" class="form-control">
                        <option value="">Select</option>
                        @foreach($productsFilters['patternArray'] as $pattern)
                          <option value="{{ $pattern }}" @if(!empty(@old('pattern')) && @old('pattern')==$pattern)) selected="" @elseif(!empty($product['pattern']) && $product['pattern']==$pattern) selected="" @endif>{{ $pattern }}</option>
                        @endforeach  
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="fit">Fit</label>
                      <select name="fit" class="form-control">
                        <option value="">Select</option>
                        @foreach($productsFilters['fitArray'] as $fit)
                          <option value="{{ $fit }}" @if(!empty(@old('fit')) && @old('fit')==$fit)) selected="" @elseif(!empty($product['fit']) && $product['fit']==$fit) selected="" @endif>{{ $fit }}</option>
                        @endforeach  
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="occasion">Occasion</label>
                      <select name="occasion" class="form-control">
                        <option value="">Select</option>
                        @foreach($productsFilters['occasionArray'] as $occasion)
                          <option value="{{ $occasion }}" @if(!empty(@old('occasion')) && @old('occasion')==$occasion)) selected="" @elseif(!empty($product['occasion']) && $product['occasion']==$occasion) selected="" @endif>{{ $occasion }}</option>
                        @endforeach  
                      </select>
                    </div>
                    <!-- textarea -->
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea class="form-control" rows="3" id="description" name="description" placeholder="Enter Product Descrption">@if(!empty($product['description'])) {{ $product['description'] }} @else {{ @old('description') }} @endif</textarea>
                    </div>
                    <!-- textarea -->
                    <div class="form-group">
                      <label for="wash_care">Wash Care</label>
                      <textarea class="form-control" rows="3" id="wash_care" name="wash_care" placeholder="Enter Product Wash Care">@if(!empty($product['wash_care'])) {{ $product['wash_care'] }} @else {{ @old('wash_care') }} @endif</textarea>
                    </div>
                    <!-- textarea -->
                    <div class="form-group">
                      <label for="search_keywords">Search Keywords</label>
                      <textarea class="form-control" rows="3" id="search_keywords" name="search_keywords" placeholder="Enter Product Search Keywords">@if(!empty($product['search_keywords'])) {{ $product['search_keywords'] }} @else {{ @old('search_keywords') }} @endif</textarea>
                    </div>
	                  <div class="form-group">
	                    <label for="meta_title">Meta Title</label>
	                    <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter Page Meta Title" @if(!empty($product['meta_title'])) value="{{ $product['meta_title'] }}" @else value="{{ @old('meta_title') }}" @endif>
	                  </div>
	                  <div class="form-group">
	                    <label for="meta_description">Meta Description</label>
	                    <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Enter Page Meta Description" @if(!empty($product['meta_description'])) value="{{ $product['meta_description'] }}" @else value="{{ @old('meta_description') }}" @endif>
	                  </div>
	                  <div class="form-group">
	                    <label for="meta_keywords">Meta Keyword</label>
	                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter Meta Keyword" @if(!empty($product['meta_keywords'])) value="{{ $product['meta_keywords'] }}" @else value="{{ @old('meta_keywords') }}" @endif>
	                  </div>
                    <div class="form-group">
                      <label for="is_featured">Featured Item</label>
                      <input type="checkbox" name="is_featured" value="Yes" @if(!empty($product['is_featured']) && $product['is_featured']=="Yes") checked="" @endif>
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