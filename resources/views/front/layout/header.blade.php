<?php
    use App\Models\ProductsFilter; 
    use App\Models\Category;

    // Get Categories and their Sub Categories
    $categories = Category::getCategories();
    // echo "<pre>"; print_r($categories);die;

    $totalCartItems = totalCartItems();
?>

<header class="header--style-1">
    <!--====== Nav 1 ======-->
    <nav class="primary-nav primary-nav-wrapper--border nav1color">
        <div class="container">
            <!--====== Primary Nav ======-->
            <div class="primary-nav">
                <!--====== Main Logo ======-->
                <a class="main-logo" href="{{ url('/') }}">
                <img src="{{ asset('front/images/logo/logo-1.png') }}" alt=""></a>
                <!--====== End - Main Logo ======-->
                <!--====== Search Form ======-->
                <form class="main-form">
                    <label for="main-search"></label>
                    <input class="input-text input-text--border-radius input-text--style-1" type="text" id="main-search" placeholder="Search">
                    <button class="btn btn--icon fas fa-search main-search-button" type="submit"></button>
                </form>
                <!--====== End - Search Form ======-->
                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation">
                    <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-cogs" type="button"></button>
                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">
                        <span class="ah-close">✕ Close</span>
                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                            <li class="has-dropdown" data-tooltip="tooltip" data-placement="left" title="Account">
                                <a><i class="far fa-user-circle"></i></a>
                                <!--====== Dropdown ======-->
                                <span class="js-menu-toggle"></span>
                                <ul style="width:120px">
                                    @if(Auth::check())
                                        <li>
                                            <a href="{{ url('user/account') }}"><i class="fas fa-user-circle u-s-m-r-6"></i>
                                            <span>Account</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ url('user/logout') }}"><i class="fas fa-lock-open u-s-m-r-6"></i>
                                            <span>Signout</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ url('user/delete-page') }}"><i class="fas fa-square-full "></i>
                                                <span>Withdrawal</span></a>
                                                
                                            
                                        </li>
                                    @else
                                        <li>
                                            <a href="{{ url('user/register') }}"><i class="fas fa-user-plus u-s-m-r-6"></i>
                                            <span>Signup</span></a>
                                        </li>
                                        <li>
                                            <a href="{{ url('user/login') }}"><i class="fas fa-lock u-s-m-r-6"></i>
                                            <span>Signin</span></a>
                                        </li>
                                    @endif
                                </ul>
                                <!--====== End - Dropdown ======-->
                            </li>
                            <li data-tooltip="tooltip" data-placement="left" title="Contact">
                                <a href="tel:+0900000000"><i class="fas fa-phone-volume"></i></a>
                            </li>
                            <li data-tooltip="tooltip" data-placement="left" title="Mail">
                                <a href="mailto:contact@domain.com"><i class="far fa-envelope"></i></a>
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->
            </div>
            <!--====== End - Primary Nav ======-->
        </div>
    </nav>
    <!--====== End - Nav 1 ======-->
    <!--====== Nav 2 ======-->
    <nav class="secondary-nav-wrapper nav2color">
        <div class="container">
            <!--====== Secondary Nav ======-->
            <div class="secondary-nav">
                <!--====== Dropdown Main plugin ======-->
                <?php /*
                <div class="menu-init" id="navigation1">
                    <!-- <button class="btn btn--icon toggle-mega-text toggle-button" type="button">M</button> -->
                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">
                        <span class="ah-close">✕ Close</span>
                        <!--====== List ======-->
                        <ul class="ah-list">
                            <li class="has-dropdown">
                                <!-- <span class="mega-text">M</span> -->
                                <!--====== Mega Menu ======-->
                                <span class="js-menu-toggle"></span>
                                <div class="mega-menu">
                                    <div class="mega-menu-wrap">
                                        <div class="mega-menu-list">
                                            <ul>
                                                <li class="js-active">
                                                    <a href=""><i class="fas fa-tv u-s-m-r-6"></i>
                                                    <span>Electronics</span></a>
                                                    <span class="js-menu-toggle js-toggle-mark"></span>
                                                </li>
                                                <li>
                                                    <a href=""><i class="fas fa-female u-s-m-r-6"></i>
                                                    <span>Women's Clothing</span></a>
                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>
                                                    <a href=""><i class="fas fa-male u-s-m-r-6"></i>
                                                    <span>Men's Clothing</span></a>
                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/') }}"><i class="fas fa-utensils u-s-m-r-6"></i>
                                                    <span>Food & Supplies</span></a>
                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/') }}"><i class="fas fa-couch u-s-m-r-6"></i>
                                                    <span>Furniture & Decor</span></a>
                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/') }}"><i class="fas fa-football-ball u-s-m-r-6"></i>
                                                    <span>Sports & Game</span></a>
                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/') }}"><i class="fas fa-heartbeat u-s-m-r-6"></i>
                                                    <span>Beauty & Health</span></a>
                                                    <span class="js-menu-toggle"></span>
                                                </li>
                                            </ul>
                                        </div>
                                        <!--====== Electronics ======-->
                                        <div class="mega-menu-content js-active">
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">3D PRINTER & SUPPLIES</a>
                                                        </li>
                                                        <li>
                                                            <a href="">3d Printer</a>
                                                        </li>
                                                        <li>
                                                            <a href="">3d Printing Pen</a>
                                                        </li>
                                                        <li>
                                                            <a href="">3d Printing Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="">3d Printer Module Board</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">HOME AUDIO & VIDEO</a>
                                                        </li>
                                                        <li>
                                                            <a href="">TV Boxes</a>
                                                        </li>
                                                        <li>
                                                            <a href="">TC Receiver & Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Display Dongle</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Home Theater System</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">MEDIA PLAYERS</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Earphones</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Mp3 Players</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Speakers & Radios</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Microphones</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">VIDEO GAME ACCESSORIES</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Nintendo Video Games Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Sony Video Games Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Xbox Video Games Accessories</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">SECURITY & PROTECTION</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Security Cameras</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Alarm System</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Security Gadgets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">CCTV Security & Accessories</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">PHOTOGRAPHY & CAMERA</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Digital Cameras</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Sport Camera & Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Camera Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Lenses & Accessories</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">ARDUINO COMPATIBLE</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Raspberry Pi & Orange Pi</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Module Board</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Smart Robot</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Board Kits</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">DSLR Camera</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Nikon Cameras</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Canon Camera</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Sony Camera</a>
                                                        </li>
                                                        <li>
                                                            <a href="">DSLR Lenses</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">NECESSARY ACCESSORIES</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Flash Cards</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Memory Cards</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Flash Pins</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Compact Discs</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-9 mega-image">
                                                    <div class="mega-banner">
                                                        <a class="u-d-block" href="">
                                                        <img class="u-img-fluid u-d-block" src="{{ asset('front/images/banners/sitemaker-slider-banner-1.png') }}" alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                        </div>
                                        <!--====== End - Electronics ======-->
                                        <!--====== Women ======-->
                                        <div class="mega-menu-content">
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">
                                                        <a class="u-d-block" href="">
                                                        <img class="u-img-fluid u-d-block" src="{{ asset('front/images/banners/sitemaker-slider-banner-1.png') }}" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">
                                                        <a class="u-d-block" href="">
                                                        <img class="u-img-fluid u-d-block" src="{{ asset('front/images/banners/sitemaker-slider-banner-1.png') }}" alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">HOT CATEGORIES</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Dresses</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Blouses & Shirts</a>
                                                        </li>
                                                        <li>
                                                            <a href="">T-shirts</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Rompers</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">INTIMATES</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Bras</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Brief Sets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Bustiers & Corsets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Panties</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">WEDDING & EVENTS</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Wedding Dresses</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Evening Dresses</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Prom Dresses</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Flower Dresses</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">BOTTOMS</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Skirts</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Shorts</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Leggings</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Jeans</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">OUTWEAR</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Blazers</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Basics Jackets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Trench</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Leather & Suede</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">JACKETS</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Denim Jackets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Trucker Jackets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Windbreaker Jackets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Leather Jackets</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">ACCESSORIES</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Tech Accessories</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Headwear</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Baseball Caps</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Belts</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">OTHER ACCESSORIES</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Bags</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Wallets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Watches</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Sunglasses</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-9 mega-image">
                                                    <div class="mega-banner">
                                                        <a class="u-d-block" href="">
                                                        <img class="u-img-fluid u-d-block" src="{{ asset('front/images/banners/sitemaker-slider-banner-1.png') }}" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 mega-image">
                                                    <div class="mega-banner">
                                                        <a class="u-d-block" href="">
                                                        <img class="u-img-fluid u-d-block" src="{{ asset('front/images/banners/sitemaker-slider-banner-1.png') }}" alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                        </div>
                                        <!--====== End - Women ======-->
                                        <!--====== Men ======-->
                                        <div class="mega-menu-content">
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-4 mega-image">
                                                    <div class="mega-banner">
                                                        <a class="u-d-block" href="">
                                                        <img class="u-img-fluid u-d-block" src="{{ asset('front/images/banners/sitemaker-slider-banner-1.png') }}" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mega-image">
                                                    <div class="mega-banner">
                                                        <a class="u-d-block" href="">
                                                        <img class="u-img-fluid u-d-block" src="{{ asset('front/images/banners/sitemaker-slider-banner-1.png') }}" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mega-image">
                                                    <div class="mega-banner">
                                                        <a class="u-d-block" href="">
                                                        <img class="u-img-fluid u-d-block" src="{{ asset('front/images/banners/sitemaker-slider-banner-1.png') }}" alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">HOT SALE</a>
                                                        </li>
                                                        <li>
                                                            <a href="">T-Shirts</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Tank Tops</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Polo</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Shirts</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">OUTWEAR</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Hoodies</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Trench</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Parkas</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Sweaters</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">BOTTOMS</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Casual Pants</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Cargo Pants</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Jeans</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Shorts</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">UNDERWEAR</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Boxers</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Briefs</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Robes</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Socks</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">JACKETS</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Denim Jackets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Trucker Jackets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Windbreaker Jackets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Leather Jackets</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">SUNGLASSES</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Pilot</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Wayfarer</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Square</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Round</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">ACCESSORIES</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Eyewear Frames</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Scarves</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Hats</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Belts</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-lg-3">
                                                    <ul>
                                                        <li class="mega-list-title">
                                                            <a href="">OTHER ACCESSORIES</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Bags</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Wallets</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Watches</a>
                                                        </li>
                                                        <li>
                                                            <a href="">Tech Accessories</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                            <br>
                                            <!--====== Mega Menu Row ======-->
                                            <div class="row">
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">
                                                        <a class="u-d-block" href="">
                                                        <img class="u-img-fluid u-d-block" src="{{ asset('front/images/banners/sitemaker-slider-banner-1.png') }}" alt=""></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 mega-image">
                                                    <div class="mega-banner">
                                                        <a class="u-d-block" href="">
                                                        <img class="u-img-fluid u-d-block" src="{{ asset('front/images/banners/sitemaker-slider-banner-1.png') }}" alt=""></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--====== End - Mega Menu Row ======-->
                                        </div>
                                        <!--====== End - Men ======-->
                                        <!--====== No Sub Categories ======-->
                                        <div class="mega-menu-content">
                                            <h5>No Categories</h5>
                                        </div>
                                        <!--====== End - No Sub Categories ======-->
                                        <!--====== No Sub Categories ======-->
                                        <div class="mega-menu-content">
                                            <h5>No Categories</h5>
                                        </div>
                                        <!--====== End - No Sub Categories ======-->
                                        <!--====== No Sub Categories ======-->
                                        <div class="mega-menu-content">
                                            <h5>No Categories</h5>
                                        </div>
                                        <!--====== End - No Sub Categories ======-->
                                        <!--====== No Sub Categories ======-->
                                        <div class="mega-menu-content">
                                            <h5>No Categories</h5>
                                        </div>
                                        <!--====== End - No Sub Categories ======-->
                                    </div>
                                </div>
                                <!--====== End - Mega Menu ======-->
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div> */ ?>
                <!--====== End - Dropdown Main plugin ======-->
                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation2">
                    <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-cog" type="button"></button>
                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">
                        <span class="ah-close">✕ Close</span>
                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design2 ah-list--link-color-secondary">
                            <li>
                                <a href="">NEW ARRIVALS(in preparation)</a>
                            </li>
                            @foreach($categories as $category)
                                <li class="has-dropdown">
                                    <a href="{{ url($category['url']) }}">{{ $category['category_name'] }} @if(count($category['subcategories'])) <i class="fas fa-angle-down u-s-m-l-6" ></i>@endif</a>
                                    @if(count($category['subcategories']))
                                    <!--====== Dropdown ======-->
                                    <span class="js-menu-toggle"></span>
                                    <ul style="width:170px">
                                        @foreach($category['subcategories'] as $subcategory)
                                        <li class="has-dropdown has-dropdown--ul-left-100">
                                            <a href="{{ url($subcategory['url']) }}">{{ $subcategory['url'] }}<i class="fas fa-angle-down i-state-right u-s-m-l-6"></i></a>
                                            @if(count($subcategory['subcategories']))
                                            <!--====== Dropdown ======-->
                                            <span class="js-menu-toggle"></span>
                                            <ul style="width:118px">
                                                @foreach($subcategory['subcategories'] as $subsubcategory)
                                                <li>
                                                    <a href="{{ url($subsubcategory['url']) }}">{{ $subsubcategory['category_name'] }}</a>
                                                </li>
                                                @endforeach
                                            </ul>
                                            <!--====== End - Dropdown ======-->
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                    <!--====== End - Dropdown ======-->
                                    @endif
                                </li>
                            @endforeach    
                            <li>
                                <a href="listing.html">FEATURED PRODUCTS(in preparation)</a>
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->
                <!--====== Dropdown Main plugin ======-->
                <div class="menu-init" id="navigation3">
                    <button class="btn btn--icon toggle-button toggle-button--secondary fas fa-shopping-bag toggle-button-shop" type="button"></button>
                    <span class="total-item-round totalCartItems">{{ $totalCartItems }}</span>
                    <!--====== Menu ======-->
                    <div class="ah-lg-mode">
                        <span class="ah-close">✕ Close</span>
                        <!--====== List ======-->
                        <ul class="ah-list ah-list--design1 ah-list--link-color-secondary">
                            <li>
                                <a href="{{ url('/') }}"><i class="fas fa-home u-c-brand"></i></a>
                            </li>
                            <li>
                                <a href="wishlist.html"><i class="far fa-heart"></i></a>
                            </li>
                            <li class="has-dropdown">
                                <a class="mini-cart-shop-link"><i class="fas fa-shopping-bag"></i>
                                <span class="total-item-round totalCartItems">{{ $totalCartItems }}</span></a>
                                <!--====== Dropdown ======-->
                                <span class="js-menu-toggle"></span>
                                <div class="mini-cart" id="appendMiniCartItems">
                                    @include('front.layout.header_cart_items')
                                </div>
                                <!--====== End - Dropdown ======-->
                            </li>
                        </ul>
                        <!--====== End - List ======-->
                    </div>
                    <!--====== End - Menu ======-->
                </div>
                <!--====== End - Dropdown Main plugin ======-->
            </div>
            <!--====== End - Secondary Nav ======-->
        </div>
    </nav>
    <!--====== End - Nav 2 ======-->
</header>