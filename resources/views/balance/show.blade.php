@extends('layouts.app')

{{--*/ $page = 'balance.show' /*--}}
@section('title') Balance @endsection

@section('content')
    <div class="container balance-page">

        {{-- Balance header --}}
        <div class="balance-header text-xs-center">
            <div class="pull-left">
                <a href="#">VovanMS</a> /
                <a href="#">Balance</a>

                @if($balance->is_active)
                    <!-- is_active -->
                        <span class="tag tag-primary status" data-toggle="tooltip"
                              title="This balance marked as active">active</span>
                @endif
            </div>
            <span>
                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                Started at {{ $balance->created_at->format('d.m.y') }}
            </span>
            <div class="pull-right">
                <button class="btn btn-outline-primary"><i class="fa fa-envelope-o"></i> Subscribe</button>
                <button class="btn btn-outline-primary"><i class="fa fa-pencil"></i> Edit</button>
            </div>
            <div class="clearfix"></div>
        </div>

        {{-- Balance amount --}}
        <div class="balance-detail text-xs-center">
            <span class="pull-left text-xs-left">
                <span class="text-muted">Payments income</span><br>
                <span class="text-success balance-detail-item">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    @price($balance->getDebit())
                </span>
            </span>

            <span class="pull-right text-xs-right">
                <span class="text-muted">Payments refunded</span><br>
                <span class="text-danger balance-detail-item">
                    @price($balance->getCredit())
                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                </span>
            </span>

            <div>
                <span class="text-muted">Current balance</span><br>
                <span class="text-info balance-detail-item">@price($balance->getBalance())</span>
            </div>

            <div class="clearfix"></div>
        </div>

        {{-- Balance transactions --}}
        <div class="balance-trans">

            {{-- New transaction block --}}
            @if($balance->is_active)
            <div class="trans-item new-trans-item row">
                <div class="offset-sm-4 col-sm-8 trans-detail">
                    <i class="fa fa-plus-circle trans-operation text-muted" aria-hidden="true"></i>
                    <a href="#">Create new trans</a>
                    <div class="new-trans-item-form">
                        @include('trans.new')
                    </div>
                </div>
            </div>
            @endif

            @if(count($balance->trans()))
                @foreach($balance->trans() as $tran)
                    @include('trans.item')
                @endforeach
            @endif

        </div>

    </div>
@endsection