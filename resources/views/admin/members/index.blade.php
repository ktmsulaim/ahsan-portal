@extends('layouts.base', ['title' => "Dashboard"])

@section('breadcrumb')
<li class="breadcrumb-item active"><a href="{{ route('admin.users.index') }}">Members</a></li>
@endsection

@section('action_button')
<a href="{{ route('admin.users.create') }}"
class="btn btn-success ml-1">Add</a>
@endsection

@section('content')
    
@endsection