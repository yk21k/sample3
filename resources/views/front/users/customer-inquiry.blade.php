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

                                    <a href="">Customer Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--====== End - Section 1 ======-->



        <!--====== Section 3 ======-->
        <!-- <div class="u-s-p-b-60"> -->
        <div class="u-s-p-b-60">    
            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 3 ======-->


        <!--====== Section 4 ======-->
        <div class="u-s-p-b-60">

            <!--====== Section Content ======-->
            <div class="section__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-area u-h-100">
                                <div class="contact-area__heading">
                                    <h2>Get In Touch</h2>
                                </div>
                                <p style="font-weight: bold; margin-top: 10px;" id="inqcusto-success"><br></p>
                                <div align="center"><div class="inqcusto-success" style="width:90%;"></div></div>

                                <p id="inqcusto-error"><br></p>
                                <form class="contact-f" id="inqcustoForm" method="post" action="javascript:;">@csrf
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 u-h-100">
                                            <div class="u-s-m-b-30">
                                                <h3>Customer</h3>
                                                <input class="" type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}" readonly="">
                                                <label for="c-subject"></label>

                                                <input class="input-text input-text--border-radius input-text--primary-style" type="text" id="c-subject" name="inq_subject" placeholder="Subject (Required)" required>
                                                <p id="inqcusto-inq_subject"></p>

                                            </div>
                                            <div class="u-s-m-b-30">

                                                <label for="c-message"></label><textarea class="text-area text-area--border-radius text-area--primary-style" id="c-message" name="inquiry_details" placeholder="Compose a Message (Required)" required></textarea>
                                                <p id="inqcusto-inquiry_details"></p>

                                            </div>
                                        </div>    
                                        <div class="col-lg-12">
                                            <button class="btn btn--e-brand-b-2" type="submit">Send Message</button>
                                        </div>
                                    </div>
                                </form>
                                <form class="contact-f">
                                        <div class="col-lg-6 col-md-6 u-h-100">
                                            <div class="u-s-m-b-30">
                                                <h3>Answer</h3>
                                                <label for="c-subject"></label>

                                                <input class="input-text input-text--border-radius input-text--primary-style" type="text" id="c-subject" name="ans_subject"placeholder="Subject (Required)" readonly>
                                            </div>
                                            <div class="u-s-m-b-60">
                                                
                                                <label for="c-message"></label><textarea class="text-area text-area--border-radius text-area--primary-style" id="c-message" name="answer" placeholder="Compose a Message (Required)" readonly></textarea>
                                            </div>
                                        </div>
                                </form>        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--====== End - Section Content ======-->
        </div>
        <!--====== End - Section 4 ======-->
    </div>
    <!--====== End - App Content ======-->
@endsection