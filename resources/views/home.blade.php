@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card-columns">

        <div class="card card-outline-primary balance-box balance-box-active" data-balance-id="">
            <div class="card-block">

                <!-- Started ad field -->
                <span class="pull-right" data-toggle="tooltip" title="Date when balance started">
                    24.05.16
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                </span>

                <h4 class="card-title">
                    Balance
                    <span class="tag tag-primary status" data-toggle="tooltip"
                          title="This balance marked as active">active</span>
                </h4>
                <p class="card-text">Your balance 16 000 UAH</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <span class="pull-left text-success" data-toggle="tooltip"
                          title="Summary credited">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> 16 500</span>

                    <span class="pull-right text-danger" data-toggle="tooltip"
                          title="Summary spent">
                        <i class="fa fa-minus-circle" aria-hidden="true"></i> 13 563</span>
                    <div class="clearfix"></div>
                </li>
            </ul>
            <div class="card-footer text-muted">
                <span>
                    <i class="fa fa-user" aria-hidden="true" data-toggle="tooltip"
                       title="Balance owner"></i>
                    <a href="{{ url('/user/vovanms') }}">VovanMS</a>, <a href="{{ url('/user/anroon') }}">Anroon</a> ...
                </span>
                <span class="pull-right" data-toggle="tooltip"
                      title="When balance updated">
                    5 minute ago
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                </span>
            </div>
        </div>

        @for($i = 0;$i < 5; $i++)
            <div class="card balance-box">
                <div class="card-block">

                    <!-- Started ad field -->
                    <span class="pull-right" data-toggle="tooltip" title="Date when balance started">
                    24.05.16
                    <i class="fa fa-calendar-o" aria-hidden="true"></i>
                </span>

                    <h4 class="card-title">
                        Balance
                    </h4>
                    <p class="card-text">Your balance 16 000 UAH</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                    <span class="pull-left text-success" data-toggle="tooltip"
                          title="Summary credited">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> 16 500</span>

                        <span class="pull-right text-danger" data-toggle="tooltip"
                              title="Summary spent">
                        <i class="fa fa-minus-circle" aria-hidden="true"></i> 13 563</span>
                        <div class="clearfix"></div>
                    </li>
                </ul>
                <div class="card-footer text-muted">
                <span>
                    <i class="fa fa-user" aria-hidden="true" data-toggle="tooltip"
                       title="Balance owner"></i>
                    <a href="{{ url('/user/vovanms') }}">VovanMS</a>
                </span>
                    <span class="pull-right" data-toggle="tooltip"
                          title="When balance updated">
                    5 minute ago
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                </span>
                </div>
            </div>
        @endfor


    </div>

</div>
@endsection
