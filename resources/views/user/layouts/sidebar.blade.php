<div class="sidebar-profile">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">@lang('user.member')</h3>
        </div>
        <div class="panel-body">
            <ul class="sidebar-panel">
                <li class"avatar">
                    <div class="form-inline">
                        <div class="form-group">
                            <div class="user-avatar">
                                <img class="img-responsive" src="{{ Auth::user()->avatar_path }}" alt="">
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="user-name">{{ Auth::user()->name }}</h4>
                        </div>
                    </div>
                </li>
                <li class=""><a href="{{ route('manage-profile') }}"><i class="fa fa-user"></i>@lang('user.user_infomation')</a></li>
                <li class=""><a href="{{ route('document.index') }}"><i class="glyphicon glyphicon-cloud-upload"></i>@lang('user.upload')</a></li>
                <li class=""><a href="{{ route('uploaded-document.index') }}"><i class="glyphicon glyphicon-open-file"></i>@lang('user.uploaded')</a></li>
                <li class=""><a href=""><i class="glyphicon glyphicon-cloud-download"></i>@lang('user.downloaded')</a></li>
                <li class=""><a href=""><i class="glyphicon glyphicon-heart"></i>@lang('user.bookmark_document')</a></li>
            </ul>
        </div>
    </div>
</div>
