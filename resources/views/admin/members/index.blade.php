@extends('layouts.base', ['title' => "Members"])

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Members</a></li>
@endsection

@section('action_button')
    <a href="{{ route('admin.users.create') }}" class="btn btn-success ml-1"><span
            class="material-icons mr-2">person_add</span> Add</a>
    <button class="btn btn-info ml-1" id="importMembersModalTrigger"><span class="material-icons mr-2">import_export</span>
        Import</button>
@endsection

@section('content')
    <div id="modal-import" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-large-title"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-large-title">Import Members</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> <!-- // END .modal-header -->
                <div class="modal-body">
                    <p>Select Excel file to import members. Make sure all required columns have any value.</p>

                    <form id="importMembersForm" action="{{ route('admin.users.import') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="file" id="file" data-max-file-size="250" class="fileinput-any"
                            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                            required>
                    </form>
                </div> <!-- // END .modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button form="importMembersForm" class="btn btn-primary" type="submit">Upload</button>
                </div> <!-- // END .modal-footer -->
            </div> <!-- // END .modal-content -->
        </div> <!-- // END .modal-dialog -->
    </div> <!-- // END .modal -->
    
    <div id="modal-bulkedit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-large-title"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-large-title">Bulk Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> <!-- // END .modal-header -->
                <div class="modal-body">

                    <form id="bulkEditForm" action="{{ route('admin.users.bulkupdate') }}" method="post">
                        @csrf
                        <input type="hidden" name="selected" id="selectedIds">
                       <div class="form-group">
                           <select name="column" id="column" class="form-control" required>
                               <option value="batch">Batch</option>
                               <option value="dhiu_dept">Department</option>
                               <option value="dhiu_batch">Batch (DHIU)</option>
                               <option value="district">District</option>
                           </select>
                       </div>
                       <div class="form-group">
                           <input type="text" placeholder="Type any value here...." class="form-control" name="value" id="value">
                       </div>
                    </form>
                </div> <!-- // END .modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                    <button form="bulkEditForm" class="btn btn-primary" type="submit">Save</button>
                </div> <!-- // END .modal-footer -->
            </div> <!-- // END .modal-content -->
        </div> <!-- // END .modal-dialog -->
    </div> <!-- // END .modal -->

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
                        <div class="col-md-4">
                            <div id="bulkEdit">
                                <button class="btn btn-primary" id="bulkEditTrigger">Edit</button>
                            </div>
                        </div>
                    </div>
                    <table id="membersTable" class="table">
                        <thead>
                            <tr>
                                <td>AD.NO</td>
                                <td>Photo</td>
                                <td>Name</td>
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
                        data: 'phone_personal'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'url',
                        render: function(data) {
                            return `<a class="btn btn-sm" href="${data.show}"><span class="material-icons">visibility</span></a><a class="btn btn-sm" href="${data.edit}"><span class="material-icons">create</span></a>`;
                        }
                    }
                ]
            })




            $('#batch').change(function() {
                batch = $(this).val()
                url = baseUrl + batch;

                table.ajax.url(url).load();
                table.ajax.reload();
                table.draw();
            })


            function bulkEdit() {
                let selected = [];
                let editWrapper = $('#bulkEdit');

                editWrapper.hide();

                $('#membersTable').on('click', 'tbody tr', function(e) {
                    $(this).toggleClass('selected');
                    const id = $(this).data('id');

                    if(selected.includes(id)) {
                        const index = selected.indexOf(id);
                        selected.splice(index, 1);
                    } else {
                        selected.push(id);
                    }
                    

                    if(selected && selected.length > 0) {
                        editWrapper.show();
                        $('#modal-bulkedit').find('#selectedIds').val(selected);
                    } else {
                        editWrapper.hide();
                    }

                    console.log(selected);
                });

                if(selected && selected.length > 0) {
                    editWrapper.show();
                    $('#modal-bulkedit').find('#selectedIds').val(selected);
                } else {
                    editWrapper.hide();
                }
            }

            bulkEdit();
        })

    </script>
@endsection
