@extends('layouts.app')

<!--{{ $page = 'balance.show' }}-->
@section('title') Balance @endsection

@section('content')
    <div class="container balance-page">

        {{-- Balance header --}}
        <div class="balance-header text-sm-center">
            <div class="balance-title float-sm-left">
                <a href="#">{{ Auth::user()->name }}</a> /
                <a href="#">Balance</a>

                @if($balance->is_active)
                    <!-- is_active -->
                        <span class="badge badge-primary status" data-toggle="tooltip"
                              title="This balance marked as active">active</span>
                @endif
            </div>
            <span class="balance-started-date">
                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                Started at {{ $balance->created_at->format('d.m.y') }}
            </span>
            <div class="balance-action float-right">
                <div class="btn-group">
                    <a href="{{ route('balance.edit', $balance->id) }}"
                       role="button"
                       class="btn btn-secondary">
                        <i class="fa fa-pencil"></i>
                        Edit
                    </a>
                    <button type="button"
                            class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        <span class="sr-only">Show more action</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <h6 class="dropdown-header">More actions</h6>
                        <a class="dropdown-item" href="{{ route('balance.showInvite', $balance->id) }}">Invite</a>
                        @if($balance->is_active)
                            <form action="{{ route('balance.disactivate', $balance->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <button type="submit" class="dropdown-item">Disactivate</button>
                            </form>
                        @else
                            <form action="{{ route('balance.activate', $balance->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PUT') }}
                                <button type="submit" class="dropdown-item">Activate</button>
                            </form>
                        @endif
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('balance.destroy', $balance->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit"
                                    class="dropdown-item"
                                    onclick="return confirm('You sure?')">Delete</button>
                        </form>
                    </div>
                </div>

            </div>
            <div class="clearfix"></div>
        </div>

        {{-- Balance amount --}}
        <div class="balance-detail text-center">
            <span class="float-sm-left text-sm-left">
                <span class="text-muted">Payments income</span><br>
                <span class="text-success balance-detail-item">
                    <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                    @price($balance->getDebit())
                </span>
            </span>

            <span class="float-sm-right text-sm-right">
                <span class="text-muted">Payments refunded</span><br>
                <span class="text-danger balance-detail-item">
                    @price($balance->getCredit())
                    <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
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

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('fail') }}
                </div>
            @endif

            {{-- New transaction block --}}
            @if($balance->is_active)
            <div class="trans-item new-trans-item row">
                <div class="offset-sm-4 col-sm-8 trans-detail">
                    <i class="fa fa-plus trans-operation text-muted" aria-hidden="true"></i>
                    <a href="#">Create new trans</a>
                    <div class="new-trans-item-form">
                        @include('trans.new')
                    </div>
                </div>
            </div>
            @endif

            @if(count($balance->getTrans()))
                @foreach($balance->getTrans() as $tran)
                    @include('trans.item')
                @endforeach
            @endif

        </div>

    </div>
@endsection