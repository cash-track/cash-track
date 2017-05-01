<div class="card balance-box
     {{ $balance->is_active?'balance-box-active card-outline-primary':'' }}"
     data-balance-id="{{ $balance->id }}"
     onclick="location.href='{{ $balance->publicLink() }}'">
    <div class="card-block">

        <!-- Started ad field -->
        <span class="float-right" data-toggle="tooltip" title="Balance created at">
            {{ $balance->created_at->format('Y-m-d') }}
            <i class="fa fa-calendar-o" aria-hidden="true"></i>
        </span>

        <h4 class="card-title">
            {{ !empty($balance->title)?str_limit($balance->title, 15):'Balance' }}
            @if($balance->is_active)
                <span class="badge badge-primary status" data-toggle="tooltip"
                      title="This balance marked as active">active</span>
            @endif
        </h4>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item justify-content-between">
            <span class="text-success" data-toggle="tooltip"
                  title="Summary credited">
                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                @price($balance->getDebit())
            </span>
            <span class="text-primary" data-toggle="tooltip" title="Current balance">
                <b>@price($balance->getBalance())</b>
            </span>
            <span class="text-danger" data-toggle="tooltip"
                  title="Summary spent">
                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                @price($balance->getCredit())
            </span>
        </li>
    </ul>
    <div class="card-footer text-muted">
        @if(count($balance->users))
            <span class="owners">
                @foreach($balance->users as $user)
                    @if($loop->iteration > 6) @continue @endif
                    <a href="{{ $user->link() }}"
                       data-toggle="tooltip"
                       data-title="{{ $user->name }}"
                       class="profile-image-container rounded-circle">
                        <img src="{{ $user->image }}" alt="{{ $user->name }}">
                    </a>
                @endforeach
            </span>
        @endif
        <span class="when-updated float-right" data-toggle="tooltip"
              title="When balance updated">
            {{ $balance->updated_at->diffForHumans() }}
            <i class="fa fa-clock-o" aria-hidden="true"></i>
        </span>
    </div>
</div>