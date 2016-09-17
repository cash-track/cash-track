@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card-columns">

        @foreach($balances as $balance)
            <div class="card balance-box
                        {{ $balance->is_active?'balance-box-active card-outline-primary':'' }}"
                 data-balance-id="{{ $balance->id }}"
                 onclick="location.href='{{ url('/balance') }}/{{ $balance->id }}'">
                <div class="card-block">

                    <!-- Started ad field -->
                    <span class="pull-right" data-toggle="tooltip" title="Date when balance started">
                        {{ $balance->created_at->format('Y-m-d') }}
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                </span>

                    <h4 class="card-title">
                        Balance
                        @if($balance->is_active)
                            <span class="tag tag-primary status" data-toggle="tooltip"
                                  title="This balance marked as active">active</span>
                        @endif
                    </h4>
                    <p class="card-text">Your balance {{ $balance->getBalance() }} UAH</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <span class="pull-left text-success" data-toggle="tooltip"
                              title="Summary credited">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            {{ $balance->getDebit() }}
                        </span>
                        <span class="pull-right text-danger" data-toggle="tooltip"
                              title="Summary spent">
                        <i class="fa fa-minus-circle" aria-hidden="true"></i> {{ $balance->getCredit() }}</span>
                        <div class="clearfix"></div>
                    </li>
                </ul>
                <div class="card-footer text-muted">
                    @if(count($balance->users))
                        <span>
                            <i class="fa fa-user" aria-hidden="true" data-toggle="tooltip"
                               title="Balance owner"></i>
                            @foreach($balance->users as $user)
                                <a href="{{ url('/user') }}/{{ $user->id }}">{{ $user->name }}</a>
                                @if($loop->remaining), @endif
                            @endforeach
                        </span>
                    @endif
                    <span class="pull-right" data-toggle="tooltip"
                          title="When balance updated">
                        {{ $balance->updated_at->diffForHumans() }}
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
        @endforeach

    </div>

</div>
@endsection
