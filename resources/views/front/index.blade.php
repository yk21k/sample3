@extends('front.layout.layout')
@section('content')
<div class="app-content">
    <!--====== Primary Slider ======-->
    <div class="s-skeleton s-skeleton--h-600 s-skeleton--bg-grey">
        <div class="owl-carousel primary-style-1" id="sitemakers-slider">
            @foreach($homeSliderBanners as $sliderBanner)
                <div class="sitemakers-slide sitemakers-slide--1" style="background-image: url('{{ asset('front/images/banners/'.$sliderBanner['image']) }}');" alt="{{ $sliderBanner['alt'] }}">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="slider-content slider-content--animation">
                                    <span class="content-span-2 u-c-secondary">{{ $sliderBanner['title'] }}</span>
                                    <a class="shop-now-link btn--e-brand" href="{{ asset('front/images/banners/'.$sliderBanner['image']) }}">SHOP NOW</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!--====== End - Primary Slider ======-->
        <!--====== Section 1 ======-->
        <div class="u-s-p-y-60">
            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-46">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">SHOP BY DEALS</h1>
                                <span class="section__span u-c-silver">BROWSE FAVOURITE DEALS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->
            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        @foreach($homeFixBanners as $slideBanner)
                            @if(isset($slideBanner['image']))
                            <div class="col-lg-5 col-md-5 u-s-m-b-30">
                                <a class="collection" href="{{ asset('front/images/banners/'.$slideBanner['image']) }}" title="{{ $slideBanner['title'] }}">
                                    <div class="aspect aspect--bg-grey aspect--square">
                                        <img class="aspect__img collection__img" src="{{ asset('front/images/banners/'.$slideBanner['image']) }}" alt="{{ $slideBanner['alt'] }}">
                                    </div>
                                </a>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            <!--====== Section Content ======-->
        </div>
        <!--====== End - Section 1 ======-->
        <!--====== Section 2 ======-->
        <div class="u-s-p-b-60">
            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-16">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">TOP TRENDING</h1>
                                <span class="section__span u-c-silver">CHOOSE CATEGORY</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->
            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="filter-category-container">
                                <div class="filter__category-wrapper">
                                    <button class="btn filter__btn filter__btn--style-1 js-checked" type="button" data-filter="*">ALL</button>
                                </div>
                                <div class="filter__category-wrapper">
                                    <button class="btn filter__btn filter__btn--style-1" type="button" data-filter=".newarrivals">NEW ARRIVALS</button>
                                </div>
                                <div class="filter__category-wrapper">
                                    <button class="btn filter__btn filter__btn--style-1" type="button" data-filter=".bestsellers">BEST SELLERS</button>
                                </div>
                                <div class="filter__category-wrapper">
                                    <button class="btn filter__btn filter__btn--style-1" type="button" data-filter=".discountedproducts">DISCOUNTED PRODUCTS</button>
                                </div>
                                <div class="filter__category-wrapper">
                                    <button class="btn filter__btn filter__btn--style-1" type="button" data-filter=".featuredproducts">FEATURED PRODUCTS</button>
                                </div>
                            </div>
                            <div class="filter__grid-wrapper u-s-m-t-30">
                                <div class="row">
                                    @foreach($newProducts as $product)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item newarrivals">
                                            <div class="product-o product-o--hover-on product-o--radius">
                                                <div class="product-o__wrap">
                                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                                    @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                                                    <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                                                    @else
                                                    <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                                                    @endif
                                                    </a>
                                                </div>
                                                <span class="product-o__category">
                                                <a href="shop-side-version-2.html">{{ $product['brand']['brand_name'] }}</a></span>
                                                <span class="product-o__name">
                                                <a href="product-detail.html">{{ $product['product_name'] }}</a></span>
                                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                                    <span class="product-o__review">(25)</span>
                                                </div>
                                                <span class="product-o__price">
                                                    ₹{{ $product['final_price'] }}
                                                        @if($product['discount_type'])
                                                            <span class="product-o__discount">
                                                                ₹{{ $product['product_price'] }}
                                                            </span></span>
                                                        @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($bestSellers as $product)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item bestsellers">
                                            <div class="product-o product-o--hover-on product-o--radius">
                                                <div class="product-o__wrap">
                                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                                    @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                                                    <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                                                    @else
                                                    <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                                                    @endif
                                                    </a>
                                                </div>
                                                <span class="product-o__category">
                                                <a href="shop-side-version-2.html">{{ $product['brand']['brand_name'] }}</a></span>
                                                <span class="product-o__name">
                                                <a href="product-detail.html">{{ $product['product_name'] }}</a></span>
                                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                                    <span class="product-o__review">(25)</span>
                                                </div>
                                                <span class="product-o__price">
                                                    ₹{{ $product['final_price'] }}
                                                        @if($product['discount_type'])
                                                            <span class="product-o__discount">
                                                                ₹{{ $product['product_price'] }}
                                                            </span></span>
                                                        @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($discountedProducts as $product)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item discountedproducts">
                                            <div class="product-o product-o--hover-on product-o--radius">
                                                <div class="product-o__wrap">
                                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                                    @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                                                    <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                                                    @else
                                                    <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                                                    @endif
                                                    </a>
                                                </div>
                                                <span class="product-o__category">
                                                <a href="shop-side-version-2.html">{{ $product['brand']['brand_name'] }}</a></span>
                                                <span class="product-o__name">
                                                <a href="product-detail.html">{{ $product['product_name'] }}</a></span>
                                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                                    <span class="product-o__review">(25)</span>
                                                </div>
                                                <span class="product-o__price">
                                                    ₹{{ $product['final_price'] }}
                                                        @if($product['discount_type'])
                                                            <span class="product-o__discount">
                                                                ₹{{ $product['product_price'] }}
                                                            </span></span>
                                                        @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @foreach($featuredProducts as $product)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 u-s-m-b-30 filter__item featuredproducts">
                                            <div class="product-o product-o--hover-on product-o--radius">
                                                <div class="product-o__wrap">
                                                    <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                                    @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                                                    <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                                                    @else
                                                    <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                                                    @endif
                                                    </a>
                                                </div>
                                                <span class="product-o__category">
                                                <a href="shop-side-version-2.html">{{ $product['brand']['brand_name'] }}</a></span>
                                                <span class="product-o__name">
                                                <a href="product-detail.html">{{ $product['product_name'] }}</a></span>
                                                <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                                    <span class="product-o__review">(25)</span>
                                                </div>
                                                <span class="product-o__price">
                                                    ₹{{ $product['final_price'] }}
                                                        @if($product['discount_type'])
                                                            <span class="product-o__discount">
                                                                ₹{{ $product['product_price'] }}
                                                            </span></span>
                                                        @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="load-more">
                                <button class="btn btn--e-brand" type="button">View More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== Section 4 ======-->
        <div class="u-s-p-b-60">
            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-46">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">NEW ARRIVALS</h1>
                                <span class="section__span u-c-silver">GET UP FOR NEW ARRIVALS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->
            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="slider-fouc">
                        <div class="owl-carousel product-slider" data-item="4">
                            @foreach($newProducts as $product)
                                <div class="u-s-m-b-30">
                                    <div class="product-o product-o--hover-on product-o--radius">
                                        <div class="product-o__wrap">
                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                            @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                                            <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                                            @else
                                            <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                                            @endif
                                            </a>
                                        </div>
                                        <span class="product-o__category">
                                        <a href="shop-side-version-2.html">{{ $product['brand']['brand_name'] }}</a></span>
                                        <span class="product-o__name">
                                        <a href="product-detail.html">{{ $product['product_name'] }}</a></span>
                                        <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                            <span class="product-o__review">(25)</span>
                                        </div>
                                        <span class="product-o__price">
                                            ₹{{ $product['final_price'] }}
                                                @if($product['discount_type'])
                                                    <span class="product-o__discount">
                                                        ₹{{ $product['product_price'] }}
                                                    </span>
                                                @endif
                                        </span>        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="load-more">
                            <button class="btn btn--e-brand" type="button">View More</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 4 ======-->
        <!--====== Section 5 ======-->
        <div class="u-s-p-b-60">
            <!--====== Section Intro ======-->
            <div class="section__intro u-s-m-b-46">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="section__text-wrap">
                                <h1 class="section__heading u-c-secondary u-s-m-b-12">FEATURED PRODUCTS</h1>
                                <span class="section__span u-c-silver">GET UP FOR FEATURED PRODUCTS</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Intro ======-->
            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="slider-fouc">
                        <div class="owl-carousel product-slider" data-item="4">
                            @foreach($featuredProducts as $product)
                            <div class="u-s-m-b-30">
                                <div class="product-o product-o--hover-on product-o--radius">
                                        <div class="product-o__wrap">
                                            <a class="aspect aspect--bg-grey aspect--square u-d-block" href="product-detail.html">
                                            @if(isset($product['images'][0]['image']) && !empty($product['images'][0]['image']))    
                                            <img class="aspect__img" src="{{ asset('front/images/products/small/'.$product['images'][0]['image']) }}" alt="">
                                            @else
                                            <img class="aspect__img" src="{{ asset('front/images/product/sitemakers-tshirts.png') }}" alt="">
                                            @endif
                                            </a>
                                        </div>
                                        <span class="product-o__category">
                                        <a href="shop-side-version-2.html">{{ $product['brand']['brand_name'] }}</a></span>
                                        <span class="product-o__name">
                                        <a href="product-detail.html">{{ $product['product_name'] }}</a></span>
                                        <div class="product-o__rating gl-rating-style"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                                            <span class="product-o__review">(25)</span>
                                        </div>
                                        <span class="product-o__price">
                                            ₹{{ $product['final_price'] }}
                                                @if($product['discount_type'])
                                                    <span class="product-o__discount">
                                                        ₹{{ $product['product_price'] }}
                                                    </span>
                                                @endif
                                        </span>        
                                    </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="load-more">
                            <button class="btn btn--e-brand" type="button">View More</button>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 5 ======-->

        <!-- TEST -->
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
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 6 ======-->
</div>
@endsection