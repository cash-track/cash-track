@extends('layouts.app')

<!-- Main Content -->
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                {{ csrf_field() }}

            <div class="card">
                <div class="card-header">Reset Password</div>
                <div class="card-block">

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Email field -->
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

                </div>
                <div class="card-footer text-muted">
                    <div class="row">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
                        </div>
                    </div>
                </div>

            </div>

            </form>

        </div>
    </div>
</div>
@endsection
