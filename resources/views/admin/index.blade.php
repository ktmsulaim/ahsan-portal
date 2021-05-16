@extends('layouts.base', ['title' => "Dashboard"])

@section('content')
<div class="row card-group-row">
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            {{-- <div class="position-relative mr-2">
                <div class="text-center fullbleed d-flex align-items-center justify-content-center flex-column z-0">
                    <h3 class="text-danger mb-0">12%</h3>
                    <small class="text-uppercase">Today</small>
                </div>
                <canvas width="90" height="90" class="position-relative z-1" data-toggle="progress-chart" data-progress-chart-value="12" data-progress-chart-color="danger" data-progress-chart-tone="300" style="display: block;"></canvas>
            </div> --}}
            <div><i class="material-icons text-primary icon-40pt mr-3">people</i></div>
            <div class="flex">
                <div class="text-amount">{{ $totalMembers }}</div>
                <div class="text-muted mt-1">Total members</div>
                <!-- <div class="text-stats text-success">31.5% <i class="material-icons">arrow_upward</i></div> -->
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            {{-- <div class="position-relative mr-2">
                <div class="text-center fullbleed d-flex align-items-center justify-content-center flex-column z-0">
                    <h3 class="text-success mb-0">68%</h3>
                    <small class="text-uppercase">Month</small>
                </div>
                <canvas width="90" height="90" class="position-relative z-1" data-toggle="progress-chart" data-progress-chart-value="68" data-progress-chart-color="success" data-progress-chart-tone="400" style="display: block;"></canvas>
            </div> --}}
            <div><i class="material-icons text-info icon-48pt mr-3">group_add</i></div>
            <div class="flex">
                <div class="text-amount">{{ $totalBatches ? count($totalBatches) : 0 }}</div>
                <div class="text-muted mt-1">Total Batches</div>
                <!-- <div class="text-stats text-success">51.5% <i class="material-icons">arrow_upward</i></div> -->
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div><i class="material-icons text-primary icon-48pt mr-2">account_circle</i></div>
            <div class="flex">
                <div class="text-amount">{{ $totalCamps }}</div>
                <div class="text-muted mt-1">Total campaigns</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 card-group-row__col">
        <div class="card card-group-row__card card-body flex-row align-items-center">
            <div><i class="material-icons text-success icon-48pt mr-2">check_circle</i></div>
            <div class="flex">
                <div class="h5 mb-0">{{ $activeCamp ? $activeCamp->name : null }}</div>
                <div class="text-muted mt-1">Active campaign</div>
            </div>
        </div>
    </div>
</div>

@if ($activeCamp)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header__title">{{ $activeCamp->name }}</div>
                </div>
                <div class="card-body">
                    <div class="row card-group-row">
                        <div class="col-lg-6 col-md-6 card-group-row__col">
                            <div class="card card-group-row__card">
                                <div class="card-header">
                                    <div class="card-header__title">Top 10</div>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            @if (\App\Models\User::toppers() && count(\App\Models\User::toppers()) > 0)
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Batch</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                @foreach (\App\Models\User::toppers() as $key => $topper)
                                                    <tr>
                                                        <td>{{ $key + 1 }}</td>
                                                        <td>{{ $topper->name }}</td>
                                                        <td>{{ $topper->batch }}</td>
                                                        <td>{{ number_format($topper->total_amount) }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <p>No toppers found!</p>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 card-group-row__col">
                            <div class="card card-group-row__card">
                                <div class="card-header">
                                    <div class="card-header__title">Batches</div>
                                </div>
                                <div class="card-body table-responsive">
                                    <table class="table table-bordered">
                                        <tbody>
                                            @if (count($totalBatches))    
                                            @for ($i = 1; $i <= count($totalBatches); $i++)
                                                @php
                                                    $batchTotal = \App\Models\Sponsor::totalAmountByBatch($activeCamp->id, 'Batch ' . $i);
                                                @endphp
                                                <tr>
                                                    <th width="130">Batch {{ $i }}</th>
                                                    <td>₹{{ $batchTotal ? number_format($batchTotal->amount) : 0 }}</td>
                                                </tr>
                                            @endfor
                                            @else
                                                <p>No batches found!</p>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection