@extends('layouts.app')

<!--{{ $page = 'passforgot' }}-->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                {{ csrf_field() }}
                <input type="hidden" name="token" value="{{ $token }}">

            <div class="card">
                <div class="card-header">Reset Password</div>
                <div class="card-block">

                    <!-- Email field -->
                    <div class="form-group row{{ $errors->has('email') ? ' has-danger' : '' }}">
                        <label for="email" class="col-md-4 text-xs-right col-form-label">E-Mail Address</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required>

                            @if ($errors->has('email'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Password field -->
                    <div class="form-group row{{ $errors->has('password') ? ' has-danger' : '' }}">
                        <label for="password" class="col-md-4 text-xs-right col-form-label">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required autofocus>

                            @if ($errors->has('password'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Confirm password field -->
                    <div class="form-group row{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
                        <label for="password-confirm" class="col-md-4 text-xs-right col-form-label">Confirm Password</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('password_confirmation') }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="card-footer text-muted">
                    <div class="row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>
@endsection
