@extends('layouts.app')

<!--{{ $page = 'profile.dashboard' }}-->
@section('title') Dashboard @endsection

@section('content')
<div class="container">

    @if($balances->count())
        <div class="card-columns">
            @each('balance.card', $balances, 'balance')
        </div>
    @else
        <div class="alert alert-info" role="alert">
            <strong>Here will be your balances.</strong>
            Let's <a href="{{ route('balance.create') }}">create your first balance</a>.
        </div>
    @endif

</div>
@endsection
