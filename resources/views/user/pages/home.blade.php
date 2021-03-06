@extends('user.layouts.master')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <a class="banner banner-1" href="#">
                        <img class="img-responsive" src="{{ asset('images/banner-1.jpg') }}" alt="">
                        <div class="banner-caption text-center">
                            <h2 class="white-color">{{ $numberDocument }}</h2>
                            <h3 class="white-color">@lang('user.documents')</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6">
                    <a class="banner banner-1" href="#">
                        <img src="{{ asset('images/banner-2.jpg') }}" alt="">
                        <div class="banner-caption text-center">
                            <h2 class="white-color">{{ $numberCategory }}</h2>
                            <h3 class="white-color">@lang('user.category_document')</h3>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-3">
                    <a class="banner banner-1" href="#">
                        <img src="{{ asset('images/banner-3.jpg') }}" alt="">
                        <div class="banner-caption text-center">
                            <h2 class="white-color">{{ $numberViews }}</h2>
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
                            <div class="product-slick-dots-1 custom-dots">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div id="product-slick-1" class="product-slick">
                            @foreach ($newestDocuments as $newestDocument)
                                <div class="product product-single">
                                    <div class="product-thumb">
                                        <a class="main-btn quick-view" href="{{ route('view-document', $newestDocument->slug) }}"><i class="fa fa-eye"></i> @lang('user.view')</a>
                                        <img class="img-responsive" src="{{ $newestDocument->thumbnail }}" alt="">
                                    </div>
                                    <div class="product-body">
                                        <h2 class="product-name"><a href="{{ route('view-document', $newestDocument->slug) }}">{{ $newestDocument->name }}</a></h2>
                                        <div class="product-info">
                                            <ul class="product-bts">
                                                <li title="@lang('user.views')"><i class="fa fa-eye"></i> {{ $newestDocument->views }}</li>
                                                <li title="@lang('user.downloads')"><i class="fa fa-cloud-download"></i> {{ $newestDocument->downloads }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
                        @foreach ($topViewsDocuments  as $topViewsDocument)
                            <div class="product product-widget">
                                <div class="product-thumb">
                                    <a href="{{ route('view-document', $topViewsDocument->slug) }}"><img class="img-responsive" src="{{ $topViewsDocument->thumbnail }}" alt=""></a>
                                </div>
                                <div class="product-body">
                                    <h2 class="product-name"><a href="{{ route('view-document', $topViewsDocument->slug) }}">{{ $topViewsDocument->name }}</a></h2>
                                    <div class="product-info">
                                        <ul class="product-bts">
                                            <li><i class="fa fa-eye"></i> {{ $topViewsDocument->views }}</li>
                                            <li><i class="fa fa-cloud-download"></i> {{ $topViewsDocument->downloads }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
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
                                <span class="text-uppercase">@lang('user.sort_by'): </span>
                                <select class="input">
                                    <option value="0">@lang('user.date_upload')</option>
                                    <option value="0">@lang('user.views')</option>
                                    <option value="0">@lang('user.downloads')</option>
                                </select>
                            </div>
                        </div>
                        <div class="pull-right">
                        </div>
                    </div>

                    <div id="store">
                        <div class="row">
                            @foreach ($allDocuments as $allDocument)
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="product product-single">
                                        <div class="product-thumb">
                                            <a class="main-btn quick-view" href="{{ route('view-document',  $allDocument->slug) }}"><i class="fa fa-eye"></i> @lang('user.view')</a>
                                            <img src="{{ $allDocument->thumbnail }}" alt="">
                                        </div>
                                        <div class="product-body">
                                            <h2 class="product-name"><a href="{{ route('view-document', $allDocument->slug) }}">{{ $allDocument->name }}</a></h2>
                                            <div class="product-btns">
                                                <a class="main-btn icon-btn"><i class="fa fa-heart"></i></a>
                                                <a class="main-btn icon-btn" href="{{ route('view-document', $allDocument->slug) }}"><i class="fa fa-eye"></i></a>
                                                <a class="main-btn icon-btn"><i class="fa fa-cloud-download"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="store-filter clearfix">
                        <div class="pull-right">
                            {{ $allDocuments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
