@extends('layouts.base', ['title' => "Applications"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Members</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.users.applications.index') }}">Applications</a></li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <select id="status" class="form-control">
                               <option value="0">Not verified</option>
                               <option value="1">Verified</option>
                            </select>
                        </div>
                    </div>
                    <table id="membersTable" class="table">
                        <thead>
                            <tr>
                                <td>AD.NO</td>
                                <td>Photo</td>
                                <td>Name</td>
                                <td>Batch</td>
                                <td>Phone</td>
                                <td>Email</td>
                                <td></td>
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

            let status = $('#status').val();
            const baseUrl = "/admin/members/applications/ajax/";
            let url = baseUrl + status

            const table = $("#membersTable").DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    contentType: 'application/json',
                    url: url,
                    type: 'GET',
                },
                'paging': true,
                'lengthChange': false,
                'searching': true,
                'ordering': true,
                'info': true,
                'autoWidth': false,
                'createdRow': function(row, data, dataIndex) {
                    $(row).attr('data-id', data.id);
                },
                'columns': [{
                        data: 'adno'
                    },
                    {
                        data: 'photo',
                        render: function(data, type, full, meta) {
                            return `<img width="60" class="img-circle" src="${data}" >`;
                        }
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'batch'
                    },
                    {
                        data: 'phone_personal'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'url',
                        render: function(data) {
                            return `<a class="btn btn-sm" href="${data.show}"><span class="material-icons">visibility</span></a>`;
                        },
                        orderable: false
                    }
                ]
            })


            $('#status').change(function() {
                status = $(this).val()
                url = baseUrl + status;

                table.ajax.url(url).load();
                table.ajax.reload();
                table.draw();
            })
        })

    </script>
@endsection
