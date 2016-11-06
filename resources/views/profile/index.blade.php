@extends('layouts.app')

{{--*/ $page = 'profile.index' /*--}}
@section('title') Профіль @endsection

@section('content')
    <div class="container profile">

        <div class="row">
            <div class="col-md-5">

                {{-- card overwall credited --}}
                <div class="card card-inverse card-success">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-2 text-xs-center">
                                <i class="fa fa-3x fa-shopping-cart"></i>
                            </div>
                            <div class="col-md-10 card-count-main">
                                <span class="card-count-heading">Потрачено</span>
                                <span class="card-count-value">@price($credited['all'])</span>
                            </div>
                            <div class="col-md-6">
                                <span class="card-count-heading">За тиждень</span>
                                <span class="card-count-value">@price($credited['week'])</span>
                            </div>
                            <div class="col-md-6 text-xs-right">
                                <span class="card-count-heading">За місяць</span>
                                <span class="card-count-value">@price($credited['month'])</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-2 text-xs-center">

                <div class="profile-image">
                    <img src="https://dummyimage.com/600/666/fff.png" alt="Profile">
                </div>

            </div>
            <div class="col-md-5 text-xs-right">

                {{-- card overwall debited --}}
                <div class="card card-inverse card-info text-xs-left">
                    <div class="card-block">
                        <div class="row">
                            <div class="col-md-2 text-xs-center">
                                <i class="fa fa-3x fa-line-chart"></i>
                            </div>
                            <div class="col-md-10 card-count-main">
                                <span class="card-count-heading">Зароблено</span>
                                <span class="card-count-value">@price($debited['all'])</span>
                            </div>
                            <div class="col-md-6">
                                <span class="card-count-heading">За тиждень</span>
                                <span class="card-count-value">@price($debited['week'])</span>
                            </div>
                            <div class="col-md-6 text-xs-right">
                                <span class="card-count-heading">За місяць</span>
                                <span class="card-count-value">@price($debited['month'])</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12 text-xs-center">
                <h4>{{ $user->name }}</h4>
                <h6><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></h6>
                <hr>
            </div>

            <div class="col-md-6">
                <p class="lead">Last transaction</p>
                <div class="trans-list">
                    @if($transactions)
                        <div class="list-group">
                            @each('trans.short-item', $transactions, 'item')
                        </div>

                        {{--<a href="#">See more..</a>--}}
                    @else
                        -
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <p class="lead">Current balance</p>
                @if($active_balances)
                    @each('balance.card', $active_balances, 'balance')
                @else
                    -
                @endif
            </div>
        </div>

    </div>
@endsection
