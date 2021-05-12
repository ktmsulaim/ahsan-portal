@extends('layouts.base', ['title' => "Members"])

@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Members</a></li>
@endsection

@section('action_button')
<a href="{{ route('admin.users.create') }}"
class="btn btn-success ml-1">Add</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <div class="row my-2">
                        <div class="col-md-4">
                            <select id="batch" class="form-control">
                                @for ($i = 1; $i <= 7; $i++)
                                    <option value="Batch {{ $i }}">Batch {{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <table id="membersTable" class="table">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Photo</td>
                                <td>Name</td>
                                <td>Phone</td>
                                <td>Joined date</td>
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
        $(function(){
            
            let batch = $('#batch').val();
            const baseUrl = "/admin/members/ajax/"; 
            let url = baseUrl + batch
    

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
                    'columns': [
                        {data: 'id'},
                        {data: 'photo', render: function(data, type, full, meta){
                            return `<img width="60" class="img-circle" src="${data}" >`;
                        }},
                        {data: 'name'},
                        {data: 'phone_personal'},
                        {data: 'created_at'},
                        {data: 'url', render: function(data) {
                            return `<a class="btn btn-sm" href="${data.show}"><span class="material-icons">visibility</span></a><a class="btn btn-sm" href="${data.edit}"><span class="material-icons">create</span></a>`;
                        }}
                    ]
                })
           


            $('#batch').change(function() {
                batch = $(this).val()
                url = baseUrl + batch;

                table.ajax.url(url).load();
                table.ajax.reload();
                table.draw();
            })


        })
    </script>
@endsection