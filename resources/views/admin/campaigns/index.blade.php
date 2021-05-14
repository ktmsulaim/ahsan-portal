@extends('layouts.base', ['title' => "Campaigns"])

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
@endsection

@section('action_button')
    <a href="{{ route('admin.campaigns.create') }}" class="btn btn-success ml-1"><span
            class="material-icons mr-2">add</span> Add</a>
@endsection

@section('content')
        <div class="row">
            @if ($campaigns && count($campaigns) > 0)
                @foreach ($campaigns as $campaign)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-image">
                                    <img class="img-fluid" src="{{ $campaign->logo() }}" alt="{{ $campaign->name }}">
                                </div>
                                <div class="mt-4">
                                    <h4><a href="{{ route('admin.campaigns.show', $campaign->id) }}">{{ $campaign->name }}</a></h4>
                                </div>
                            </div>
                            <div class="card-footer">
                                @if ($campaign->status)
                                    <span class="badge badge-success">Enabled</span>
                                @else
                                    <span class="badge badge-danger">Disabled</span>
                                @endif

                                @if ($campaign->active)
                                    <span class="badge badge-success">Active</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p>No campaigns found!</p>
            @endif
        </div>
@endsection