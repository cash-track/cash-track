@extends('layouts.app')

<!--{{ $page = 'balance.invite' }}-->
@section('title') Invite member @endsection

@section('content')

    <div class="container invite-user-page">

        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('balance.invite', $balance->id) }}" method="POST" role="form">
                    {{ csrf_field() }}
                    {{ method_field('PUT')  }}

                    <div class="card">
                        <div class="card-header">
                            <a href="{{ $balance->publicLink() }}" class="float-right">
                                <i class="fa fa-times"></i>
                            </a>
                            Invite user to {{ $balance->title }}
                        </div>
                        <div class="card-body">

                            @if(session('success'))
                                <p class="alert alert-success">{{ session('success') }}</p>
                            @endif

                            @if(session('fail'))
                                <p class="alert alert-danger">{{ session('fail') }}</p>
                            @endif

                            <!-- Balance type field -->
                            <invite-user-auto-complete></invite-user-auto-complete>

                        </div>
                        <div class="card-footer text-muted">
                            <div class="row">
                                <div class="ml-auto mr-auto">
                                    <a href="{{ $balance->publicLink() }}" role="button" class="hidden-md-up btn btn-secondary">Back</a>
                                    <button class="btn btn-primary" type="submit">Invite</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('balance.show', $balance->id) }}" class="float-right">
                            <i class="fa fa-times"></i>
                        </a>
                        Balance members
                    </div>

                    <div class="card-body invited-users-box">
                        <div class="list-group">
                            @foreach($balance->users()->get() as $user)
                                <a href="#" class="invited-user-item list-group-item list-group-item-action d-flex justify-content-between">
                                    <span>
                                        <span class="profile-image-container rounded-circle list-group-item-image">
                                            <img src="{{ $user->image }}" alt="{{ $user->name }}">
                                        </span>

                                        {{ $user->name }}
                                    </span>

                                    @if($user->id == $balance->owner->id)
                                        <span class="badge badge-default">owner</span>
                                    @else
                                        <form action="{{ route('balance.uninvite', [$balance->id, $user->id]) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}
                                            <button type="submit" class="close" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </form>
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection