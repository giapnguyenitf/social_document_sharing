@extends('user.layouts.master')
@section('content')
    <div class="section">
        <div class="container">
           <div class="row">
                <div class="col-md-9" id="main">
                    <div class="view-info">
                        <div class="row">
                            <div class="col-md-12 document-name">
                                <h3>{{ $document->name }}</h3>
                            </div>
                            <div class="col-md-12">
                                <div class="category">
                                    <b>@lang('user.category'): <a class="text-blue" href="{{ route('show-by-sub-category',  $document->category->slug) }}">{{ $document->category->name }}</a></b>
                                </div>
                            </div>
                            <div class="col-md-12 document-description">
                                <p>{{ $document->description }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="author">
                                    <div class="avatar">
                                        <a href="{{ route('user-profile.show', $document->user->slug) }}"><img class="img-responsive" src="{{ $document->user->avatar }}" alt=""></a>
                                    </div>
                                    <div class="name">
                                        <a class="text-blue" href="{{ route('user-profile.show', $document->user->slug) }}">{{ $document->user->name }}</a>
                                        <p>@lang('user.document.upload') <span>{{ $authorUploaded }}</span> @lang('user.document.document')</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="analysis">
                                    <span><i class="fa fa-download"></i>&nbsp;{{ $document->downloads }}</span>
                                    <span><i class="fa fa-eye"></i>&nbsp;{{ $document->views }}</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="document-action">
                                    <a href="{{ route('download-document', $document->slug) }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-download"></i>&nbsp;@lang('user.document.download')
                                    </a>
                                    @if (Auth::check())
                                        @if ($isBookmark)
                                            <a href="" class="btn btn-success btn-sm" id="btn-cancel-bookmark-document" data-id="{{ $document->id }}" data-url="{{ route('ajax-cancel-bookmark-document') }}">
                                                <i class="fa fa-heart"></i>&nbsp;@lang('user.document.cancel_bookmark')
                                            </a>
                                            <a href="" class="btn btn-success btn-sm hidden" id="btn-bookmark-document" data-id="{{ $document->id }}" data-url="{{ route('ajax-bookmark-document') }}">
                                                <i class="fa fa-heart"></i>&nbsp;@lang('user.document.bookmark')
                                            </a>
                                        @else
                                            <a href="" class="btn btn-success btn-sm hidden" id="btn-cancel-bookmark-document" data-id="{{ $document->id }}" data-url="{{ route('ajax-cancel-bookmark-document') }}">
                                                <i class="fa fa-heart"></i>&nbsp;@lang('user.document.cancel_bookmark')
                                            </a>
                                            <a href="" class="btn btn-success btn-sm" id="btn-bookmark-document" data-id="{{ $document->id }}" data-url="{{ route('ajax-bookmark-document') }}">
                                                <i class="fa fa-heart"></i>&nbsp;@lang('user.document.bookmark')
                                            </a>
                                        @endif
                                         <a href="" data-toggle="modal" data-target="#modal-report-document" class="btn btn-warning btn-sm">
                                            <i class="fa fa-times"></i>&nbsp;@lang('user.document.report_illegal')
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-success btn-sm">
                                            <i class="fa fa-heart"></i>&nbsp;@lang('user.document.bookmark')
                                        </a>
                                        <a href="{{ route('login') }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-times"></i>&nbsp;@lang('user.document.report_illegal')
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="viewer">
                        <div class="row">
                            <iframe class="col-md-12 col-xs-12 no-padding" height="800px" src="{{ $urlViewer }}" frameborder="0">
                            </iframe>
                        </div>
                        <div class="row sharing-row">
                            <div class="col-md-4 col-md-offset-3">
                                <div class="sharing-title">
                                    <i class="fa fa-share"></i> <span>@lang('user.sharing_title')</span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="sharing-btn-group">
                                    <a href="" class="btn btn-primary"><i class="fa fa-facebook"></i> Facebook</a>
                                    <a href="" class="btn btn-danger"><i class="fa fa-google"></i> Google</a>
                                    <a href="" class="btn btn-info"><i class="fa fa-twitter"></i> Twitter</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 document-tags">
                                <b>@lang('user.tags'):</b>
                                @foreach ($document->tags as $tag)
                                    <a href="{{ route('show-by-tag', $tag->slug) }}" class="label label-default label-tag-document">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="comment-ui">
                                     <div class="label ribbon">
                                        @lang('user.comment.comment')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row comment-box-row">
                            <div class="col-md-12">
                                <div class="comment-box">
                                    <div class="row">
                                        <div class="col-md-1">
                                            @auth
                                                <div class="avatar-user-comment">
                                                    <img class="img-responsive" src="{{ Auth::user()->avatar }}" alt="">
                                                </div>
                                            @else
                                                <div class="avatar-user-comment">
                                                    <img class="img-responsive" src="{{ asset('images/male_avatar.png') }}" alt="">
                                                </div>
                                            @endauth
                                        </div>
                                        <div class="col-md-11">
                                            <div class="comment-input">
                                                <textarea placeholder="@lang('user.comment.leave_a_comment')" class="form-control comment-messages" rows="2" name="comment-messages" id="comment-messages" ></textarea>
                                            </div>
                                            <div class="btn-group-comment-input hidden">
                                                <a href="" id="btn-send-comment" data-document-id="{{ $document->id }}" data-url="{{ route('ajax-comment-document') }}" class="btn btn-info btn-sm">@lang('user.comment.send')</a>
                                                <a href="" id="btn-cancel-comment" class="btn btn-default btn-sm">@lang('user.comment.cancel')</a>
                                                <a class="messages-validate-comment">
                                                    @if (!Auth::check())
                                                        @lang('user.comment.you_must_login_before_comment')
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="comment-ui">
                                    <div class="label ribbon">
                                        @lang('user.comment.other_comments')
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row show-comment">
                            <div class="col-md-12 wrap-comment-item">
                                @foreach ($comments as $comment)
                                    <div class="row comment-item">
                                        <div class="col-md-1">
                                            <div class="avatar-user-comment">
                                                <img class="img-responsive" src="{{ $comment->user->avatar }}" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                            <div class="comment-user-name">
                                                <h4><a class="user-name" href="">{{ $comment->user->name }}</a> <span class="comment-time">{{ $comment->comment_at }}</span></h4>
                                            </div>
                                            <div class="comment-message">{{ $comment->messages }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-12 paginate-comment">
                                {{ $comments->links() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" id="aside">
                    <div class="aside related-document">
                        <h3 class="aside-title">@lang('user.related_document')</h3>
                        @foreach ($relatedDocuments  as $relatedDocument)
                            <div class="product product-widget">
                                <div class="product-thumb">
                                    <a href="{{ route('view-document', $relatedDocument->slug) }}"><img class="img-responsive" src="{{ $relatedDocument->thumbnail }}" alt=""></a>
                                </div>
                                <div class="product-body">
                                    <h2 class="product-name"><a href="{{ route('view-document', $relatedDocument->slug) }}">{{ $relatedDocument->name }}</a></h2>
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
    @include('user.layouts.modal-report-document');
@endsection
