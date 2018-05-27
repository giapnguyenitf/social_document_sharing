<!DOCTYPE html>
<html>
<head>
    <title>@lang('user.error.404_page')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ Html::style('css/font-awesome.min.css') }}
    {{ Html::style('css/404.css') }}
</head>
<body>
    <div class="main">
        <div class="w3_agile_main_grid">
            <h2>@lang('user.error.403')</h2>
            <p>@lang('user.error.403_messages')</p>
            <form action="#" method="post" class="agile_form">
                <input type="text" name="Text" placeholder="@lang('user.error.type_here')" required="">
                <input type="submit" value="@lang('user.error.send')">
            </form>
            <div class="agileits_w3layouts_main_grids">
                <div class="w3_agileits_main_grid_left">
                    <ul class="wthree_nav">
                        <li><a href="{{ route('home') }}">@lang('user.error.home')</a></li>
                        <li><a href="">@lang('user.error.about')</a></li>
                        <li><a href="">@lang('user.error.contact_us')</a></li>
                    </ul>
                </div>
                <div class="w3_agileits_main_grid_right">
                    <ul class="agileinfo_social_icons">
                        <li><a href="#" class="agileits_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="w3ls_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="w3l_instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="w3_google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="w3layouts_dribble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="clear"> </div>
            </div>
        </div>
        <div class="agileits_copyright">
            <p>Copy &copy; <script>document.write(new Date().getFullYear());</script>. All rights reserved | Design by <a href="{{ route('home') }}">E-Document-lab</a></p>
        </div>
    </div>
</body>
</html>
