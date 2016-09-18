@extends('layouts.app')

{{--*/ $page = 'balance.show' /*--}}
@section('title') Balance @endsection

@section('content')
    <div class="container balance-page">

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

        <div class="balance-detail text-xs-center">
            <span class="pull-left text-xs-left">
                <span class="text-muted">Payments income</span><br>
                <span class="text-success balance-detail-item">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    {{ $balance->getDebit() }}
                </span>
            </span>

            <span class="pull-right text-xs-right">
                <span class="text-muted">Payments refunded</span><br>
                <span class="text-danger balance-detail-item">
                    {{ $balance->getCredit() }}
                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                </span>
            </span>

            <div>
                <span class="text-muted">Current balance</span><br>
                <span class="text-info balance-detail-item">{{ $balance->getBalance() }}</span>
            </div>

            <div class="clearfix"></div>
        </div>

        <div class="balance-trans">

            <div class="trans-item new-trans-item row">
                <div class="offset-sm-4 col-sm-8 trans-detail">
                    <i class="fa fa-plus-circle trans-operation text-muted" aria-hidden="true"></i>

                    <a href="#">Create new trans</a>
                    <div class="new-trans-item-form">

                    </div>
                </div>
            </div>

            @if(count($balance->trans()))
                @foreach($balance->trans() as $tran)
                    <div class="trans-item row">

                        <div class="col-sm-4 text-xs-right text-muted trans-date-cont">
                            <span class="trans-date">{{ $tran->updated_at->format('d.m.y H:i') }}</span>
                        </div>

                        <div class="col-sm-8 text-xs-left trans-detail">

                            <i class="fa trans-operation {{ $tran->type=='-'?'fa-minus-circle text-danger':'fa-plus-circle text-success' }}" aria-hidden="true"></i>

                            <span class="defis"></span>

                            <div class="pull-right action-button">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                            id="trans_action_{{ $tran->id }}" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="trans_action_{{ $tran->id }}">
                                        <a class="dropdown-item" href="#"><i class="fa fa-pencil"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i class="fa fa-trash-o"></i> Delete</a>
                                    </div>
                                </div>
                            </div>

                            <div class="trans-header">
                                <span class="{{ $tran->type=='-'?'text-danger':'text-success' }} trans-amount">
                                    {{ $tran->amount }}
                                </span>
                                <span class="tag tag-primary">Store</span>
                                <span class="tag tag-warning">Road</span><br>

                            </div>

                            <div class="trans-body">
                                <h6>Trans title</h6>
                                <span>Description of transaction</span>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

    </div>
@endsection