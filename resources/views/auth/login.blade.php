@extends('layouts.app')

<!--{{ $page = 'login' }}-->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <form role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-block">

                        <div class="form-group row {{ $errors->has('email') ? 'has-danger' : '' }}">
                            <label for="email" class="text-xs-right col-md-4 col-form-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row {{ $errors->has('password') ? 'has-danger' : '' }}">
                            <label for="password" class="text-xs-right col-md-4 col-form-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer text-muted">
                        <div class="row">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-primary" type="submit">Login</button>
                                <a href="{{ url('/password/reset') }}" class="btn btn-link">Forgot Your Password?</a>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>
@endsection
