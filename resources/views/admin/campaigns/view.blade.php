@extends('layouts.base', ['title' => $campaign->name ])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
    <li class="breadcrumb-item active">{{ $campaign->name }}</li>
@endsection

@section('action_button')
    <a href="{{ route('admin.campaigns.edit', $campaign->id) }}" class="btn btn-success ml-1"><span
            class="material-icons mr-2">mode_edit</span> Edit</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center py-5">
                            <img src="{{ $campaign->logo() }}" width="60%" alt="{{ $campaign->name }}" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <h4 class="title-sm">{{ $campaign->name }}</h4>
                            <div>
                                {!! $campaign->description !!}
                            </div>
                            <div class="mt-3">
                                @if ($campaign->status)
                                    <span class="badge badge-success">Enabled</span>
                                @else
                                    <span class="badge badge-danger">Disabled</span>
                                @endif

                                @if ($campaign->active)
                                    <span class="badge badge-success">Active</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row card-group-row">
        <div class="col-lg-4 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2 d-flex">Target <span class="badge badge-warning ml-2">{{ $campaign->totalAmountPercentage() }}%</span></div>
                        <span class="h4 m-0">₹{{$campaign->totalAmount()}} <small class="text-muted"> / ₹{{ number_format($campaign->target) }}</small> </span>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">monetization_on</i></div>
                </div>
                <div class="progress"
                     style="height: 3px;">
                    <div class="progress-bar bg-warning"
                         role="progressbar"
                         style="width: {{ $campaign->totalAmountPercentage() }}%;"
                         aria-valuenow="{{ $campaign->totalAmountPercentage() }}"
                         aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted d-flex mb-2">Individual Target <span class="badge badge-primary ml-2">{{ $targetMetCount }}</span></div>
                        <span class="h4 m-0">₹{{ $campaign->individualTarget() }}</span>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">gps_fixed</i></div>
                </div>
                <div class="progress"
                     style="height: 3px;">
                    <div class="progress-bar"
                         role="progressbar"
                         style="width: {{ $targetMetPercentage }}%;"
                         aria-valuenow="{{ $targetMetPercentage }}"
                         aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Top amount</div>

                        <div class="d-flex align-items-center">
                            <div class="h4 m-0">₹{{ $topAmount ? $topAmount->amount : 0 }} </div>
                            <div class="d-inline-block text-muted ml-2 small">
                                @if ($topAmount)
                                    <a href="{{ route('admin.users.show', $topAmount->id) }}">{{ $topAmount->name }}</a>
                                @else
                                    NULL
                                @endif
                            </div>
                        </div>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">contacts</i></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row card-group-row">
        <div class="col-lg-6 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-header">
                    <div class="card-header__title">Top 10</div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered">
                        <tbody>
                            @if ($toppers && count($toppers) > 0)
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Batch</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                @foreach ($toppers as $key => $topper)
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
                            @for ($i = 1; $i <= 7; $i++)
                                @php
                                    $batchTotal = \App\Models\Sponsor::totalAmountByBatch($campaign->id, 'Batch ' . $i);
                                @endphp
                                <tr>
                                    <th width="130">Batch {{$i}}</th>
                                    <td>₹{{ $batchTotal ? number_format($batchTotal->amount) : 0 }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection