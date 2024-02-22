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

	                                <a href="{{ url('user/register') }}">Signup</a></li>
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
	        <div class="section__intro u-s-m-b-60">
	            <div class="container">
	                <div class="row">
	                    <div class="col-lg-12">
	                        <div class="section__text-wrap">
	                            <h1 class="section__heading u-c-secondary">CREATE AN ACCOUNT</h1>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <!--====== End - Section Intro ======-->


	        <!--====== Section Content ======-->
	        <div class="section__content">
	            <div class="container">
	                <div class="row row--center">
	                    <div class="col-lg-6 col-md-8 u-s-m-b-30">
	                        <div class="l-f-o">
	                            <div class="l-f-o__pad-box">
	                                <h1 class="gl-h1">PERSONAL INFORMATION</h1>
	                                <p id="register-success"></p>
	                                <form id="registerForm" action="javascript:;" method="post" class="l-f-o__form">@csrf
	                                    <div class="u-s-m-b-30">

	                                        <label class="gl-label" for="reg-fname">NAME *</label>

	                                        <input class="input-text input-text--primary-style" type="text" id="reg-name" name="name" placeholder="Name">
	                                        <p id="register-name"></p>
	                                    </div>
	                                    <div class="u-s-m-b-30">

	                                        <label class="gl-label" for="reg-mobile">MOBILE *</label>

	                                        <input class="input-text input-text--primary-style" type="text" id="reg-mobile" name="mobile" placeholder="MOBILE">
	                                        <p id="register-mobile"></p>
	                                    </div>
	                                    <div class="u-s-m-b-30">

	                                        <label class="gl-label" for="reg-email">E-MAIL *</label>

	                                        <input class="input-text input-text--primary-style" type="email" id="reg-email" name="email" placeholder="Enter E-mail">
	                                        <p id="register-email"></p>
	                                    </div>
	                                    <div class="u-s-m-b-30">

	                                        <label class="gl-label" for="reg-password">PASSWORD *</label>

	                                        <input class="input-text input-text--primary-style" type="password" id="reg-password" name="password" placeholder="Enter Password">
	                                        <p id="register-password"></p>

	                                    </div>
	                                    <div class="u-s-m-b-15">

	                                        <button class="btn btn--e-transparent-brand-b-2" type="submit">CREATE</button>
	                                    </div>

	                                    <a class="gl-link" href="{{ url('user/login')}}">Already have an Account? Login Now</a>
	                                </form>
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
<!-- modal -->
<div class="modal-overlay">
      <div class="modal-container">
        <div class="modal-inner">
          <div class="modal-title"><h1><strong>TEST Please do not register as a member yet as I am currently studying. Thank you for your cooperation. I don't think so, but if you do, we will not use it and will delete it.

          (entative)Purpose of use of provisional personal information(Tentative)</strong>
        	</h1></div> <div><a href="{{ url('/') }}"><h3>Back to Top Page</h3></a></div>
		        <div class="modal-text">

							This site may require you to enter personal information such as your name and email address when registering as a member (inquiries or posting comments).

							The acquired personal information will be used only for necessary communications and will not be used for any other purpose.

							Regarding disclosure of personal information to third parties

							Acquired personal information will be managed appropriately and will not be disclosed to third parties except in the following cases.

							<li>When the consent of the person is obtained</li>

							<li>When disclosure is required by law</li>
				  	</div>
			  
	          <div>
					    <input type="checkbox" id="agree"/>
					    <label for="agree">agree</label>
		          <button class="modal1-close" id="modal1-close" disabled>close</button>
			   		</div>
        </div>
    </div>
 </div>
 <!-- end modal -->
@endsection