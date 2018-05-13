@extends('user.layouts.master')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <h2>Kết quả với từ khóa &#34; <strong>{{ $keyword }}</strong> &#34;</h2>
            </div>
           <div class="row">
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
                           {{ $documents->links() }}
                        </div>
                    </div>
                    <div id="store">
                        <div class="row">
                            @if (count($documents))
                                @foreach ($documents as $document)
                                    <div class="col-md-3 col-sm-6 col-xs-6">
                                        <div class="product product-single">
                                            <div class="product-thumb">
                                                <a href="{{ route('view-document', $document->slug) }}" class="main-btn quick-view"><i class="fa fa-eye"></i> @lang('user.view')</a>
                                                <img src="{{ $document->thumbnail }}" alt="">
                                            </div>
                                            <div class="product-body">
                                                <h2 class="product-name"><a href="{{ route('view-document', $document->slug) }}">{{ $document->name }}</a></h2>
                                                <div class="product-btns">
                                                    <button class="main-btn icon-btn"><i class="fa fa-heart"></i></button>
                                                    <button class="main-btn icon-btn"><i class="fa fa-eye"></i></button>
                                                    <button class="main-btn icon-btn"><i class="fa fa-cloud-download"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="no-result">
                                    <h1>@lang('user.search.no_result')</h1>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="store-filter clearfix">
                        <div class="pull-right">
                            {{ $documents->links() }}
                        </div>
                    </div>
                </div>

                <div class="col-md-3" id="aside">
                    <div class="aside">
                        <h3 class="aside-title">@lang('user.new_documents')</h3>
                        @foreach ($newestDocuments  as $newestDocument)
                            <div class="product product-widget">
                                <div class="product-thumb">
                                    <a href="{{ route('view-document', $newestDocument->slug) }}"><img class="img-responsive" src="{{ $newestDocument->thumbnail }}" alt=""></a>
                                </div>
                                <div class="product-body">
                                    <h2 class="product-name"><a href="{{ route('view-document', $newestDocument->slug) }}">{{ $newestDocument->name }}</a></h2>
                                    <div class="product-info">
                                        <ul class="product-bts">
                                            <li><i class="fa fa-eye"></i> {{ $newestDocument->views }}</li>
                                            <li><i class="fa fa-cloud-download"></i> {{ $newestDocument->downloads }}</li>
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
@endsection
