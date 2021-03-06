@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h1>@lang('admin.user.user_info')</h1>
    </section>
   <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar }}" alt="">
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <p class="text-muted text-center"></p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>@lang('admin.user.uploaded')</b> <a class="pull-right">{{ count($uploadeds) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang('admin.user.downloaded')</b> <a class="pull-right">{{ count(explode(',', $user->downloaded)) }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang('admin.user.bookmarks')</b> <a class="pull-right">{{ $user->bookmarks->count() }}</a>
                            </li>
                        </ul>
                        @if ($user->isModerator())
                            <a href="{{ route('user.unset-moderator', $user->slug) }}" class="btn btn-primary btn-block"><b>Unset Moderator</b></a>
                        @else
                            <a href="{{ route('user.set-moderator',  $user->slug) }}" class="btn btn-primary btn-block"><b>Set Moderator</b></a>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#user-info" data-toggle="tab">@lang('admin.user.user_info')</a></li>
                            <li><a href="#user-uploaded" data-toggle="tab">@lang('admin.user.uploaded')</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="user-info">
                                <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.name')</label>
                                    <div class="col-md-9">
                                        <p>{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.email')</label>
                                    <div class="col-md-9">
                                        <p>{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.date_of_birth')</label>
                                    <div class="col-md-9">
                                        <p>{{ $user->date_of_birth }}</p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.address')</label>
                                    <div class="col-md-9">
                                        <p>{{ $user->address }}</p>
                                    </div>
                                </div>
                                    <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.gender')</label>
                                    <div class="col-md-9">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-md-3 label-thin" for="">@lang('user.phone')</label>
                                    <div class="col-md-9">
                                        <p>{{ $user->phone }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="user-uploaded">
                                <div class="table-responsive">
                                    <table id="tables-user-uploaded" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('user.title')</th>
                                                <th>@lang('user.status')</th>
                                                <th>@lang('admin.category')</th>
                                                <th>@lang('user.date_upload')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($uploadeds as $uploaded)
                                                <tr>
                                                    <td>{{ $uploaded->name }}</td>
                                                    <td>{{ $uploaded->status_name }}</td>
                                                    <td>{{ $uploaded->category->name }}</td>
                                                    <td>{{ $uploaded->created_at->format('d/m/Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
