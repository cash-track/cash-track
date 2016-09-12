@extends('layouts.app')

@section('content')
    <div class="container balance-page">

        <div class="balance-header">
            <div class="pull-left">
                <a href="#">VovanMS</a> /
                <a href="#">Balance</a>

                <!-- is_active -->
                <span class="tag tag-primary status" data-toggle="tooltip"
                      title="This balance marked as active">active</span>

            </div>
            <div class="pull-right">
                Started at 24.05.16
                <i class="fa fa-calendar-o" aria-hidden="true"></i>
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

                        <span class="@if($i % 2) text-danger @else text-success @endif trans-amount">305</span>
                        <span>Trans title</span>
                    </div>
                </div>
            @endfor

        </div>


    </div>
@endsection