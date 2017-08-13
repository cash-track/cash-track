@extends('layouts.app')

<!--{{ $page = 'passforgot' }}-->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 ml-md-auto mr-md-auto">

            <form class="form-horizontal" role="form" method="POST" action="{{ route('password.update') }}">

                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="card">
                    <div class="card-header">Reset Password</div>
                    <div class="card-body">

                        <!-- Email field -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 text-xs-right col-form-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required>

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Password field -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 text-xs-right col-form-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required autofocus>

                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Confirm password field -->
                        <div class="form-group row{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                            <label for="password-confirm" class="col-md-4 text-xs-right col-form-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password_confirmation') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-muted">
                        <div class="row">
                            <div class="col-md-8 ml-md-auto">
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
