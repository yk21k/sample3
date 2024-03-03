<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="UTF-8">
        <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <![endif]-->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- <meta name="viewport" content="width=device-width"> -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="">
        <meta name="author" content="SiteMakers.in">
        <link href="images/favicon.png" rel="shortcut icon">
        <title>Test Page</title>
        <!-- Thanks<title>Laravel E-commerce Template - By SiteMakers.in</title> -->
        <!--====== Google Font ======-->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">
        <!--====== Vendor Css ======-->
        <link rel="stylesheet" href="{{ url('front/css/vendor.css') }}">
        <!--====== Utility-Spacing ======-->
        <link rel="stylesheet" href="{{ url('front/css/utility.css') }}">
        <!--====== App ======-->
        <link rel="stylesheet" href="{{ url('front/css/app.css') }}">
        <!-- ====== Custom ====-->
        <link rel="stylesheet" href="{{ url('front/css/custom.css') }}">

        <!-- ======  Header Custom CSS ====== -->
        <link rel="stylesheet" href="{{ url('front/css/headercustom.css') }}">

        <!-- ====== 3D CSS ======-->
        <link rel="stylesheet" href="{{ url('front/css/custom3d.css') }}">

        <!-- Cookie Consent -->
        <link rel="stylesheet" href="{{ url('front/css/cookie_consent.css') }}">

        <!-- Handling of personal information -->
        <link rel="stylesheet" href="{{ url('front/css/personal_info.css') }}">

    </head>
    <body class="config">
            
        <div class="loader" type="hidden">
           <img src="{{ asset('front/images/loader6.webp') }}" alt="loading..." />
        </div>
        <div class="preloader is-active">
            <div class="preloader__wrap">
                <img class="preloader__img" src="{{ asset('front/images/preloader.png') }}" alt="">
            </div>
        </div>
        <!--====== Main App ======-->
        <div id="app">
            <!--====== Main Header ======-->

            @include('front.layout.header')

            <!--====== End - Main Header ======-->

            <!--====== App Content ======-->

            @yield('content')

            <!--====== End - App Content ======-->

            <!--====== Main Footer ======-->

            @include('front.layout.footer')

            <!--====== Modal Section ======-->

            <!--====== Newsletter Subscribe Modal ======-->

            <!-- @include('front.newsletter') -->

            <!--====== End - Newsletter Subscribe Modal ======-->
            
            <!--====== End - Modal Section ======-->
            <div class="wrapper">
                <header>
                    <i class="fas fa-cookie-bite"></i>
                    <h2>Cookie Consent</h2>
                </header>

                <div class="data">This website uses cookies or similar technologies, to enhance your browsing experience and provide personalized recommendations. By continuing to use our website, you agree to our<a style="color:#fff;" href="{{ url('cookie-policy') }}">  Cookie Policy</a></p></div>

                 <div class="buttons">
                     <button class="button" id="acceptBtn">Accept</button>
                     <button class="button">Decline</button>
                 </div>

            </div>    
        </div>
        <!-- <div class="cookie-consent">
            <div class="cookie-text">This site uses cookies. For more information about the use of cookies Please refer to the「<a href="{{ url('privacy-policy') }}">privacy policy</a>」.</div>
            <div class="cookie-agree">OK</div>
        </div> -->

        <!-- <div id="cookieNotice" class="light display-right" style="display: none;">
            <div class="wrapper">
                <header>
                    <i class="fas fa-cookie-bite"></i>
                </header>
            </div>
            <div id="closeIcon" style="display: none;">
            </div>
            <div class="title-wrap">
                <h4>Cookie Consent</h4>
            </div>
            <div class="content-wrap">
                <div class="msg-wrap">
                    <p>This website uses cookies or similar technologies, to enhance your browsing experience and provide personalized recommendations. By continuing to use our website, you agree to our  <a style="color:#115cfa;" href="{{url('privacy-policy') }}">Privacy Policy</a></p>
                    <div class="btn-wrap">
                        <button class="btn-primary" onclick="acceptCookieConsent();">Accept</button>
                    </div>
                </div>
            </div>
        </div> -->

        
        
        <!--====== End - Main App ======-->

        <!--====== Noscript ======-->
        <noscript>
            <div class="app-setting">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="app-setting__wrap">
                                <h1 class="app-setting__h1">JavaScript is disabled in your browser.</h1>
                                <span class="app-setting__text">Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </noscript>
        <!--====== Google Analytics: change UA-XXXXX-Y to be your site's ID ======-->
        <script>
            window.ga = function() {
                ga.q.push(arguments)
            };
            ga.q = [];
            ga.l = +new Date;
            ga('create', 'UA-XXXXX-Y', 'auto');
            ga('send', 'pageview')
        </script>
        <script src="https://www.google-analytics.com/analytics.js" async defer></script>
        <!--====== Vendor Js ======-->
        <script src="{{ url('front/js/vendor.js') }}"></script>
        <!--====== jQuery Shopnav plugin ======-->
        <script src="{{ url('front/js/jquery.shopnav.js') }}"></script>
        <!--====== App ======-->
        <script src="{{ url('front/js/app.js') }}"></script>

        <!--====== Custom Js ======-->
        <script src="{{ url('front/js/custom.js') }}"></script>

        <!--====== Custom 3DJs ======-->
        <script src="{{ url('front/js/custom3d.js') }}"></script>

        <!--====== Filters ======-->
        <script src="{{ url('front/js/filters.js') }}"></script>

        <!-- ===== Cookie Consent -->
        <script src="{{ url('front/js/cookie_consent.js') }}"></script>

        <!-- Handling of personal information -->
        <script src="{{ url('front/js/personal_info.js') }}"></script>
    </body>
</html>