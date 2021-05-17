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
                            <img src="{{ $campaign->logo() }}" width="60%" alt="{{ $campaign->name }}"
                                class="img-fluid">
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
                        <div class="card-header__title text-muted mb-2 d-flex">Target <span
                                class="badge badge-warning ml-2">{{ number_format($campaign->totalAmountPercentage(), 2) }}%</span></div>
                        <span class="h4 m-0">₹{{ number_format($campaign->totalAmount()) }} <small class="text-muted"> /
                                ₹{{ number_format($campaign->target) }}</small> </span>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">monetization_on</i></div>
                </div>
                <div class="progress" style="height: 3px;">
                    <div class="progress-bar bg-warning" role="progressbar"
                        style="width: {{ $campaign->totalAmountPercentage() }}%;"
                        aria-valuenow="{{ $campaign->totalAmountPercentage() }}" aria-valuemin="0" aria-valuemax="100">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted d-flex mb-2">Individual Target <span
                                class="badge badge-primary ml-2">{{ $targetMetCount }}</span></div>
                        <span class="h4 m-0">₹{{ $campaign->individualTarget() }}</span>
                    </div>
                    <div><i class="material-icons icon-muted icon-40pt ml-3">contacts</i></div>
                </div>
                <div class="progress" style="height: 3px;">
                    <div class="progress-bar" role="progressbar" style="width: {{ $targetMetPercentage }}%;"
                        aria-valuenow="{{ $targetMetPercentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 card-group-row__col">
            <div class="card card-group-row__card">
                <div class="card-body-x-lg card-body d-flex flex-row align-items-center">
                    <div class="flex">
                        <div class="card-header__title text-muted mb-2">Amount Received <span
                            class="badge badge-success ml-2">{{ number_format($campaign->totalAmountPercentage('received'), 2) }}%</span></div>

                        <div class="d-flex align-items-center">
                            <div class="h4 m-0">₹{{ number_format($campaign->totalAmount('received')) }}</div>
                            <div class="progress ml-1"
                                 style="width:100%;height: 3px;">
                                <div class="progress-bar bg-success"
                                     role="progressbar"
                                     style="width: {{ $campaign->totalAmountPercentage('received') }}%;"
                                     aria-valuenow="{{ $campaign->totalAmountPercentage('received') }}"
                                     aria-valuemin="0"
                                     aria-valuemax="100"></div>
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
            @include('components.batch_wise', ['campaign' => $campaign])
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-header__title m-0">Sponsors</div>
                    <div>
                        <form action="{{ route('admin.sponsors.export', $campaign->id) }}" method="get">
                            <input type="hidden" name="mode" value="all">
                            <button class="btn btn-info"><span class="material-icons">import_export</span> Export</button>
                        </form>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table id="sponsorsTable" class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Name</td>
                                <td>Place</td>
                                <td>Phone</td>
                                <td>Amount</td>
                                <td>Amount received</td>
                                <td>Care of</td>
                                <td>Date</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            const table = $("#sponsorsTable").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    contentType: 'application/json',
                    url: "{{ route('admin.sponsors.index', $campaign->id) }}",
                    type: 'GET',
                },
                'responsive': true,
                'paging': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'order': [7, 'desc'],
                'info': true,
                'autoWidth': false,
                'createdRow': function(row, data, dataIndex) {
                    if(data.verification == 1) {
                        $(row).addClass('bg-success');
                    }

                    $(row).attr('data-id', data.id);
                },
                'columns': [{
                        data: 'id',
                        orderable: false,
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'place'
                    },
                    {
                        data: 'phone'
                    },
                    {
                        data: 'amount'
                    },
                    {
                        data: 'amount_received',
                        render: function(data) {
                            return data == 1 ? '<span class="badge badge-success">Yes</span>' :
                                '<span class="badge badge-danger">No</span>';
                        },
                        width: '5%'
                    },
                    {
                        data: 'user',
                        render: function(data) {
                            return `<a class="small" href="${data.link}">${data.name}</a>`;
                        }
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'urls',
                        render: function(data) {
                            return `<a class="btn btn-sm btn-info btn-block" href="${data.view}">View</a><a class="btn btn-sm btn-primary btn-block" href="${data.edit}">Edit</a>`;
                        },
                        orderable:false
                    }
                ]
            })

            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });

    </script>
@endsection
