{{-- card overwall debited --}}
<div class="card card-inverse card-info text-left">
    <div class="card-block">
        <div class="row">
            <div class="col-2 text-center">
                <i class="fa fa-3x fa-line-chart"></i>
            </div>
            <div class="col-10 card-count-main">
                <span class="card-count-heading">Зароблено</span>
                <span class="card-count-value">@price($debited['all'])</span>
            </div>
            <div class="col-6">
                <span class="card-count-heading">За тиждень</span>
                <span class="card-count-value">@price($debited['week'])</span>
            </div>
            <div class="col-6 text-right">
                <span class="card-count-heading">За місяць</span>
                <span class="card-count-value">@price($debited['month'])</span>
            </div>
        </div>
    </div>
</div>