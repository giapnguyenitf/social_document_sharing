@extends('user.layouts.master')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3" id="aside">
                    <div class="aside">
                        <h3 class="aside-title">@lang('user.document_related')</h3>
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
                            <h2>ccfgcgfcf</h2>
                        </div>
                    </div>
                    <div id="store">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
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
