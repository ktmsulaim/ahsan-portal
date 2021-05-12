@extends('layouts.base', ['title' => "View member"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Members</a></li>
    <li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')
 
    <div style="padding-bottom: calc(5.125rem / 2); position: relative; margin-bottom: 1.5rem;">
        <div class="bg-primary" style="min-height: 150px;">
            <div class="d-flex align-items-end container-fluid page__container"
                style="position: absolute; left: 0; right: 0; bottom: 0;">
                <div class="avatar avatar-xl bg-dark">
                    <img src="{{ $user->photo() }}" alt="avatar" class="avatar-img rounded"
                        style="border: 2px solid white;">
                </div>
                <div class="card-header card-header-tabs-basic nav flex" role="tablist">
                    <a href="#profile" class="active show" data-toggle="tab" role="tab" aria-selected="true">Profile</a>
                    <a href="#campaigns" data-toggle="tab" role="tab" aria-selected="false">Campaigns</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <h1 class="h4 mb-1">{{ $user->name }}</h1>
            <p class="text-muted">{{ $user->email }}</p>
            <p>{{ $user->batch }}</p>
            <div class="text-muted d-flex align-items-center">
                <i class="material-icons mr-1">location_on</i>
                <div class="flex">{{ $user->address1 }}</div>
            </div>
            <div class="text-muted d-flex align-items-center">
                <i class="material-icons mr-1">local_phone</i>
                <div class="flex"><a href="tel:{{ $user->phone_personal }}">{{ $user->phone_personal }}</a></div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="tab-content">
                <div class="tab-pane active" id="profile">

                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="150">Batch</th>
                                    <td>{{ $user->batch }}</td>
                                </tr>
                                <tr>
                                    <th>Adimssion No</th>
                                    <td>{{ $user->adno }}</td>
                                </tr>
                                <tr>
                                    <th width="150">Batch DHIU</th>
                                    <td>{{ $user->dhiu_batch }}</td>
                                </tr>
                                <tr>
                                    <th>AD.No DHIU</th>
                                    <td>{{ $user->dhiu_adno }}</td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>{{ $user->dhiu_dept }}</td>
                                </tr>
                                <tr>
                                    <th>Father's name</th>
                                    <td>{{ $user->father_name }}</td>
                                </tr>
                                <tr>
                                    <th>Mother's name</th>
                                    <td>{{ $user->mother_name }}</td>
                                </tr>
                                <tr>
                                    <th>Address 1</th>
                                    <td>{{ $user->address1 }}</td>
                                </tr>
                                <tr>
                                    <th>Address 2</th>
                                    <td>{{ $user->address2 }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Home</th>
                                    <td>{{ $user->phone_home }}</td>
                                </tr>
                                <tr>
                                    <th>DOB</th>
                                    <td>{{ $user->dob }}</td>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <td>{{ $user->district }}</td>
                                </tr>
                                <tr>
                                    <th>Marital Status</th>
                                    <td>{{ $user->marital_status == 1 ? 'Married' : 'Not married' }}</td>
                                </tr>
                            </table>

                            <div class="mt-2">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                                    <span class="material-icons">mode_edit</span>
                                    <span class="ml-2">Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="campaigns">
                    <p>All campaigns are listed here</p>
                </div>
            </div>
        </div>
    </div>
@endsection
