@extends('layouts.app', ['title' => 'Dashboard'])

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white">
                    <div class="card-header__title">Welcome, {{ auth()->user()->name }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @if ($campaign)
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h4>{{ $campaign->name }} <br> <small>Summary</small></h4>

                    @include('components.user.add_sponsor')
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
                                                ₹{{ $campaign->individualTarget() }}</small> </span>
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
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            @foreach ($toppers as $key => $topper)
                                                <tr class="{{ $topper->id == auth()->id() ? 'bg-info' : '' }}">
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>
                                                        {{ $topper->name }}
                                                        <p class="m-0"><small>{{ $topper->batch }}</small></p>
                                                    </td>
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
                        @include('components.batch_wise', ['campaign' => $campaign])
                    </div>

                </div>
            @else
                <p>No active campaign found!</p>
            @endif
        </div>
    </div>
@endsection
