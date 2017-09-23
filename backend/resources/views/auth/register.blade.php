@extends('layouts.app')

<!--{{ $page = 'register' }}-->

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 ml-md-auto mr-md-auto">

            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">

                {{ csrf_field() }}

                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="name" class="col-md-4 text-right col-form-label">
                                Name
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 text-right col-form-label">
                                Last Name
                            </label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}" name="last_name" value="{{ old('last_name') }}">

                                @if ($errors->has('last_name'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('last_name') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nick" class="col-md-4 text-right col-form-label">
                                Nick (login)
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="nick" type="text" class="form-control {{ $errors->has('nick') ? 'is-invalid' : '' }}" name="nick" value="{{ old('nick') }}" required>

                                @if ($errors->has('nick'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nick') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 text-right col-form-label">
                                E-Mail Address
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 text-right col-form-label">
                                Password
                                <span class="text-danger">*</span>
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 text-right col-form-label">
                                Confirm Password
                                <span class="text-danger">*</span>
                            </label>

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
