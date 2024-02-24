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
	                        
	                        
		                        <a href="{{ url('/cart') }}"><strong><h2>No</h2></strong></a><br><br>
		                        <div style="background-color:dodgerblue; color:whitesmoke; text-align: center;"><h3>If you really want to withdraw from membership&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Information on withdrawal)</h3></div>
		                        <div style="background-color: lightcyan; color:wdarkturquoise; text-align: center;"><h3></h3></div>
		                        <div style="background-color: darksalmon; color:whitesmoke; text-align: center;"><h4>As stated in the terms and conditions, even if you withdraw your membership, we will not be able to cancel or return any products that have been paid.</h4></div>
		                        

		                        
	                            <div >
	                                <form id="withdrawal-form" action="{{ route('user.withdrawal') }}" method="post" style="display:none;">{{ csrf_field() }}</form>
									<a href="{{ route('user.withdrawal') }}" onclick="alert('(Tentative) If there are any items in your cart, they will remain unpaid. Even if you withdraw from membership after payment has been made, cancellations and returns are not possible.thank you very much. Until next registration, goodbye');event.preventDefault();document.getElementById('withdrawal-form').submit();"><h3>Withdrawal</h3></a>
	                                
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!--====== End - Section Intro ======-->
	        <!--====== Section Content ======-->
			
				
			</div>		        
	        <!--====== End - Section Content ======-->
	    <!--====== End - Section 2 ======-->
	</div>
<!--====== End - App Content ======-->



@endsection