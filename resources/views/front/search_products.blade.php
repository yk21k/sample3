@extends('front.layout.layout')
@section('content')

<style>
.flex__box{
  display: flex;
  flex-direction: column;	
}

.btn__back a {
    position: relative;
    display: flex;
    justify-content: space-around;
    align-items: center;
    margin: 0 auto;
    max-width: 240px;
    padding: 10px 25px;
    color: #313131;
    transition: 0.3s ease-in-out;
    font-weight: 500;
}

.btn__back a::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  background-color: rgba(107,182,255, 0.2);
  transition: all 0.3s;
}
.btn__back a:hover::before {
  opacity: 0;
  transform: scale(0.4, 0.4);
}
.btn__back a::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 1;
  opacity: 0;
  transition: all 0.3s;
  border: 2px solid rgb(107,182,255, .4);
  transform: scale(1.2, 1.2);
}
.btn__back a:hover::after {
  opacity: 1;
  transform: scale(1, 1);
}

</style>

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
                            		<div class="btn__back">
                                    	<a href="{{ url('/') }}" target="_blank">Continue Shopping</a>
                                	</div>
                                </div>
                            	<ul class="flex__box"> 
									@foreach($searchPosts as $searchProduct)
										<li><strong>Name:</strong><a href="{{ url('product/'.$searchProduct['id']) }}">{{ $searchProduct->product_name }}</a> <strong>Color:</strong><a href="{{ url('product/'.$searchProduct['id']) }}">{{ $searchProduct->product_color }}</a></li>
									@endforeach
								</ul>
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