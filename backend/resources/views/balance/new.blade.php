@extends('layouts.app')

<!--{{ $page = 'balance.new' }}-->
@section('title') New balance @endsection

@section('content')

    <div class="container new-balance-page">

        <div class="row">
            <div class="col-md-8 ml-md-auto mr-md-auto">
                <form action="{{ route('balance.store') }}" method="POST" role="form">

                    {{ csrf_field() }}

                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('dashboard') }}" class="float-right">
                                <i class="fa fa-times"></i>
                            </a>
                            New balance
                        </div>
                        <div class="card-body">

                            @if(session('success'))
                                <p class="alert alert-success">{{ session('success') }}</p>
                            @endif

                            @if(session('fail'))
                                <p class="alert alert-danger">{{ session('fail') }}</p>
                            @endif

                            <!-- Title field -->
                            <div class="form-group row">
                                <label for="title" class="text-md-right col-md-2 col-form-label">
                                    Title
                                </label>

                                <div class="col-md-10">
                                    <input id="title" type="text" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" name="title" value="{{ old('title') }}">

                                    @if ($errors->has('title'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('title') }}
                                        </div>
                                    @endif

                                    <small class="form-text text-muted">Put balance title text</small>
                                </div>
                            </div>

                                <!-- Slug field -->
                                <div class="form-group row">
                                    <label for="slug" class="text-md-right col-md-2 col-form-label">
                                        Slug
                                    </label>

                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                {{ route('homepage') }}/user/{{ Auth::user()->slug ? Auth::user()->slug : Auth::user()->id }}/balance/
                                            </span>
                                            <input type="text" class="form-control {{ $errors->has('slug') ? 'is-invalid' : '' }}" id="slug" name="slug" value="{{ old('slug') }}">
                                        </div>

                                        @if ($errors->has('slug'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('slug') }}
                                            </div>
                                        @endif

                                        <small class="form-text text-muted">Balance friendly URI</small>
                                    </div>
                                </div>

                            <!-- Balance type field -->
                            <div class="form-group row">
                                <label for="type" class="text-md-right col-md-2 col-form-label">
                                    Type
                                    <i class="text-danger">*</i>
                                </label>

                                <div class="col-md-10">

                                    <div class="form-check">
                                        <label for="type1" class="form-check-label">
                                            <input class="form-check-input" type="radio" name="type" id="type1" value="1" checked>
                                            Activate now
                                        </label>
                                        <small class="form-text text-muted">Balance will be activated after creating</small>
                                    </div>
                                    <div class="form-check">
                                        <label for="type2" class="form-check-label">
                                            <input class="form-check-input" type="radio" name="type" id="type2" value="2">
                                            Activate now and disable all other balance
                                        </label>
                                        <small class="form-text text-muted">Balance will be activated after created and other balances will be disabled</small>
                                    </div>
                                    <div class="form-check">
                                        <label for="type3" class="form-check-label">
                                            <input class="form-check-input" type="radio" name="type" id="type3" value="3">
                                            Leave disabled
                                        </label>
                                        <small class="form-text text-muted">Balance will be created with not active status</small>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <div class="card-footer text-muted">
                            <div class="row">
                                <div class="col-md-10 ml-md-auto">
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <a href="{{ route('dashboard') }}" role="button" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

@endsection