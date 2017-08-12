@extends('layouts.app')

<!--{{ $page = 'balance.edit' }}-->
@section('title') Edit balance @endsection

@section('content')

    <div class="container new-balance-page">

        <div class="row">
            <div class="col-md-8 offset-md-2">
                <form action="{{ route('balance.update', $balance->id) }}" method="POST" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PUT')  }}

                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('balance.show', $balance->id) }}" class="float-right">
                                <i class="fa fa-times"></i>
                            </a>
                            Edit balance
                        </div>
                        <div class="card-block">

                            @if(session('success'))
                                <p class="alert alert-success">{{ session('success') }}</p>
                            @endif

                            @if(session('fail'))
                                <p class="alert alert-danger">{{ session('fail') }}</p>
                            @endif

                            <!-- Title field -->
                            <div class="form-group row {{ $errors->has('title') ? 'has-danger' : '' }}">
                                <label for="title" class="text-md-right col-md-4 col-form-label">
                                    Title
                                </label>

                                <div class="col-md-8">
                                    <input id="title" type="text" class="form-control" name="title" value="{{ $balance->title }}">

                                    @if ($errors->has('title'))
                                        <div class="form-control-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif

                                    <small class="form-text text-muted">Change your balance title if need.</small>
                                </div>
                            </div>

                                <!-- Slug field -->
                                <div class="form-group row {{ $errors->has('slug') ? 'has-danger' : '' }}">
                                    <label for="slug" class="text-md-right col-md-4 col-form-label">
                                        Slug
                                    </label>

                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                {{ route('homepage') }}/user/{{ $balance->owner->nick ? $balance->owner->nick : $balance->owner_id }}/balance/
                                            </span>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{ $balance->slug }}">
                                        </div>

                                        @if ($errors->has('slug'))
                                            <div class="form-control-feedback">
                                                {{ $errors->first('slug') }}
                                            </div>
                                        @endif

                                        <small class="form-text text-muted">Balance friendly URI</small>
                                    </div>
                                </div>

                            <!-- Balance type field -->
                            <div class="form-group row {{ $errors->has('type') ? 'has-danger' : '' }}">
                                <label for="type" class="text-md-right col-md-4 col-form-label">
                                    Type
                                    <i class="text-danger">*</i>
                                </label>

                                <div class="col-md-8">
                                    @if($balance->is_active)
                                        <div class="form-check">
                                            <label for="type3" class="form-check-label">
                                                <input class="form-check-input" type="radio" name="type" id="type3" value="3">
                                                Disactivate
                                            </label>
                                            <small class="form-text text-muted">Balance will be disactivated</small>
                                        </div>
                                    @else
                                        <div class="form-check">
                                            <label for="type1" class="form-check-label">
                                                <input class="form-check-input" type="radio" name="type" id="type1" value="1">
                                                Activate
                                            </label>
                                            <small class="form-text text-muted">Balance will be activated</small>
                                        </div>
                                        <div class="form-check">
                                            <label for="type2" class="form-check-label">
                                                <input class="form-check-input" type="radio" name="type" id="type2" value="2">
                                                Activate and disable all other balance
                                            </label>
                                            <small class="form-text text-muted">Balance will be activated and other balances will be disabled</small>
                                        </div>
                                    @endif
                                    <div class="form-check">
                                        <label for="type0" class="form-check-label">
                                            <input class="form-check-input" type="radio" name="type" id="type0" value="0" checked>
                                            Not change
                                        </label>
                                        <small class="form-text text-muted">Don't touch active option</small>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-muted">
                            <div class="row">
                                <div class="col-md-4 text-md-right hidden-sm-down">
                                    <a href="{{ $balance->publicLink() }}" role="button" class="btn btn-secondary">Cancel</a>
                                </div>
                                <div class="col-md-8">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <a href="{{ $balance->publicLink() }}" role="button" class="hidden-md-up btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

@endsection