@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if ($campaign)
                <div class="dashboard-welcome-row d-flex align-items-center flex-wrap mb-2">
                    <div class="dashboard-welcome-row__text flex-grow-1 min-w-0">
                        <span class="card-header__title">Welcome, {{ auth()->user()->name }}</span>
                        <span class="text-muted mx-2">·</span>
                        <span class="card-header__title">{{ $campaign->name }}</span>
                        <span class="badge badge-secondary ml-1">{{ $campaign->pivot->location }}</span>
                    </div>
                    <div class="dashboard-welcome-row__action mt-2 mt-sm-0">
                        @include('components.user.add_sponsor')
                    </div>
                </div>

                <div class="row card-group-row">
                    <div class="col-lg-4 col-md-6 card-group-row__col">
                        <div class="card card-group-row__card">
                            <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                                <div class="flex">
                                    <div class="card-header__title text-muted mb-2 d-flex">
                                        Your target
                                        @if (!auth()->user()->targetMet())
                                            <span
                                                class="badge badge-warning ml-2">{{ number_format(auth()->user()->totalAmountPercentage(),2) }}%</span>
                                        @endif
                                    </div>
                                    @if (!auth()->user()->targetMet())
                                        <span class="h4 m-0">₹{{ number_format(auth()->user()->totalAmount()) }}
                                            <small class="text-muted"> /
                                                ₹{{ $campaign->individualTarget(',', true, $campaign->pivot->location) }}</small> </span>
                                    @else
                                        <span class="text-success">Completed</span>
                                    @endif
                                </div>
                                <div><i class="material-icons icon-muted icon-40pt ml-3">monetization_on</i></div>
                            </div>
                            @if (!auth()->user()->targetMet())
                                <div class="progress" style="height: 3px;">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ auth()->user()->totalAmountPercentage() }}%;"
                                        aria-valuenow="{{ auth()->user()->totalAmountPercentage() }}" aria-valuemin="0"
                                        aria-valuemax="100">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 card-group-row__col">
                        <div class="card card-group-row__card">
                            <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                                <div class="flex">
                                    <div class="card-header__title text-muted d-flex mb-2">Your total amount</div>
                                    <span
                                        class="h4 m-0">₹{{ number_format(auth()->user()->totalAmount()) }}</span>
                                </div>
                                <div><i class="material-icons icon-muted icon-40pt ml-3">contacts</i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 card-group-row__col">
                        <div class="card card-group-row__card">
                            <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                                <div class="flex">
                                    <div class="card-header__title text-muted mb-2">Amount Received <span
                                            class="badge badge-success ml-2">{{ number_format(auth()->user()->totalAmountReceived('percentage'),2) }}%</span>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <div class="h4 m-0">
                                            ₹{{ number_format(auth()->user()->totalAmountReceived('amount')) }}</div>
                                        <div class="progress ml-1" style="width:100%;height: 3px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ auth()->user()->totalAmountReceived('percentage') }}%;"
                                                aria-valuenow="{{ auth()->user()->totalAmountReceived('percentage') }}"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div><i class="material-icons icon-muted icon-40pt ml-3">assignment_turned_in</i></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row card-group-row">
                    <div class="col-lg-6 card-group-row__col">
                        <div class="card card-group-row__card dashboard-table-card">
                            <div class="card-header dashboard-table-card__header">
                                <div class="card-header__title">Top 10</div>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-bordered dashboard-table">
                                    @if ($toppers && count($toppers) > 0)
                                        <thead>
                                            <tr>
                                                <th class="dashboard-table__rank">#</th>
                                                <th>Name</th>
                                                <th class="text-right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($toppers as $key => $topper)
                                                <tr class="{{ $topper->id == auth()->id() ? 'table-primary' : '' }}">
                                                    <td class="dashboard-table__rank">{{ $key + 1 }}</td>
                                                    <td>
                                                        <span class="font-weight-medium">{{ $topper->name }}</span>
                                                        <span class="d-block small text-muted">{{ $topper->batch }}</span>
                                                    </td>
                                                    <td class="text-right dashboard-table__amount">{{ number_format($topper->total_amount) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    @else
                                        <tbody>
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">No toppers found!</td>
                                            </tr>
                                        </tbody>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 card-group-row__col">
                        @include('components.batch_wise', ['campaign' => $campaign])
                    </div>
                </div>
            @else
                <p class="text-muted mb-0">No active campaign found!</p>
            @endif
        </div>
    </div>
@endsection
