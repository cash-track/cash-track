@extends('layouts.app')

<!--{{ $page = 'profile.dashboard' }}-->
@section('title') Dashboard @endsection

@section('content')
<div class="container dashboard">

    @if(session('status'))
        <div class="alert alert-info" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if($balances->count())
        <div class="row">
            @foreach($balances as $balance)
                <div class="col-sm-6 col-md-4">
                    @include('balance.card', $balance)
                </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info" role="alert">
            <strong>Here will be your balances.</strong>
            Let's <a href="{{ route('balance.create') }}">create your first balance</a>.
        </div>
    @endif

</div>
@endsection
