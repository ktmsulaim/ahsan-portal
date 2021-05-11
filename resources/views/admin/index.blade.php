@extends('layouts.base', ['title' => "Dashboard"])

@section('content')
<div class="row card-group-row">
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="position-relative mr-2">
                <div class="text-center fullbleed d-flex align-items-center justify-content-center flex-column z-0">
                    <h3 class="text-danger mb-0">12%</h3>
                    <small class="text-uppercase">Today</small>
                </div>
                <canvas width="90" height="90" class="position-relative z-1" data-toggle="progress-chart" data-progress-chart-value="12" data-progress-chart-color="danger" data-progress-chart-tone="300" style="display: block;"></canvas>
            </div>
            <!-- <div><i class="material-icons icon-muted icon-40pt mr-3">gps_fixed</i></div> -->
            <div class="flex">
                <div class="text-amount">$1,020</div>
                <div class="text-muted mt-1">Total Sales</div>
                <!-- <div class="text-stats text-success">31.5% <i class="material-icons">arrow_upward</i></div> -->
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div class="position-relative mr-2">
                <div class="text-center fullbleed d-flex align-items-center justify-content-center flex-column z-0">
                    <h3 class="text-success mb-0">68%</h3>
                    <small class="text-uppercase">Month</small>
                </div>
                <canvas width="90" height="90" class="position-relative z-1" data-toggle="progress-chart" data-progress-chart-value="68" data-progress-chart-color="success" data-progress-chart-tone="400" style="display: block;"></canvas>
            </div>
            <!-- <div><i class="material-icons icon-muted icon-40pt mr-3">monetization_on</i></div> -->
            <div class="flex">
                <div class="text-amount">$6,670</div>
                <div class="text-muted mt-1">Sales for June</div>
                <!-- <div class="text-stats text-success">51.5% <i class="material-icons">arrow_upward</i></div> -->
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div><i class="material-icons text-primary icon-48pt mr-2">account_circle</i></div>
            <div class="flex">
                <div class="text-amount">87%</div>
                <div class="text-muted mt-1">Sign-Up Percentage</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div><i class="material-icons text-success icon-48pt mr-2">check_circle</i></div>
            <div class="flex">
                <div class="h4 mb-0">Network Stats</div>
                <div class="text-muted mt-1">All systems working!</div>
            </div>
        </div>
    </div>
</div>
@endsection