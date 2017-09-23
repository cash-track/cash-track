@extends('layouts.app')

<!--{{ $page = 'login' }}-->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 ml-md-auto mr-md-auto">

            <form role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}

                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="login" class="text-right col-md-4 col-form-label">Login</label>

                            <div class="col-md-6">
                                <input id="login" type="text" class="form-control {{ $errors->has('login') ? 'is-invalid' : '' }}" name="login" value="{{ old('login') }}" required autofocus>

                                @if ($errors->has('login'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('login') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="text-right col-md-4 col-form-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 ml-md-auto">
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
                            <div class="col-md-8 ml-md-auto">
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
