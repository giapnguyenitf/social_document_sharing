@extends('user.layouts.master')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <a class="banner banner-1" href="#">
                        <img class="img-responsive" src="{{ asset('images/banner-1.jpg') }}" alt="">
                        <div class="banner-caption text-center">
                            <h2 class="white-color">2000</h2>
                            <h3 class="white-color">@lang('user.documents')</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a class="banner banner-1" href="#">
                        <img src="{{ asset('images/banner-2.jpg') }}" alt="">
                        <div class="banner-caption text-center">
                            <h2 class="white-color">30</h2>
                            <h3 class="white-color">@lang('user.category_document')</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3">
                    <a class="banner banner-1" href="#">
                        <img src="{{ asset('images/banner-3.jpg') }}" alt="">
                        <div class="banner-caption text-center">
                            <h2 class="white-color">30000</h2>
                            <h3 class="white-color">@lang('user.view_in_month')</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h2 class="title">@lang('user.new_documents')</h2>
                        <div class="pull-right">
                            <div class="product-slick-dots-2 custom-dots">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div id="product-slick-1" class="product-slick">
                            <div class="product product-single">
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-eye"></i> @lang('user.view')</button>
                                    <img src="{{ asset('images/no-image.png') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-info">
                                        <ul class="product-bts">
                                            <li title="@lang('user.views')"><i class="fa fa-eye"></i> 2000</li>
                                            <li title="@lang('user.downloads')"><i class="fa fa-cloud-download"></i> 2000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                           <div class="product product-single">
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-eye"></i> @lang('user.view')</button>
                                    <img src="{{ asset('images/no-image.png') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-info">
                                        <ul class="product-bts">
                                            <li title="@lang('user.views')"><i class="fa fa-eye"></i> 2000</li>
                                            <li title="@lang('user.downloads')"><i class="fa fa-cloud-download"></i> 2000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="product product-single">
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-eye"></i> @lang('user.view')</button>
                                    <img src="{{ asset('images/no-image.png') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-info">
                                        <ul class="product-bts">
                                            <li title="@lang('user.views')"><i class="fa fa-eye"></i> 2000</li>
                                            <li title="@lang('user.downloads')"><i class="fa fa-cloud-download"></i> 2000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="product product-single">
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-eye"></i> @lang('user.view')</button>
                                    <img src="{{ asset('images/no-image.png') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-info">
                                        <ul class="product-bts">
                                            <li title="@lang('user.views')"><i class="fa fa-eye"></i> 2000</li>
                                            <li title="@lang('user.downloads')"><i class="fa fa-cloud-download"></i> 2000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="product product-single">
                                <div class="product-thumb">
                                    <button class="main-btn quick-view"><i class="fa fa-eye"></i> @lang('user.view')</button>
                                    <img src="{{ asset('images/no-image.png') }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                    <div class="product-info">
                                        <ul class="product-bts">
                                            <li title="@lang('user.views')"><i class="fa fa-eye"></i> 2000</li>
                                            <li title="@lang('user.downloads')"><i class="fa fa-cloud-download"></i> 2000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3" id="aside">
                    <div class="aside">
                        <h3 class="aside-title">@lang('user.top_view_document')</h3>
                        <div class="product product-widget">
                            <div class="product-thumb">
                                <img src="{{ asset('images/no-image.png') }}" alt="">
                            </div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                <div class="product-info">
                                    <ul class="product-bts">
                                        <li><i class="fa fa-eye"></i> 2000</li>
                                        <li><i class="fa fa-cloud-download"></i> 2000</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="product product-widget">
                            <div class="product-thumb">
                                <img src="{{ asset('images/no-image.png') }}" alt="">
                            </div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                <div class="product-info">
                                    <ul class="product-bts">
                                        <li><i class="fa fa-eye"></i> 2000</li>
                                        <li><i class="fa fa-cloud-download"></i> 2000</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="product product-widget">
                            <div class="product-thumb">
                                <img src="{{ asset('images/no-image.png') }}" alt="">
                            </div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                <div class="product-info">
                                    <ul class="product-bts">
                                        <li><i class="fa fa-eye"></i> 2000</li>
                                        <li><i class="fa fa-cloud-download"></i> 2000</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="product product-widget">
                            <div class="product-thumb">
                                <img src="{{ asset('images/no-image.png') }}" alt="">
                            </div>
                            <div class="product-body">
                                <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                <div class="product-info">
                                    <ul class="product-bts">
                                        <li><i class="fa fa-eye"></i> 2000</li>
                                        <li><i class="fa fa-cloud-download"></i> 2000</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-9" id="main">
                    <div class="store-filter clearfix">
                        <div class="pull-left">
                            <div class="row-filter">
                                <a href="#" class="active"><i class="fa fa-th-large"></i></a>
                                <a href="#" ><i class="fa fa-bars"></i></a>
                            </div>
                            <div class="sort-filter">
                                <span class="text-uppercase">Sort by: </span>
                                <select class="input">
                                    <option value="0">Date</option>
                                    <option value="0">Views</option>
                                    <option value="0">Downloads</option>
                                </select>
                                <a href="#" class="main-btn icon-btn"><i class="fa fa-arrow-down"></i></a>
                            </div>
                        </div>
                        <div class="pull-right">
                            <ul class="store-pages">
                                <li><span class="text-uppercase">Page:</span></li>
                                <li class="active">1</li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div id="store">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <button class="main-btn quick-view"><i class="fa fa-eye"></i> View</button>
                                        <img src="{{ asset('images/no-image.png') }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-cloud-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <button class="main-btn quick-view"><i class="fa fa-eye"></i> View</button>
                                        <img src="{{ asset('images/no-image.png') }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-cloud-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <button class="main-btn quick-view"><i class="fa fa-eye"></i> View</button>
                                        <img src="{{ asset('images/no-image.png') }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-cloud-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                             <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <button class="main-btn quick-view"><i class="fa fa-eye"></i> View</button>
                                        <img src="{{ asset('images/no-image.png') }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-cloud-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <button class="main-btn quick-view"><i class="fa fa-eye"></i> View</button>
                                        <img src="{{ asset('images/no-image.png') }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-cloud-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <button class="main-btn quick-view"><i class="fa fa-eye"></i> View</button>
                                        <img src="{{ asset('images/no-image.png') }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-cloud-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <button class="main-btn quick-view"><i class="fa fa-eye"></i> View</button>
                                        <img src="{{ asset('images/no-image.png') }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-cloud-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-6">
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <button class="main-btn quick-view"><i class="fa fa-eye"></i> View</button>
                                        <img src="{{ asset('images/no-image.png') }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h2 class="product-name"><a href="#">Product Name Goes Here</a></h2>
                                        <div class="product-btns">
                                            <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>
                                            <button class="main-btn icon-btn"><i class="fa fa-cloud-download"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="store-filter clearfix">
                        <div class="pull-right">
                            <ul class="store-pages">
                                <li><span class="text-uppercase">Page:</span></li>
                                <li class="active">1</li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#"><i class="fa fa-caret-right"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
