<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Log in</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        {{ Html::style('css/bootstrap.min.css') }}
        {{ Html::style('css/font-awesome.min.css') }}
        {{ Html::style('css/ionicons.min.css') }}
        {{ Html::style('css/AdminLTE.min.css') }}
        {{ Html::style('css/_all-skins.min.css') }}
        {{ Html::style('css/new-style.css') }}
        {{ Html::style('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
            </div>
            <div class="login-box-body">
                <h3 class="login-box-msg">@lang('user.sign_in')</h3>
                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="form-group has-feedback">
                        <input name="email" type="email" class="form-control input-radius" placeholder="@lang('user.email')" value="{{ old('email')}}" required>
                        <span class="fa fa-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group has-feedback">
                        <input name="password" type="password" class="form-control input-radius" placeholder="@lang('user.password')" required>
                        <span class="fa fa-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-1">
                            <div class="checkbox icheck">
                                <label><input type="checkbox">@lang('user.remember_me')</label>
                            </div>
                        </div>
                        <div class="col-xs-4 pull-right">
                            <button type="submit" class="btn btn-info btn-block btn-flat btn-login">@lang('user.sign_in')</button>
                        </div>
                    </div>
                </form>
                <div class="social-auth-links text-center">
                    <p>- @lang('user.or') -</p>
                    <a href="{{ route('redirect', ['provider' => 'facebook']) }}" class="btn btn-block btn-social btn-facebook btn-flat btn-radius">
                        <i class="fa fa-facebook"></i>
                        @lang('user.sign_up_with_facebook')
                    </a>
                    <a href="{{ route('redirect', ['provider' => 'google']) }}" class="btn btn-block btn-social btn-google btn-flat btn-radius">
                        <i class="fa fa-google"></i>
                        @lang('user.sign_up_with_google')
                    </a>
                </div>
                <a href="#">@lang('user.forgot_password')</a>&emsp;
                <a href="{{ route('register') }}" class="text-center">@lang('user.register')</a>
            </div>
        </div>
        {{ Html::script('js/jquery.min.js') }}
        {{ Html::script('js/bootstrap.min.js') }}
    </body>
</html>
