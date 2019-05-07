@extends('admin.layout')

@section('wrapper')
    <div class="login-box">
        <div class="login-logo">
            <a href="/"><b>СК</b> Согласие</a>
        </div>
        <div class="login-box-body">
            <form action="{{ route('admin.login') }}" method="POST">
                @csrf

                <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password" type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                           placeholder="Пароль" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="row">
                    <input type="hidden" name="remember" id="remember" value="on">
                    <div class="col-xs-offset-8 col-xs-4">
                        <button type="submit" class="btn btn-warning btn-block btn-flat">Войти</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
