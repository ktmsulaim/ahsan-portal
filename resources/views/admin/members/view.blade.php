@extends('layouts.base', ['title' => "Dashboard"])

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Members</a></li>
<li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')
    
@endsection