@extends('front.layout.layout')
@section('content')


<!--====== App Content ======-->
<div class="app-content">

    <!--====== Section 1 ======-->
    <div class="u-s-p-y-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="breadcrumb">
                    <div class="breadcrumb__wrap">
                        <ul class="breadcrumb__list">
                            <li class="has-separator">

                                <a href="{{ url('/') }}">Home</a></li>
                            <li class="is-marked">

                                <a href="">Search</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====== End - Section 1 ======-->


    <!--====== Section 2 ======-->
    <div class="u-s-p-b-60">

        <!--====== Section Content ======-->
        <div class="section__content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="about">
                            <div class="about__container">
                                <div class="about__info">
                                    <h2 class="about__h2">These are the results of the --{{ $keyword }}-- search you entered!</h2>
                            		
                                    <button class="" style="color: aquamarine;" href="{{ url('/') }}" target="_blank">Continue Shopping</button>
                                </div>
                                <div>
                                	<a 
                            			class="" 
                            			style="
                            				height: 100px;
    										width: 100px;
                            				justify-content: center;
                            				align-items: center;
                            		">
										@foreach($searchPosts as $searchProduct)
											<a>Name:{{ $searchProduct->product_name }}</a>
											<a>Color:{{ $searchProduct->product_color }}</a>
										@endforeach
									</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section Content ======-->
    </div>
    <!--====== End - Section 2 ======-->

</div>
<!--====== End - App Content ======-->

<div class="table-responsive">



@endsection