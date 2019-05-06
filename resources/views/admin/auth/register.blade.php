@extends('admin.layout')

@section('wrapper')
    <div class="register-box">
        <div class="register-logo">
            <a href="/"><b>СК</b> Согласие</a>
        </div>

        <div class="register-box-body">
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form-group has-feedback">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password" type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
                           placeholder="{{ __('Password') }}" required>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                    @endif
                </div>

                <div class="form-group has-feedback">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           placeholder="{{ __('Confirm Password') }}" required>
                </div>

                <div class="row">
                    <div class="col-xs-offset-6 col-xs-5">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Регистрация</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
