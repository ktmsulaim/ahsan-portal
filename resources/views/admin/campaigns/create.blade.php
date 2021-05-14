@extends('layouts.base', ['title' => "Add new campaign"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
    <li class="breadcrumb-item active">Add</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body card-form__body">
                    <form id="campaignAddForm" action="{{ route('admin.campaigns.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" required>{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="target">Target <span class="text-danger">*</span></label>
                            <input type="number" min="0" name="target" id="target" placeholder="10,00,000" class="form-control" value="{{ old('target') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option value="0">Disable</option>
                                        <option value="1">Enable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="active">Is active</label>
                                    <select name="active" id="active" class="form-control" required>
                                        <option value="0">Inactive</option>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('components.errors')
            <div class="card">
                <div class="card-body card-form__body">
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input form="campaignAddForm" type="file" name="logo" id="logo" class="fileinput" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection