<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>E-Document Lab</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
    {{ Html::style('css/bootstrap.min.css') }}
    {{ Html::style('css/font-awesome.min.css') }}
    {{ Html::style('css/slick.css') }}
    {{ Html::style('css/slick-theme.css') }}
    {{ Html::style('css/nouislider.min.css') }}
    {{ Html::style('css/main-style.css') }}
    @yield('css')
</head>
<body>
    <header>
        <div id="top-header">
            <div class="container">
                <div class="pull-left">
                    <span>@lang('user.welcome')</span>
                </div>
                <div class="pull-right">
                    <ul class="header-top-links">
                        <li class="dropdown default-dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">@lang('user.VI') <i class="fa fa-caret-down"></i></a>
                            <ul class="custom-menu">
                                <li><a href="#">@lang('user.lang_vi')</a></li>
                                <li><a href="#">@lang('user.lang_en')</a></li>
                            </ul>
                        </li>
                        <li class="dropdown default-dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">@lang('user.VND') <i class="fa fa-caret-down"></i></a>
                            <ul class="custom-menu">
                                <li><a href="#">@lang('user.vnd')</a></li>
                                <li><a href="#">@lang('user.usd')</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="header">
            <div class="container">
                <div class="pull-left">
                    <div class="header-logo">
                        <a class="logo" href="#">
                            <img src="{{ asset('images/logo.png') }}" alt="">
                        </a>
                    </div>
                    <div class="header-search">
                        <form>
                            <input class="input search-input" type="text" placeholder="@lang('user.enter_your_keyword')">
                            <select class="input search-categories">
                                <option value="0">@lang('user.all_categories')</option>
                                <option value="1">Category 01</option>
                                <option value="1">Category 02</option>
                            </select>
                            <button class="search-btn"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="pull-right">
                    <ul class="header-btns">
                        <li class="header-account dropdown default-dropdown">
                            @auth
                                <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                    <div class="header-btns-icon">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                    <strong class="text-uppercase">@lang('user.my_account') <i class="fa fa-caret-down"></i></strong>
                                </div>
                            @endauth
                            @guest
                                <i class="fa fa-user-o">&nbsp;</i><a href="{{ route('login') }}" class="">@lang('user.sign_in')</a> / <a href="{{ route('register') }}" class="">@lang('user.register')</a>
                            @endguest
                            <ul class="custom-menu">
                                <li><a href="#"><i class="fa fa-user-o"></i> @lang('user.my_account')</a></li>
                                <li><a href="#"><i class="fa fa-heart-o"></i> @lang('user.my_favorites')</a></li>
                                <li><a href="#"><i class="fa fa-unlock-alt"></i> @lang('user.sign_in')</a></li>
                                <li><a href="#"><i class="fa fa-user-plus"></i> @lang('user.register')</a></li>
                            </ul>
                        </li>
                        <li class="nav-toggle">
                            <button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
    
    <div id="navigation">
        <div class="container">
            <div id="responsive-nav">
                <div class="category-nav show-on-click">
                    <span class="category-header">@lang('user.categories') <i class="fa fa-list"></i></span>
                    <ul class="category-list">
                        <li class="dropdown side-dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Women’s Clothing <i class="fa fa-angle-right"></i></a>
                            <div class="custom-menu">
                                <div class="row">
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr class="hidden-md hidden-lg">
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr class="hidden-md hidden-lg">
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#">Men’s Clothing</a></li>
                        <li class="dropdown side-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Phones & Accessories <i class="fa fa-angle-right"></i></a>
                            <div class="custom-menu">
                                <div class="row">
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr>
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr class="hidden-md hidden-lg">
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr>
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr>
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#">Computer & Office</a></li>
                        <li><a href="#">Consumer Electronics</a></li>
                        <li class="dropdown side-dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Jewelry & Watches <i class="fa fa-angle-right"></i></a>
                            <div class="custom-menu">
                                <div class="row">
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr>
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr class="hidden-md hidden-lg">
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr>
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr class="hidden-md hidden-lg">
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr>
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#">Bags & Shoes</a></li>
                        <li><a href="#">@lang('user.view_all')</a></li>
                    </ul>
                </div>
                <div class="menu-nav">
                    <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                    <ul class="menu-list">
                        <li><a href="#">@lang('user.home')</a></li>
                        <li class="dropdown mega-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">@lang('user.other_categories') <i class="fa fa-caret-down"></i></a>
                            <div class="custom-menu">
                                <div class="row">
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li><h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr class="hidden-md hidden-lg">
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li><h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                        <hr class="hidden-md hidden-lg">
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="list-links">
                                            <li>
                                                <h3 class="list-links-title">Categories</h3></li>
                                            <li><a href="#">Women’s Clothing</a></li>
                                            <li><a href="#">Men’s Clothing</a></li>
                                            <li><a href="#">Phones & Accessories</a></li>
                                            <li><a href="#">Jewelry & Watches</a></li>
                                            <li><a href="#">Bags & Shoes</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li><a href="#">@lang('user.contact')</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="breadcrumb">
        <div class="container">
            <ul class="breadcrumb">
            </ul>
        </div>
    </div>

    @yield('content')

    <footer id="footer" class="section section-grey">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <div class="footer-logo">
                            <a class="logo" href="#">
                                <h3 class="text-uppercase">@lang('user.e_document_lab')</h3>
                            </a>
                        </div>
                        <p>@lang('user.introduction')</p>
                        <ul class="footer-social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">@lang('user.menu')</h3>
                        <ul class="list-links">
                            <li><a href="#">@lang('user.home')</a></li>
                            <li><a href="#">@lang('user.categories')</a></li>
                            <li><a href="#">@lang('user.about_us')</a></li>
                            <li><a href="#">@lang('user.faq')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clearfix visible-sm visible-xs"></div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">@lang('user.support_customer')</h3>
                        <ul class="list-links">
                            <li><a href="#">@lang('user.contact')</a></li>
                            <li><a href="#">@lang('user.support_online')</a></li>
                            <li><a href="#">@lang('user.contact_advertising')</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <div class="footer">
                        <h3 class="footer-header">@lang('user.stay_connected')</h3>
                        <p>@lang('user.stay_connect_slogan')</p>
                        <form>
                            <div class="form-group">
                                <input class="input" placeholder="@lang('user.enter_email_address')">
                            </div>
                            <button class="primary-btn">@lang('user.receive_news')</button>
                        </form>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="footer-copyright">
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{ Html::script('js/jquery.min.js') }}
    {{ Html::script('js/bootstrap.min.js') }}
    {{ Html::script('js/slick.min.js') }}
    {{ Html::script('js/nouislider.min.js') }}
    {{ Html::script('js/jquery.zoom.min.js') }}
    {{ Html::script('js/jquery.zoom.min.js') }}
    {{ Html::script('js/main.js') }}
    @yield('js')
</body>
</html>
