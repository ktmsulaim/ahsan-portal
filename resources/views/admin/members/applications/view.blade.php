@extends('layouts.base', ['title' => "View application"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Members</a></li>
    <li class="breadcrumb-item active"><a href="{{ route('admin.users.applications.index') }}">Applications</a></li>
    <li class="breadcrumb-item active">{{ $userApplication->name }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body card-form__body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->name }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="adno">Admission no <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->dob }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="batch">Batch <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->batch }}
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="dhiu_dept">Department <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->dhiu_dept }}
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dhiu_adno">Admission No (DHIU) <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->dhiu_adno }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="dhiu_batch">Batch (DHIU) <span class="text-danger">*</span></label>
                            <div>
                                {{ $userApplication->dhiu_batch }}
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="father_name">Father's Name <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->father_name }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mother_name">Mother's Name <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->mother_name }}
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dob">DOB <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->dob }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="marital_status">Marital status</label>
                                <div>
                                    {{ $userApplication->marital_status == 1 ? 'Married' : 'Not married' }}
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district">State <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->state }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district">District <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->district }}
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address1">Address <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->address1 }}
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address2">Address 2</label>
                                <div>
                                    {{ $userApplication->address2 }}
                                </div>
                            </div>
                        </div>
                    </div>
        
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_home">Phone (Home)</label>
                                <div>
                                    {{ $userApplication->phone_home }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone_personal">Phone (Personal) <span class="text-danger">*</span></label>
                                <div>
                                    {{ $userApplication->phone_personal }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ $userApplication->photo() }}" alt="Applicant's photo" width="150" class="img-fluid">
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-header__title">Verification</div>
                </div>
                <div class="card-body">
                    @if ($userApplication->status == 1)
                        <p class="alert alert-success">This application has been verified. Invalidating this application will loss the applicant access to the members area.</p>
                    @endif
                    <form action="{{ route('admin.users.applications.updateStatus', $userApplication->id) }}" method="post">
                        @csrf
                        
                        <div class="form-group">
                            <select class="form-control" name="status" id="status">
                                <option value="0">Invalid</option>
                                <option value="1">Valid</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection