<div class="card balance-box
     {{ $balance->is_active ? 'balance-box-active card-outline-primary' : '' }}"
     data-balance-id="{{ $balance->id }}"
     onclick="location.href='{{ $balance->publicLink() }}'">
    <div class="card-body">
        @if($balance->is_active)
            <span class="badge badge-primary status float-right">active</span>
        @endif
        <h4 class="card-title">
            {{ !empty($balance->title)?str_limit($balance->title, 15):'Balance' }}
        </h4>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between">
            <span class="text-success">
                <i class="fa fa-long-arrow-up" aria-hidden="true"></i>
                @price($balance->getDebit())
            </span>
            <span class="text-primary">
                <b>@price($balance->getBalance())</b>
            </span>
            <span class="text-danger">
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
                    <a href="{{ $user->link }}"
                       data-toggle="tooltip"
                       data-title="{{ $user->name }}"
                       class="profile-image-container rounded-circle">
                        <img src="{{ $user->image }}" alt="{{ $user->name }}">
                    </a>
                @endforeach
            </span>
        @endif
        <span class="when-updated float-right">
            {{ $balance->updated_at->diffForHumans() }}
            <i class="fa fa-clock-o" aria-hidden="true"></i>
        </span>
    </div>
</div>