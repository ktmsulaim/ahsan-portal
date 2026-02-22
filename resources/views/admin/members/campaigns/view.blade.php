@extends('layouts.base', ['title' => "View member"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Members</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a></li>
    <li class="breadcrumb-item active">{{ $campaign->name }}</li>
@endsection

@section('action_button')
    @if ($userCampaign)
        @include('components.add_sponsor')
    @endif
@endsection


@section('content')
@if (!$userCampaign)
    <div class="row">
        <div class="col-md-12">
            <div class="card border-warning">
                <div class="card-body">
                    <h5 class="card-title">Set location for this campaign</h5>
                    <p class="text-muted mb-3">This member has not selected a location for {{ $campaign->name }}. Set a location below to add sponsors on their behalf.</p>
                    @if ($campaign->locations && count($campaign->locations) > 0)
                        <form action="{{ route('admin.user-campaign.updateLocation', ['user' => $user->id, 'campaign' => $campaign->id]) }}" method="post" class="form-inline">
                            @csrf
                            <div class="form-group mr-2">
                                <label for="location" class="sr-only">Location</label>
                                <select class="form-control" name="location" id="location" required>
                                    @foreach ($campaign->locations as $key => $value)
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Set location</button>
                        </form>
                    @else
                        <form action="{{ route('admin.user-campaign.updateLocation', ['user' => $user->id, 'campaign' => $campaign->id]) }}" method="post" class="form-inline">
                            @csrf
                            <input type="hidden" name="location" value="General">
                            <button type="submit" class="btn btn-primary">Assign to campaign</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@else
    <div class="row mb-2">
        <div class="col-md-12 d-flex align-items-center flex-wrap">
            <span class="badge badge-secondary mr-2">Location: {{ $userCampaign->pivot->location }}</span>
            @if ($campaign->locations && count($campaign->locations) > 1)
                <form action="{{ route('admin.user-campaign.updateLocation', ['user' => $user->id, 'campaign' => $campaign->id]) }}" method="post" class="form-inline">
                    @csrf
                    <select class="form-control form-control-sm mr-1" name="location">
                        @foreach ($campaign->locations as $key => $value)
                            <option value="{{ $key }}" {{ $userCampaign->pivot->location === $key ? 'selected' : '' }}>{{ $key }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline-secondary">Update location</button>
                </form>
            @endif
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-header__title m-0">Sponsors</div>
                <div>
                    @if ($userCampaign)
                    <form action="{{ route('admin.sponsors.export', $campaign->id) }}" method="get" class="d-inline">
                        <input type="hidden" name="mode" value="admin.member">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button class="btn btn-info"><span class="material-icons">import_export</span> Export</button>
                    </form>
                    @endif
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="userSponsorsTable" class="table">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Name</td>
                            <td>Place</td>
                            <td>Phone</td>
                            <td>Amount</td>
                            <td>Amount received</td>
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
            const table = $("#userSponsorsTable").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    contentType: 'application/json',
                    url: "{{ route('admin.sponsors.dtByUser', ['user' => $user->id, 'campaign' => $campaign->id]) }}",
                    type: 'GET',
                },
                'paging': true,
                'responsive': true,
                'lengthChange': true,
                'searching': true,
                'ordering': true,
                'order': [6, 'desc'],
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
                        width: '10%'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'urls',
                        render: function(data) {
                            return `<a class="btn btn-sm" href="${data.view}"><span class="material-icons">visibility</span></a><a class="btn btn-sm ml-2" href="${data.edit}"><span class="material-icons">create</span></a>`;
                        }
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