 <div class="box box-primary">
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->avatar }}" alt="">
        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
        <p class="text-muted text-center"></p>
        <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
                <b class="text-blue">@lang('admin.user.uploaded')</b> <a class="pull-right">{{ auth()->user()->documents->count() }}</a>
            </li>
            <li class="list-group-item">
                <b>@lang('admin.user.downloaded')</b> <a class="pull-right">{{ count(explode(',', auth()->user()->downloaded)) }}</a>
            </li>
            <li class="list-group-item">
                <b>@lang('admin.user.bookmarks')</b> <a class="pull-right">{{ auth()->user()->bookmarks->count() }}</a>
            </li>
        </ul>
        <a href="{{ route('manage-profile') }}" class="btn btn-info btn-block btn-no-radius"><i class="fa fa-edit"></i> <b>@lang('user.edit_info')</b></a>
    </div>
</div>
