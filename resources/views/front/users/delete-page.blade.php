@extends('front.layout.layout')
@section('content')

<!--====== App Content ======-->
	<div class="app-content">
	    <!--====== Section 1 ======-->
	    <div class="u-s-p-y-10">
	        <!--====== Section Content ======-->
	        <div class="section__content">
	            <div class="container">
	                <div class="breadcrumb">
	                    <div class="breadcrumb__wrap">
	                        <ul class="breadcrumb__list">
	                            <li class="has-separator">

	                                <a href="{{ url('/') }}">Home</a></li>
	                            <li class="is-marked">

	                                <a href="{{ url('user/login')}}">Signin</a></li>
	                        </ul>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <!--====== End - Section 1 ======-->
	    <!--====== Section 2 ======-->
	    <div class="u-s-p-b-60">

	        <!--====== Section Intro ======-->
	        <div class="section__intro u-s-m-b-30">
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-12">
	                        <div class="section__text-wrap">
	                            <h1 class="section__heading u-c-secondary">Are you sure you want to proceed with the withdrawal procedure?</h1>
	                        
	                        
	                        <a href="{{ url('/cart') }}"><strong><h2>No</h2></strong></a>
	                        <div class="modal-open">Yes</div>
	                        <!-- <div class="withdrawal-triger"><h3>Yes</h3></div> -->
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!--====== End - Section Intro ======-->
	        <!--====== Section Content ======-->
			
				<div class="modal-container">

				  <div class="modal-body">
				    <div class="modal-close">×</div>
		    		<div><a href="{{ url('/') }}"><h3>Back to Top Page</h3></a></div>

				    <div class="modal-content">

				    	<div class="section__content">
				            <div class="container">
				                <div class="row row--center">
				                    <div class="col-lg-6 col-md-8 u-s-m-b-30">
				                        <div class="l-f-o">
				                            <div class="l-f-o__pad-box">
				                                <form id="withdrawal-form" action="{{ route('user.withdrawal') }}" method="post" style="display:none;">{{ csrf_field() }}</form>
												<a href="{{ route('user.withdrawal') }}" onclick="alert('(Tentative) If there are any items in your cart, they will remain unpaid. Even if you withdraw from membership after payment has been made, cancellations and returns are not possible.thank you very much. Until next registration, goodbye');event.preventDefault();document.getElementById('withdrawal-form').submit();"><h3>Withdrawal</h3></a>
				                                
				                            </div>
				                        </div>
				                    </div>
				                </div>
				            </div>
	        			</div>

				    </div>
				  </div>
				</div>
			</div>		        
	        <!--====== End - Section Content ======-->
	    <!--====== End - Section 2 ======-->
	</div>
<!--====== End - App Content ======-->



@endsection