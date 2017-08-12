{{-- card overwall credited --}}
<div class="card card-inverse card-success">
    <div class="card-block">
        <div class="row">
            <div class="col-2 text-center">
                <i class="fa fa-3x fa-shopping-cart"></i>
            </div>
            <div class="col-10 card-count-main">
                <span class="card-count-heading">Потрачено</span>
                <span class="card-count-value">@price($credited['all'])</span>
            </div>
            <div class="col-6">
                <span class="card-count-heading">За тиждень</span>
                <span class="card-count-value">@price($credited['week'])</span>
            </div>
            <div class="col-6 text-right">
                <span class="card-count-heading">За місяць</span>
                <span class="card-count-value">@price($credited['month'])</span>
            </div>
        </div>
    </div>
</div>