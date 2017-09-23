@extends('layouts.app')

<!--{{ $page = 'profile.index' }}-->
@section('title') Профіль @endsection

@section('content')
    <div class="container profile">

        {{-- on desktop --}}
        <div class="row hidden-md-down">
            <div class="col-md-5">
                @include('profile.components.card-stats-credited')
            </div>
            <div class="col-md-2 text-center hidden-md-down">
                @include('profile.components.profile-avatar')
            </div>
            <div class="col-md-5 text-right">
                @include('profile.components.card-stats-debited')
            </div>
            <div class="col-md-12 text-center">
                <h4 class="pt-3">{{ $user->name }} {{ $user->last_name }} ({{ '@'.$user->nick }})</h4>
                <h6><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></h6>
                <hr>
            </div>
        </div>

        {{-- on tablet&mobile --}}
        <div class="row hidden-lg-up" style="display: none">
            <div class="col-md-12 text-center">
                @include('profile.components.profile-avatar')
            </div>
            <div class="col-md-12 text-center">
                <h4 class="pt-3">{{ $user->name }} {{ $user->last_name }} ({{ '@'.$user->nick }})</h4>
                <h6><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></h6>
                <hr>
            </div>
            <div class="col-md-12">
                @include('profile.components.card-stats-credited')
                <br>
            </div>

            <div class="col-md-12">
                @include('profile.components.card-stats-debited')
                <hr>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <p class="lead chapter">Last transaction</p>
                <div class="trans-list">
                    @if($transactions)
                        <div class="list-group">
                            @each('trans.short-item', $transactions, 'item')
                        </div>

                        @if($active_balances->lastPage() > $active_balances->currentPage())
                            {{--<a href="#">See more..</a>--}}
                        @endif
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <p class="lead chapter">Current balance</p>
                @if($active_balances)
                    @each('balance.card', $active_balances, 'balance')

                    @if($active_balances->lastPage() > $active_balances->currentPage())
                        <a href="{{ route('dashboard') }}">See more..</a>
                    @endif
                @else
                    -
                @endif
            </div>
        </div>

    </div>
@endsection
