@extends('layouts.base', ['title' => 'Edit campaign'])

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
                    <form id="campaignAddForm" action="{{ route('admin.campaigns.update', $campaign->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $campaign->name) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" required>{{ old('description', $campaign->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="target">Target <span class="text-danger">*</span></label>
                            <input type="number" min="0" name="target" id="target" placeholder="10,00,000"
                                class="form-control" value="{{ old('target', $campaign->target) }}" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group"><label for="status">Status</label>
                                    <select name="status" id="status" class="form-control" required>
                                        <option {{ $campaign->status == 0 ? 'selected' : '' }} value="0">Disable
                                        </option>
                                        <option {{ $campaign->status == 1 ? 'selected' : '' }} value="1">Enable
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="active">Is active</label>
                                    <select name="active" id="active" class="form-control" required>
                                        <option {{ $campaign->active == 0 ? 'selected' : '' }} value="0">Inactive
                                        </option>
                                        <option {{ $campaign->active == 1 ? 'selected' : '' }} value="1">Active
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Locations</h5>
                        <button class="btn btn-secondary" id="add-new-location">Add new</button>
                    </div>

                </div>
                <div class="card-body card-form__body" id="locations">
                    @if ($campaign->locations)
                        @foreach ($campaign->locations as $key => $value)
                            <div class="row" data-id={{ $loop->iteration }}>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="location-{{ $loop->iteration }}">Location</label>
                                        <select form="campaignAddForm" name="location_name[]"
                                            id="location-{{ $loop->iteration }}" class="form-control">
                                            <option {{ $key == 'India' ? 'selected' : null }} value="India">India</option>
                                            <option {{ $key == 'UAE' ? 'selected' : null }} value="UAE">UAE</option>
                                            <option {{ $key == 'Qatar' ? 'selected' : null }} value="Qatar">Qatar</option>
                                            <option {{ $key == 'Bahrain' ? 'selected' : null }} value="Bahrain">Bahrain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="target-{{ $loop->iteration }}">Target</label>
                                        <div class="d-flex">
                                            <input form="campaignAddForm" type="number" min="1"
                                                name="location_target[]" id="target-{{ $loop->iteration }}"
                                                value="{{ $value['target'] }}" class="form-control">
                                            <button class="btn btn-danger ml-2"
                                                onclick="removeLocation({{ $loop->iteration }})"><i
                                                    class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="form-group">
                <button form="campaignAddForm" type="submit" class="btn btn-primary">Submit</button>
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
                    @include('components.delete_form', [
                        'type' => 'campaign',
                        'deleteUrl' => route('admin.campaigns.destroy', $campaign->id),
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
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
            });
        })
    </script>
@endsection

@section('scripts')
    <script>
        const locationsEl = $('#locations');
        if (!locationsEl.find('.row').length) {
            addLocation();
        }

        function addLocation() {
            const locationsEl = $('#locations');
            const id = locationsEl.find(".row").length + 1;

            locationsEl.append(`<div class="row" data-id=${id}>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="location-${id}">Location</label>
                                        <select form="campaignAddForm" name="location_name[]" id="location-${id}" class="form-control">
                                            <option value="India">India</option>
                                            <option value="UAE">UAE</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Bahrain">Bahrain</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="target-${id}">Target</label>
                                        <div class="d-flex">      
                                            <input form="campaignAddForm" type="number" min="1" name="location_target[]" id="target-${id}" class="form-control">
                                            <button class="btn btn-danger ml-2" onclick="removeLocation(${id})"><i class="material-icons">delete</i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>`);
        }

        function removeLocation(id) {
            const el = $('#locations').find(`div[data-id='${id}']`);

            if (!el) return;

            $(el).remove();
        }

        $('#add-new-location').click(addLocation);
    </script>
@endsection
