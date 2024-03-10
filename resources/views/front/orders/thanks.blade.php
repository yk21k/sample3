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

                                <a href="">Thanks</a></li>
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
                                    <h2 class="about__h2">YOUR ORDER HAS BEEN PALCED SUCCESSFULLY!</h2>
                                    <div class="about__p-wrap">
                                        <p class="about__p">Your Order ID is {{ Session::get('order_id') }} and Grand Total is INR {{ Session::get('grand_total') }}</p>
                                    </div>

                                    <a class="about__link btn--e-secondary" href="{{ url('/') }}" target="_blank">Continue Shopping</a>
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

@endsection