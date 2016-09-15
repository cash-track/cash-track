@extends('layouts.app')

@section('content')
    <div class="container balance-page">

        <div class="balance-header text-xs-center">
            <div class="pull-left">
                <a href="#">VovanMS</a> /
                <a href="#">Balance</a>

                <!-- is_active -->
                <span class="tag tag-primary status" data-toggle="tooltip"
                      title="This balance marked as active">active</span>

            </div>
            <span>
                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                Started at 24.05.16
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
                    16 500
                </span>
            </span>

            <span class="pull-right text-xs-right">
                <span class="text-muted">Payments refunded</span><br>
                <span class="text-danger balance-detail-item">
                    16 500
                    <i class="fa fa-minus-circle" aria-hidden="true"></i>
                </span>
            </span>

            <div>
                <span class="text-muted">Current balance</span><br>
                <span class="text-info balance-detail-item">16 000</span>
            </div>

            <div class="clearfix"></div>
        </div>

        <div class="balance-trans">

            <div class="trans-item new-trans-item row">
                <div class="offset-sm-4 col-sm-8 trans-detail">
                    <i class="fa fa-plus-circle trans-operation text-muted" aria-hidden="true"></i>

                    <a href="#">Create new trans</a>
                </div>
            </div>

            @for($i = 0; $i < 5; $i++)
                <div class="trans-item row">

                    <div class="col-sm-4 text-xs-right text-muted trans-date-cont">
                        <span class="trans-date">29.08.16 12:23</span>
                    </div>

                    <div class="col-sm-8 text-xs-left trans-detail">

                        @if($i % 2)
                            <i class="fa fa-minus-circle trans-operation text-danger" aria-hidden="true"></i>
                        @else
                            <i class="fa fa-plus-circle trans-operation text-success" aria-hidden="true"></i>
                        @endif

                        <span class="defis"></span>

                        <div class="pull-right action-button">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                        id="trans_action_{{ $i }}" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="trans_action_{{ $i }}">
                                    <a class="dropdown-item" href="#"><i class="fa fa-pencil"></i> Edit</a>
                                    <a class="dropdown-item" href="#"><i class="fa fa-trash-o"></i> Delete</a>
                                </div>
                            </div>
                        </div>

                        <div class="trans-header">
                            <span class="@if($i % 2) text-danger @else text-success @endif trans-amount">1 150</span>
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
            @endfor

        </div>

    </div>
@endsection