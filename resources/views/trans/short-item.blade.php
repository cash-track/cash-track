<a href="{{ route('balance.show', $item->balance->id) }}" class="list-group-item list-group-item-action">
    <span class="pull-right text-right">
        @price($item->amount)
        <i class="fa trans-operation {{ $item->type=='-'?'fa-long-arrow-down text-danger':'fa-long-arrow-up text-success' }}" aria-hidden="true"></i>
    </span>
    <h5 class="list-group-item-heading">
        {{ $item->title }}
    </h5>
    <p class="list-group-item-text">
        <span class="trans-balance" data-toggle="tooltip" title="{{ $item->balance->created_at }}">
            <i class="fa fa-bank"></i> Balance {{ $item->balance->created_at->format('Y-m-d') }}
        </span> |
        <span class="trans-date" data-toggle="tooltip" title="{{ $item->updated_at }}">
            <i class="fa fa-clock-o"></i> {{ $item->updated_at->diffForHumans() }}
        </span>
        <br>
        {{ $item->description }}
    </p>
</a>