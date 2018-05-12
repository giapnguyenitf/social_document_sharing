<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Registration Page</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        {{ Html::style('css/bootstrap.min.css') }}
        {{ Html::style('css/font-awesome.min.css') }}
        {{ Html::style('css/ionicons.min.css') }}
        {{ Html::style('css/AdminLTE.min.css') }}
        {{ Html::style('css/_all-skins.min.css') }}
        {{ Html::style('css/new-style.css') }}
        {{ Html::style('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}
    </head>
    <body class="hold-transition register-page">
        <div class="register-box">
        <div class="register-logo">
        </div>
        <div class="register-box-body">
            <h3 class="login-box-msg">@lang('user.register')</h3>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-group has-feedback">
                    <input name="name" type="text" class="form-control input-radius" value="{{ old('name')}}" placeholder="@lang('user.name')" required>
                    <span class="fa fa-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
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
                <div class="form-group has-feedback">
                    <input name="password_confirmation" type="password" class="form-control input-radius" placeholder="@lang('user.confirm_password')" required>
                    <span class="fa fa-lock form-control-feedback"></span>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-xs-7 col-xs-offset-1">
                    <div class="checkbox icheck">
                        <label><input name="agree_with_term" type="checkbox" checked> @lang('user.i_agree_with') <a href="#">@lang('user.terms')</a></label>
                    </div>
                    </div>
                    <div class="col-xs-4 pull-right">
                        <button type="submit" class="btn btn-info btn-block btn-flat btn-radius">@lang('user.register')</button>
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
            <a href="{{ route('login') }}" class="text-center">@lang('user.login')</a>
        </div>
        </div>
        {{ Html::script('js/jquery.min.js') }}
        {{ Html::script('js/bootstrap.min.js') }}
    </body>
</html>
