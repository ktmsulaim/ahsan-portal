@extends('layouts.app', ['title' => 'Profile'])

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card card-form">
                <div class="card-header">
                    <div class="card-header__title">Profile</div>
                </div>
                <div class="card-body card-form__body">
                    <form id="userForm" action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @include('components.edit_profile', ['user' => $user, 'is_admin' => false])
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

@section('js')
    <script>
        $(function(){
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
