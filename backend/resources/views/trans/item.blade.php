<div class="trans-item row">

    <div class="col-sm-4 text-sm-right text-muted trans-date-cont">
        <span class="trans-date">{{ $tran->updated_at->format('d.m.y H:i') }}</span>
        <span class="profile-image-container rounded-circle">
            <a href="{{ $tran->user->link() }}">
                <img src="{{ $tran->user->image }}" alt="{{ $tran->user->name }}" data-toggle="tooltip" data-title="{{ $tran->user->name }}">
            </a>
        </span>
    </div>

    <div class="col-sm-8 text-left trans-detail">

        <i class="fa trans-operation {{ $tran->type=='-'?'fa-long-arrow-down text-danger':'fa-long-arrow-up text-success' }}" aria-hidden="true"></i>

        <span class="defis"></span>

        @if($balance->is_active)
        <div class="float-right action-button">
            <div class="dropdown">
                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                        id="trans_action_{{ $tran->id }}" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><i class="fa fa-ellipsis-h"></i></button>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="trans_action_{{ $tran->id }}">
                    <a class="dropdown-item edit-button" href="#"><i class="fa fa-pencil"></i> Edit</a>
                    <form action="{{ route('trans.destroy', $tran->id) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="dropdown-item" href="#">
                            <i class="fa fa-trash-o"></i>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif

        <div class="trans-header">
            <span class="trans-amount">
                @price($tran->amount)
            </span>
            @if($tran->title)
                <span class="trans-title">{{ $tran->title }}</span>
            @endif
            <br>
        </div>

        <div class="trans-body">
            @if($tran->description)
                <span>{{ $tran->description }}</span>
            @endif
        </div>

        <div class="trans-edit">
            @include('trans.edit')
        </div>

        <div class="clearfix"></div>
    </div>
</div>