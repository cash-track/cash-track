@extends('layouts.app')

<!--{{ $page = 'register' }}-->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                {{ csrf_field() }}

            <div class="card">
                <div class="card-header">Register</div>
                <div class="card-block">

                        <div class="form-group row{{ $errors->has('name') ? ' has-danger' : '' }}">
                            <label for="name" class="col-md-4 text-xs-right col-form-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <label for="email" class="col-md-4 text-xs-right col-form-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label for="password" class="col-md-4 text-xs-right col-form-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <div class="form-control-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

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
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </div>

            </div>

            </form>
        </div>
    </div>
</div>
@endsection
