@extends('layouts.base', ['title' => "Add new member"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Members</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-form">
                <div class="card-body card-form__body">
                    <form id="userForm" action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password"
                                        value="{{ old('password') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password <span
                                            class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        value="{{ old('password_confirmation') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="adno">Admission no <span class="text-danger">*</span></label>
                                    <input type="number" min="0" class="form-control" name="adno"
                                        value="{{ old('adno') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="batch">Batch <span class="text-danger">*</span></label>
                                    <select name="batch" id="batch" class="form-control" required>
                                        @for ($i = 1; $i <= 7; $i++)
                                            <option value="Batch {{ $i }}">Batch {{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dhiu_dept">Department <span class="text-danger">*</span></label>
                                    <select name="dhiu_dept" id="dhiu_dept" class="form-control" required>
                                        <option value="Department of Quran and Related Sciences">Department of Quran and
                                            Related Sciences</option>
                                        <option value="Department of Hadeeth and Related Sciences">Department of Hadeeth and
                                            Related Sciences</option>
                                        <option value="Department of Fiqh and Usul ul Fiqh">Department of Fiqh and Usul ul
                                            Fiqh</option>
                                        <option value="Department of Aqeeda and Philosophy">Department of Aqeeda and
                                            Philosophy</option>
                                        <option value="Department of Da'wa and Comparitive Religion">Department of Da'wa and
                                            Comparitive Religion</option>
                                        <option value="Department of Arabic Language and Literature">Department of Arabic
                                            Language and Literature</option>
                                        <option value="None of above">None of above</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dhiu_adno">Admission No (DHIU) <span class="text-danger">*</span></label>
                                    <input type="number" min="0" class="form-control" name="dhiu_adno"
                                        value="{{ old('dhiu_adno') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="dhiu_batch">Batch (DHIU) <span class="text-danger">*</span></label>
                                <select name="dhiu_batch" id="dhiu_batch" class="form-control" required>
                                    @for ($i = 13; $i <= 27; $i++)
                                        <option value="Batch {{ $i }}">Batch {{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="father_name">Father's Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="father_name"
                                        value="{{ old('father_name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mother_name">Mother's Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mother_name"
                                        value="{{ old('mother_name') }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dob">DOB <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control flatpickr" id="dob" name="dob"
                                        value="{{ old('dob') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="district">District <span class="text-danger">*</span></label>
                                    <select class="form-control" name="district" id="district" required>
                                        <option value="">--Select--</option>

                                        <option value="ALAPPUZHA">ALAPPUZHA</option>

                                        <option value="ERNAKULAM">ERNAKULAM</option>

                                        <option value="IDUKKI">IDUKKI</option>

                                        <option value="KANNUR">KANNUR</option>

                                        <option value="KASARAGOD">KASARAGOD</option>

                                        <option value="KOLLAM">KOLLAM</option>

                                        <option value="KOTTAYAM">KOTTAYAM</option>

                                        <option value="KOZHIKODE">KOZHIKODE</option>

                                        <option value="MALAPPURAM">MALAPPURAM</option>

                                        <option value="PALAKKAD">PALAKKAD</option>

                                        <option value="PATHANAMTHITTA">PATHANAMTHITTA</option>

                                        <option value="THIRUVANANTHAPURAM">THIRUVANANTHAPURAM</option>

                                        <option value="THRISSUR">THRISSUR</option>

                                        <option value="WAYANAD">WAYANAD</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address1">Address <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="address1" id="address1"
                                        required>{{ old('address1') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address2">Address 2</label>
                                    <textarea class="form-control" name="address2"
                                        id="address2">{{ old('address2') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_home">Phone (Home)</label>
                                    <input type="tel" name="phone_home" id="phone_home" class="form-control"
                                        value="{{ old('phone_home') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_personal">Phone (Personal) <span class="text-danger">*</span></label>
                                    <input type="tel" name="phone_personal" id="phone_personal" class="form-control"
                                        value="{{ old('phone_personal') }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="marital_status">Marital status</label>
                                    <div>
                                        <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">    
                                            <input type="checkbox" name="marital_status" id="marital_status" class="custom-control-input" value=false>
                                            <label for="marital_status" class="custom-control-label"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row col-md-12">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('components.errors')

            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <input type="file" name="photo" id="photo" class="fileinput" form="userForm">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
