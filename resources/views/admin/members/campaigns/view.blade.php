@extends('layouts.base', ['title' => "View member"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Members</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a></li>
    <li class="breadcrumb-item active">{{ $campaign->name }}</li>
@endsection

@section('action_button')
    @include('components.add_sponsor')
@endsection


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div class="card-header__title m-0">Sponsors</div>
                <div>
                    <form action="{{ route('admin.sponsors.export', $campaign->id) }}" method="get">
                        <input type="hidden" name="mode" value="admin.member">
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button class="btn btn-info"><span class="material-icons">import_export</span> Export</button>
                    </form>
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