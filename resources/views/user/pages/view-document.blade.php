@extends('user.layouts.master')
@section('content')
    <div class="section">
        <div class="container">
           <div class="row">
                <div class="col-md-9" id="main">
                    <div class="store-filter clearfix">
                        <div class="pull-left">
                            <h3 class="aside-title">{{ $document->name }}</h3>
                        </div>
                    </div>
                    <div class="store-filter clearfix">
                        <div class="pull-left">
                            <div class="author">
                                <div class="avatar">
                                    <a href=""><img class="img-responsive" src="{{ $document->user->avatar }}" alt=""></a>
                                </div>
                                <div class="name">
                                    <a href="">{{ $document->user->name }}</a>
                                    <p>Tải lên <span>1240</span> tài liệu</p>
                                </div>
                            </div>
                        </div>
                        <div class="pull-right">
                             <div class="analysis">
                                <span><i class="fa fa-file"></i>&nbsp;{{ $document->file_size }}MB</span>
                                <span><i class="fa fa-download"></i>&nbsp;{{ $document->downloads }}</span>
                                <span><i class="fa fa-eye"></i>&nbsp;{{ $document->views }}</span>
                             </div>
                        </div>
                    </div>
                    <div id="store">
                        <div class="row">
                            <iframe class="col-md-12 col-xs-12 no-padding" height="800px" src="{{ $document->file_name }}" frameborder="0">
                            </iframe>
                        </div>
                    </div>
                    <div class="store-filter clearfix">
                        <div class="pull-right">
                        </div>
                    </div>
                </div>

                <div class="col-md-3" id="aside">
                    <div class="aside related-document">
                        <h3 class="aside-title">@lang('user.related_document')</h3>
                        @foreach ($relatedDocuments  as $relatedDocument)
                            <div class="product product-widget">
                                <div class="product-thumb">
                                    <img class="img-responsive" src="{{ $relatedDocument->thumbnail }}" alt="">
                                </div>
                                <div class="product-body">
                                    <h2 class="product-name"><a href="#">{{ $relatedDocument->name }}</a></h2>
                                    <div class="product-info">
                                        <ul class="product-bts">
                                            <li><i class="fa fa-eye"></i> {{ $relatedDocument->views }}</li>
                                            <li><i class="fa fa-cloud-download"></i> {{ $relatedDocument->downloads }}</li>
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
