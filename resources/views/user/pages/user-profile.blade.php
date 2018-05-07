@extends('user.layouts.master')
@section('content')
    <div class="container">
        <div class="row user-profile">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar }}" alt="">
                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                        <p class="text-muted text-center"></p>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b class="text-blue">@lang('admin.user.uploaded')</b> <a class="pull-right">123</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang('admin.user.following')</b> <a class="pull-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>@lang('admin.user.followers')</b> <a class="pull-right">13,287</a>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-info btn-block btn-no-radius"><i class="fa fa-heart"></i> <b>@lang('user.follow')</b></a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#user-profile" data-toggle="tab">@lang('user.user_info')</a></li>
                        <li><a href="#uploaded-document" data-toggle="tab">@lang('user.uploaded')</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="user-profile">
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
                                    <p>{{ $user->gender_name }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 label-thin" for="">@lang('user.phone')</label>
                                <div class="col-md-9">
                                    <p>{{ $user->phone }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="uploaded-document">
                            <div class="document-uploaded-info">
                                <div class="table-uploaded">
                                    <table id="user-uploadeds-table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>@lang('user.title')</th>
                                                <th>@lang('user.views')</th>
                                                <th>@lang('user.downloads')</th>
                                                <th>@lang('user.status')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($uploadeds))
                                                @foreach ($uploadeds as $uploaded)
                                                    <tr>
                                                        <td><a class="text-link" href="{{ route('view-document', $uploaded->id) }}">{{ $uploaded->name }}</a></td>
                                                        <td>{{ $uploaded->views }}</td>
                                                        <td>{{ $uploaded->downloads }}</td>
                                                        <td><span class="label label-info">{{ $uploaded->status_name }}</span></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
