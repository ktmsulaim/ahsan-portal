@extends('layouts.base', ['title' => "Edit campaign"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.show', $campaign->id) }}">{{ $campaign->name }}</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body card-form__body">
                    <form id="campaignAddForm" action="{{ route('admin.campaigns.update', $campaign->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $campaign->name) }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" required>{{ old('description', $campaign->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="target">Target <span class="text-danger">*</span></label>
                            <input type="number" min="0" name="target" id="target" placeholder="10,00,000" class="form-control" value="{{ old('target', $campaign->target) }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option {{ $campaign->status == 0 ? 'selected' : '' }} value="0">Disable</option>
                                        <option {{ $campaign->status == 1 ? 'selected' : '' }} value="1">Enable</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="active">Is active</label>
                                    <select name="active" id="active" class="form-control" required>
                                        <option {{ $campaign->active == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                        <option {{ $campaign->active == 1 ? 'selected' : '' }} value="1">Active</option>
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
                        <input form="campaignAddForm" type="file" name="logo" id="logo" class="fileinput">
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <b class="text-danger">Delete Campaign</b>
                    </div>
                </div>
                <div class="card-body">
                    @include('components.delete_form', ['type' => 'campaign', 'deleteUrl' => route('admin.campaigns.destroy', $campaign->id)])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function(){
            $('#logo').fileinput('destroy').fileinput({
                showUpload: false,
                theme: 'fas',
                maxFileSize: 512,
                allowedFileTypes: ['image'],
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
                @if ($campaign->logo)
                initialPreview: "{{ $campaign->logo }}",
                initialPreviewAsData: true,
                @endif
            })
        })
    </script>
@endsection