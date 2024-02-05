@extends('front.layout.layout')
@section('content')
<!-- TEST -->
<nav class="nav3dtest">
  <h5>3dtest</h5>	
  <a class="a3dtest" href="#page-1"><span>1</span></a>
  <a class="a3dtest" href="#page-2"><span>2</span></a>
  <a class="a3dtest" href="#page-3"><span>3</span></a>
</nav>
<div class="scroll-container3d">
  <div class="scroll-page3d" id="page-1">
  	3dtest 1
  </div>
  <div class="scroll-page3d" id="page-2">
  	3dtest 2
  </div>
  <div class="scroll-page3d" id="page-3">
  	3dtest 3
  </div>
</div>
  	<!--====== Section 6 ======-->
	<div class="u-s-p-b-60">
	    <!--====== Section Intro ======-->
        <h1 class="section__heading u-c-secondary u-s-m-b-12">3D test</h1>
        <span class="section__span u-c-silver">3D test PRODUCTS</span>
	    <!--====== End - Section Intro ======-->

	    <!--====== Section Content ======-->
	    <div class="3dbody">
            
	       <div class="content">
	       		<div class="cube-left">
	    			@foreach($discountedProducts as $product)  
			            <div class="box-top">                       
			            </div>
			            <div class="box-bottom">
			            </div>
			            <div class="box-front">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
	                        <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
	                        @else
	                        <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
	                        @endif
			            </div>
			            <div class="box-back">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
	                        <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
	                        @else
	                        <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
	                        @endif
			            </div>
			            <div class="box-left">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
	                        <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
	                        @else
	                        <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
	                        @endif
			            </div>
			            <div class="box-right">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
	                        <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
	                        @else
	                        <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
	                        @endif
			            </div>
		            @endforeach   
			    </div>
				<div class="cube-center1">
        			@foreach($featuredProducts as $product)  
			            <div class="box-top">                       
			            </div>
			            <div class="box-bottom">
			            </div>
			            <div class="box-front">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                            <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                            @else
                            <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                            @endif
			            </div>
			            <div class="box-back">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                            <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                            @else
                            <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                            @endif
			            </div>
			            <div class="box-left">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                            <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                            @else
                            <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                            @endif
			            </div>
			            <div class="box-right">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                            <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                            @else
                            <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                            @endif
			            </div>
		            @endforeach   
		        </div>
				<div class="cube-center2">
					@foreach($newProducts as $product)
			            <div class="box-top">                       
			            </div>
			            <div class="box-bottom">
			            </div>
			            <div class="box-front">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                            <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                            @else
                            <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                            @endif
			            </div>
			            <div class="box-back">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                            <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                            @else
                            <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                            @endif
			            </div>
			            <div class="box-left">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                            <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                            @else
                            <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                            @endif
			            </div>
			            <div class="box-right">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                            <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                            @else
                            <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                            @endif
			            </div>
			        @endforeach   
		        </div>
		        <div class="cube-right">
	    			@foreach($bestSellers as $product)  
			            <div class="box-top">                       
			            </div>
			            <div class="box-bottom">
			            </div>
			            <div class="box-front">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
	                        <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
	                        @else
	                        <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
	                        @endif
			            </div>
			            <div class="box-back">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
	                        <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
	                        @else
	                        <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
	                        @endif
			            </div>
			            <div class="box-left">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
	                        <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
	                        @else
	                        <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
	                        @endif
			            </div>
			            <div class="box-right">
			                @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
	                        <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
	                        @else
	                        <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
	                        @endif
			            </div>
		            @endforeach   
			    </div> 
	       </div>
			<div class="u-s-p-b-90">
			    <!--====== Section Content ======-->
			    <div class="3dbody">		    
					<div class="content">
				          <div class="cube-left">
					            <div class="box-top">
					                
					            </div>

					            <div class="box-bottom">
					                
					            </div>
					            <div class="box-front">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest11.jpeg') }}">
					            </div>
					            <div class="box-back">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest1.jpeg') }}">
					            </div>
					            <div class="box-left">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest6.jpeg') }}">
					            </div>
					            <div class="box-right">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest7.jpeg') }}">
					                
					            </div>   
				          </div>
				          <div class="cube-center1">
					            <div class="box-top">                       
					            </div>
					            <div class="box-bottom">
					            </div>
					            <div class="box-front">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest10.jpeg') }}">
					            </div>
					            <div class="box-back">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest1.jpeg') }}">
					            </div>
					            <div class="box-left">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest12.jpeg') }}">
					            </div>
					            <div class="box-right">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest9.jpeg') }}">
					                
					            </div>   
				          </div>
				          <div class="cube-center2">
					            <div class="box-top">                       
					            </div>
					            <div class="box-bottom">
					            </div>
					            <div class="box-front">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest2.jpeg') }}">
					            </div>
					            <div class="box-back">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest1.jpeg') }}">
					            </div>
					            <div class="box-left">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest6.jpeg') }}">
					            </div>
					            <div class="box-right">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest8.jpeg') }}">
					                
					            </div>   
				          </div>
				          <div class="cube-right">
					            <div class="box-top"></div>
					            <div class="box-bottom"></div>
					            <div class="box-front">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest3.jpeg') }}">
					            </div>
					            <div class="box-back">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest1.jpeg') }}">
					                
					            </div>
					            <div class="box-left">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest4.jpeg') }}">
					            </div>
					            <div class="box-right">
					                <img style="width: 250px; height: 250px;" src="{{ url('front/images/products/3dtest5.jpeg') }}">
					            </div>   
				          </div>
				    </div>
				</div>    		       
	    	</div>
	    <!--====== End - Section Content ======-->
	</div>
	<!--====== End - Section 6 ======-->
	<!--====== Section 7 ======-->
	<div class="u-s-p-b-120">
	    <!--====== Section Intro ======-->
        <h1 class="section__heading u-c-secondary u-s-m-b-12">3D test</h1>
        <span class="section__span u-c-silver">3D test PRODUCTS</span>
		        
		<div class="3dbody_2">
	        <section class="container2">
				<div id="cube">
					<figure class="front">
						<img src="http://lorempixel.com/196/196/sports/1">
					</figure>
					<figure class="back">
						<img src="http://lorempixel.com/196/196/sports/2">
					</figure>
					<figure class="right">
						<img src="http://lorempixel.com/196/196/sports/3">
					</figure>
					<figure class="left">
						<img src="http://lorempixel.com/196/196/sports/7">
					</figure>
					<figure class="top">
						<img src="http://lorempixel.com/196/196/sports/5">
					</figure>
					<figure class="bottom">
						<img src="http://lorempixel.com/196/196/sports/6">
					</figure>
				</div>
			</section>
		</div>
	</div>
	<!--====== End - Section 7 ======-->
@endsection