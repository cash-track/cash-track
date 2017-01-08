<a href="{{ route('balance.show', $item->balance->id) }}"
   class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">

        @if(empty($item->title))
            <p class="mb-0">
            <span class="trans-balance" data-toggle="tooltip" title="{{ $item->balance->created_at }}">
                <i class="fa fa-bank"></i> Balance {{ $item->balance->created_at->format('Y-m-d') }}
            </span> |
                <span class="trans-date" data-toggle="tooltip" title="{{ $item->updated_at }}">
                <i class="fa fa-clock-o"></i> {{ $item->updated_at->diffForHumans() }}
            </span>
                <br>
                {{ $item->description }}
            </p>
        @else
            <h5 class="mb-1">
                {{ $item->title }}
            </h5>
        @endif

        <span>
            @price($item->amount)
            <i class="fa trans-operation {{ $item->type=='-'?'fa-long-arrow-down text-danger':'fa-long-arrow-up text-success' }}" aria-hidden="true"></i>
        </span>
    </div>

    @if(!empty($item->title))
        <p class="mb-0">
            <span class="trans-balance" data-toggle="tooltip" title="{{ $item->balance->created_at }}">
                <i class="fa fa-bank"></i> Balance {{ $item->balance->created_at->format('Y-m-d') }}
            </span> |
            <span class="trans-date" data-toggle="tooltip" title="{{ $item->updated_at }}">
                <i class="fa fa-clock-o"></i> {{ $item->updated_at->diffForHumans() }}
            </span>
            <br>
            {{ $item->description }}
        </p>
    @endif
</a>