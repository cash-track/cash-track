@extends('layouts.app')

<!--{{ $page = 'balance.invite' }}-->
@section('title') Invite member @endsection

@section('content')

    <div class="container new-balance-page">

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('balance.invite', $balance->id) }}" method="POST" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PUT')  }}

                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('balance.show', $balance->id) }}" class="float-xs-right">
                                <i class="fa fa-times"></i>
                            </a>
                            Invite user to balance {{ $balance->id }}
                        </div>
                        <div class="card-block">

                            @if(session('success'))
                                <p class="alert alert-success">{{ session('success') }}</p>
                            @endif

                            @if(session('fail'))
                                <p class="alert alert-danger">{{ session('fail') }}</p>
                            @endif

                            <!-- Balance type field -->
                            <div class="form-group row {{ $errors->has('name') ? 'has-danger' : '' }}">
                                <label for="name" class="text-md-right col-md-4 col-form-label">
                                    User name or email
                                    <i class="text-danger">*</i>
                                </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="" required>

                                    @if ($errors->has('name'))
                                        <div class="form-control-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif

                                    <small class="form-text text-muted">Start write user name or email and select needle member</small>

                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-muted">
                            <div class="row">
                                <div class="col-md-4 text-md-right hidden-sm-down">
                                    <a href="{{ route('balance.show', $balance->id) }}" role="button" class="btn btn-secondary">Back</a>
                                </div>
                                <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit">Invite</button>
                                    <a href="{{ route('balance.show', $balance->id) }}" role="button" class="hidden-md-up btn btn-secondary">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

@endsection