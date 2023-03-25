@extends('layouts.app', ['title' => "Campaigns"])

@section('breadcrumb')
    <li class="breadcrumb-item active">Campaigns</li>
@endsection

@section('content')
        <div class="row">
            @if (count($user->campaigns) > 0)
                @foreach ($user->campaigns()->orderBy('created_at', 'desc')->get() as $campaign)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-image">
                                    <img class="img-fluid" src="{{ $campaign->logo() }}" alt="{{ $campaign->name }}">
                                </div>
                                <div class="mt-4">
                                    <h4><a href="{{ route('user.campaigns.show', $campaign->id) }}">{{ $campaign->name }}</a></h4>
                                </div>
                            </div>
                            <div class="card-footer">
                                @if ($campaign->pivot->location)
                                    <span class="badge badge-secondary">{{ $campaign->pivot->location }}</span>
                                @endif
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