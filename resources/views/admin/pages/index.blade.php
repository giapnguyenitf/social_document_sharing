@extends('admin.layouts.master')
@section('content')
    <section class="content-header">
        <h1>@lang('admin.dashboard')</h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{ $numberNewDocuments }}</h3>
                        <p>@lang('admin.analysis.new_documents')</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">@lang('admin.analysis.more_info') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{ $numberUsers }}</h3>
                        <p>@lang('admin.analysis.user_registrations')</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">@lang('admin.analysis.more_info') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{ $views }}</h3>
                        <p>@lang('admin.analysis.views')</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">@lang('admin.analysis.more_info') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{ $downloads }}</h3>
                        <p>@lang('admin.analysis.downloads')</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">@lang('admin.analysis.more_info') <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
      </div>
    </section>
@endsection
