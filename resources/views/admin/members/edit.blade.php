@extends('layouts.base', ['title' => "Edit member"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Members</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.users.show', $user->id) }}">{{ $user->name }}</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-form">
                <div class="card-body card-form__body">
                    <form id="userForm" action="{{ route('admin.users.update', $user->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @include('components.edit_profile', ['user' => $user])
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

            <div class="mt-2 card">
                <div class="card-body">
                    <b class="text-danger">Delete Member</b>
                    <p class="mt-3">You are going to delete this member. Remember this action can't be undone!</p>
                    @include('components.delete_form', [
                        'deleteUrl' => route('admin.users.delete', $user->id),
                        'type' => 'member',
                    ])
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('#photo').fileinput('destroy').fileinput({
                showUpload: false,
                theme: 'fas',
                maxFileSize: 512,
                allowedFileTypes: ['image'],
                allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif'],
                @if ($user->photo)
                    initialPreview: "{{ $user->photo }}",
                    initialPreviewAsData: true,
                @endif
            })
        })
    </script>
@endsection
