<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>E-Document Lab</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Hind:400,700" rel="stylesheet">
    {{ Html::style('css/bootstrap.min.css') }}
    {{ Html::style('css/font-awesome.min.css') }}
    {{ Html::style('css/pretty-checkbox.min.css') }}
    {{ Html::style('css/slick.css') }}
    {{ Html::style('css/slick-theme.css') }}
    {{ Html::style('css/nouislider.min.css') }}
    {{ Html::style('css/main-style.css') }}
    {{ Html::style('css/bootstrap-datepicker.min.css') }}
    {{ Html::style('css/dataTables.bootstrap.css') }}
    {{ Html::style('css/new-style.css') }}
    @stack('css')
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
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">{{ App::getLocale() }} <i class="fa fa-caret-down"></i></a>
                            <ul class="custom-menu">
                                <li><a href="{{ route('set-locale', config('settings.locale.vi')) }}">@lang('user.lang_vi')</a></li>
                                <li><a href="{{ route('set-locale', config('settings.locale.en')) }}">@lang('user.lang_en')</a></li>
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
                        <a class="logo" href="{{ route('home') }}">
                            <img src="{{ asset('images/logo.png') }}" alt="">
                        </a>
                    </div>
                    <div class="header-search">
                        <form action="{{ route('search-document') }}" method="GET">
                            <input class="input search-input" name="keyword" id="search-input" data-url="{{ route('ajax-live-search') }}" type="text" autocomplete="off" placeholder="@lang('user.enter_your_keyword')">
                            <ul class="live-search">
                            </ul>
                            <select class="input search-categories" name="category">
                                <option value="all">@lang('user.search.by_all')</option>
                                @foreach ($categories as $parentCategory)
                                    <option value="{{ $parentCategory->slug }}">{{ $parentCategory->name }}</option>
                                @endforeach
                            </select>
                            <button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="pull-right">
                    <ul class="header-btns">
                        @auth
                        <li class="header-cart dropdown default-dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <div class="header-btns-icon" data-url="{{ route('ajax-read-all-notification') }}" id="notification-user" data-user="{{ auth()->user()->id }}">
                                    <i class="fa fa-bell"></i>
                                    <span class="qty number-new-notification">{{ $notifications->where('status', 0)->count() }}</span>
                                </div>
                            </a>
                            <div class="custom-menu">
                                <div id="shopping-cart">
                                    <div class="notification-header">
                                        @lang('user.notifications')
                                    </div>
                                    <hr>
                                    <div class="shopping-cart-list list-notification">
                                        @foreach ($notifications as $notification)
                                            <div class="product product-widget notification-item">
                                                <p>{{ $notification->message }}</p>
                                                <b>{{ $notification->notification_at }}</b>
                                            </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="notification-footer">
                                        @lang('user.view_all') <i class="fa fa-angle-right"></i>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endauth
                        <li class="header-account dropdown default-dropdown">
                            @auth
                                <div class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="true">
                                    <div class="header-btns-icon">
                                        <i class="fa fa-user-o"></i>
                                    </div>
                                    <strong class="menu-profile">@lang('user.my_account') <i class="fa fa-caret-down"></i></strong>
                                </div>
                                <ul class="custom-menu">
                                @if (Auth::user()->isAdmin() || Auth::user()->isModerator())
                                    <li><a href="{{ route('dashboard.index') }}" class="text-lowercase"><i class="fa fa-university"></i> @lang('admin.dashboard')</a></li>
                                @endif
                                <li><a href="{{ route('manage-profile') }}" class="text-lowercase"><i class="fa fa-user"></i> @lang('user.my_account')</a></li>
                                <li><a href="{{ route('bookmark-document.index') }}" class="text-lowercase"><i class="fa fa-heart"></i> @lang('user.document_bookmarks')</a></li>
                                <li><a href="{{ route('document.index') }}" class="text-lowercase"><i class="fa fa-cloud-upload"></i> @lang('user.upload')</a></li>
                                <li><a href="{{ route('logout') }}" class="text-lowercase"><i class="glyphicon glyphicon-off"></i> @lang('user.logout')</a></li>
                            </ul>
                            @endauth
                            @guest
                                <i class="fa fa-user-o">&nbsp;</i><a href="{{ route('login') }}" class="">@lang('user.sign_in')</a> / <a href="{{ route('register') }}" class="">@lang('user.register')</a>
                            @endguest

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
                        @foreach ($categories as $parentCategory)
                            <li class="dropdown side-dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">{{ $parentCategory->name }} <i class="fa fa-angle-right"></i></a>
                                <div class="custom-menu">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="list-links">
                                                @foreach ($parentCategory->subCategories as $subCategory)
                                                    <li><a href="{{ route('show-by-sub-category', $subCategory->slug) }}">{{ $subCategory->name }}</a></li>
                                                @endforeach
                                            </ul>
                                            <hr class="hidden-md hidden-lg">
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        <li><a href="{{ route('show-by-sub-category', 'khac') }}">Khác</a></li>
                    </ul>
                </div>
                <div class="menu-nav">
                    <span class="menu-header">Menu <i class="fa fa-bars"></i></span>
                    <ul class="menu-list">
                        <li><a href="{{ route('home') }}">@lang('user.home')</a></li>
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
    <div class="notifications-user">
        @include('user.layouts.alert-success')
        @include('user.layouts.alert-error')
    </div>
    {{ Html::script('js/jquery.min.js') }}
    {{ Html::script('js/bootstrap.min.js') }}
    {{ Html::script('js/slick.min.js') }}
    {{ Html::script('js/nouislider.min.js') }}
    {{ Html::script('js/jquery.zoom.min.js') }}
    {{ Html::script('messages.js') }}
    {{ Html::script('js/main.js') }}
    {{ Html::script('js/sweetalert.min.js') }}
    {{ Html::script('js/bootstrap-datepicker.min.js') }}
    {{ Html::script('js/jquery.dataTables.js') }}
    {{ Html::script('js/dataTables.bootstrap.js') }}
    {{ Html::script('js/app.js') }}
    @stack('js')
    {{ Html::script('js/new-event.js') }}
    <script>
        $(document).ready(function () {
            let userId = $('#notification-user').data('user');
            Echo.private('user.' + userId + '.channel')
                .listen('DocumentEvent', (e) => {
                    addNotification(e);
                });

            function addNotification(data) {
                let firstNotification = $('.list-notification').find('.notification-item').first();

                if (firstNotification.length) {
                    $(`
                        <div class="product product-widget notification-item">
                            <p>${data.notification}</p>
                            <b>${data.time}</b>
                        </div>`
                    ).insertBefore(firstNotification);
                } else {
                    $('.list-notification').append(`
                        <div class="product product-widget notification-item">
                            <p>${notification}</p>
                            <b>${data.time}</b>
                        </div>`
                    );
                }

                let numberNotification = $('.number-new-notification').text();
                $('.number-new-notification').text(parseInt(numberNotification)+1);
            }
        });
    </script>
</body>
</html>
