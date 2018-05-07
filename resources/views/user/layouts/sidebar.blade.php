<div class="box box-primary">
    <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->avatar }}" alt="">
        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
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
        <a href="#" class="btn btn-info btn-block btn-no-radius"><i class="fa fa-edit"></i> <b>@lang('user.edit_info')</b></a>
    </div>
</div>
