<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}"
                required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="email">Email <span class="text-danger">*</span></label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}"
                required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="adno">Admission no <span class="text-danger">*</span></label>
            <input type="number" min="0" class="form-control" name="adno"
                value="{{ old('adno', $user->adno) }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="batch">Batch <span class="text-danger">*</span></label>
            <select name="batch" id="batch" class="form-control" required>
                @for ($i = 1; $i <= 7; $i++)
                    <option value="Batch {{ $i }}" {{ $user->batch == "Batch " . $i ? 'selected' : ''}}>Batch {{ $i }}</option>
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
                <option {{ $user->dhiu_dept == "Department of Quran and Related Sciences" ? 'selected' : '' }} value="Department of Quran and Related Sciences">Department of Quran and
                    Related Sciences</option>
                <option {{ $user->dhiu_dept == "Department of Hadeeth and Related Sciences" ? 'selected' : '' }} value="Department of Hadeeth and Related Sciences">Department of Hadeeth and
                    Related Sciences</option>
                <option {{ $user->dhiu_dept == "Department of Fiqh and Usul ul Fiqh" ? 'selected' : '' }} value="Department of Fiqh and Usul ul Fiqh">Department of Fiqh and Usul ul
                    Fiqh</option>
                <option {{ $user->dhiu_dept == "Department of Aqeeda and Philosophy" ? 'selected' : '' }} value="Department of Aqeeda and Philosophy">Department of Aqeeda and
                    Philosophy</option>
                <option {{ $user->dhiu_dept == "Department of Da'wa and Comparitive Religion" ? 'selected' : '' }} value="Department of Da'wa and Comparitive Religion">Department of Da'wa and
                    Comparitive Religion</option>
                <option {{ $user->dhiu_dept == "Department of Arabic Language and Literature" ? 'selected' : '' }} value="Department of Arabic Language and Literature">Department of Arabic
                    Language and Literature</option>
                <option {{ $user->dhiu_dept == 'None of above' ? 'selected' : '' }} value="None of above">None of above</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="dhiu_adno">Admission No (DHIU) <span class="text-danger">*</span></label>
            <input type="number" min="0" class="form-control" name="dhiu_adno"
                value="{{ old('dhiu_adno', $user->dhiu_adno) }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <label for="dhiu_batch">Batch (DHIU) <span class="text-danger">*</span></label>
        <select name="dhiu_batch" id="dhiu_batch" class="form-control" required>
            @for ($i = 13; $i <= 27; $i++)
                <option {{ ($user->dhiu_batch == "Batch ".$i || $user->dhiu_batch == $i) ? 'selected' : '' }} value="Batch {{ $i }}">Batch {{ $i }}</option>
            @endfor
        </select>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="father_name">Father's Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="father_name"
                value="{{ old('father_name', $user->father_name) }}" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="mother_name">Mother's Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="mother_name"
                value="{{ old('mother_name', $user->mother_name) }}" required>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="dob">DOB <span class="text-danger">*</span></label>
            <input type="text" class="form-control flatpickr" id="dob" name="dob"
                value="{{ old('dob', $user->dob) }}" required>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="marital_status">Marital status</label>
            <div>
                <div class="custom-control custom-checkbox-toggle custom-control-inline mr-1">    
                    <input type="hidden" name="marital_status" id="marital_status_input" value="{{ $user->marital_status ? 1 : 0 }}">
                    <input data-target="#marital_status_input" type="checkbox" id="marital_status" class="custom-control-input" {{ $user->marital_status ? 'checked' : '' }}>
                    <label for="marital_status" class="custom-control-label"></label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="state">State <span class="text-danger">*</span></label>
            <select class="form-control" name="state" id="state" data-state="{{ $user->state }}"></select>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="district">District <span class="text-danger">*</span></label>
            <select class="form-control" name="district" id="district" data-district="{{ $user->district }}" disabled required>
                <option value="">--Select--</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="address1">Address <span class="text-danger">*</span></label>
            <textarea class="form-control" name="address1" id="address1"
                required>{{ old('address1', $user->address1) }}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="address2">Address 2</label>
            <textarea class="form-control" name="address2"
                id="address2">{{ old('address2', $user->address2) }}</textarea>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone_home">Phone (Home)</label>
            <input type="tel" name="phone_home" id="phone_home" class="form-control"
                value="{{ old('phone_home', $user->phone_home) }}">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="phone_personal">Phone (Personal) <span class="text-danger">*</span></label>
            <input type="tel" name="phone_personal" id="phone_personal" class="form-control"
                value="{{ old('phone_personal', $user->phone_personal) }}" required>
        </div>
    </div>
</div>
@if ($is_admin)    
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control"
                value="">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="password-confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password-confirmation" class="form-control"
                value="">
        </div>
    </div>
</div>
@endif

<div class="row col-md-12">
    <button class="btn btn-primary">Submit</button>
</div>