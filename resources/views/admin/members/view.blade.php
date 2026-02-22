@extends('layouts.base', ['title' => "View member"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Members</a></li>
    <li class="breadcrumb-item active">{{ $user->name }}</li>
@endsection

@section('content')
    <div class="member-view-header">
        <div class="member-view-header__banner"></div>
        <div class="member-view-header__content container-fluid page__container">
            <div class="member-view-header__avatar">
                <img src="{{ $user->photo() }}" alt="" class="rounded">
            </div>
            <div class="member-view-header__tabs card-header card-header-tabs-basic nav" role="tablist">
                <a href="#profile" class="active show" data-toggle="tab" role="tab" aria-selected="true">Profile</a>
                <a href="#campaigns" data-toggle="tab" role="tab" aria-selected="false">Campaigns</a>
            </div>
        </div>
    </div>

    <div class="row member-view-body">
        <div class="col-lg-3 member-view-info">
            <h1 class="h4 mb-1">{{ $user->name }}</h1>
            <p class="text-muted mb-1">{{ $user->email }}</p>
            <p class="mb-2">{{ $user->batch }}</p>
            <div class="member-view-info__row text-muted">
                <i class="material-icons">location_on</i>
                <span>{{ $user->address1 }}</span>
            </div>
            <div class="member-view-info__row text-muted">
                <i class="material-icons">local_phone</i>
                <a href="tel:{{ $user->phone_personal }}">{{ $user->phone_personal }}</a>
            </div>
            <div class="member-view-info__row text-muted">
                <i class="material-icons">alarm</i>
                <span>Last login: {{ optional($user->last_login)->diffForHumans() }}</span>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="tab-content">
                <div class="tab-pane active" id="profile">
                    <div class="card member-profile-card">
                        <div class="card-body">
                            <div class="member-profile-table-wrapper table-responsive">
                                <table class="table member-profile-table">
                                <tr>
                                    <th width="150">Batch</th>
                                    <td>{{ $user->batch }}</td>
                                </tr>
                                <tr>
                                    <th>Adimssion No</th>
                                    <td>{{ $user->adno }}</td>
                                </tr>
                                <tr>
                                    <th width="150">Batch DHIU</th>
                                    <td>{{ $user->dhiu_batch }}</td>
                                </tr>
                                <tr>
                                    <th>AD.No DHIU</th>
                                    <td>{{ $user->dhiu_adno }}</td>
                                </tr>
                                <tr>
                                    <th>Department</th>
                                    <td>{{ $user->dhiu_dept }}</td>
                                </tr>
                                <tr>
                                    <th>Father's name</th>
                                    <td>{{ $user->father_name }}</td>
                                </tr>
                                <tr>
                                    <th>Mother's name</th>
                                    <td>{{ $user->mother_name }}</td>
                                </tr>
                                <tr>
                                    <th>Address 1</th>
                                    <td>{{ $user->address1 }}</td>
                                </tr>
                                <tr>
                                    <th>Address 2</th>
                                    <td>{{ $user->address2 }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Home</th>
                                    <td>{{ $user->phone_home }}</td>
                                </tr>
                                <tr>
                                    <th>DOB</th>
                                    <td>{{ $user->dob }}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $user->state }}</td>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <td>{{ $user->district }}</td>
                                </tr>
                                <tr>
                                    <th>Marital Status</th>
                                    <td>{{ $user->marital_status == 1 ? 'Married' : 'Not married' }}</td>
                                </tr>
                                </table>
                            </div>
                            <div class="member-profile-card__action mt-3">
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary btn-edit-profile">
                                    <span class="material-icons">mode_edit</span>
                                    <span class="ml-2">Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="campaigns">
                    @if (count($campaigns) > 0)
                        <div class="row card-group-row member-campaigns-list">
                            @foreach ($campaigns as $camp)
                            @php
                                $userCampaign = $user->campaigns()->where('campaigns.id', $camp->id)->first();
                                $totalSponsors = $user->sponsors()->where('campaign_id', $camp->id)->count();
                                $totalAmount = $user->sponsors()->where('campaign_id', $camp->id)->sum('amount');
                                $targetMet = $userCampaign ? (($totalAmount >= $camp->individualTarget('', true, $userCampaign->pivot->location)) ? 'Yes' : 'No') : '-';
                                $topAmount = $user->sponsors()->where('campaign_id', $camp->id)->orderBy('amount', 'desc')->first();
                            @endphp
                            <div class="col-12 col-lg-6 card-group-row__col mb-3">
                                <div class="card card-group-row__card member-campaign-card h-100">
                                    <div class="card-body">
                                        <div class="member-campaign-card__image">
                                            <img src="{{ $camp->logo() }}" class="img-fluid" alt="">
                                        </div>
                                        <div class="member-campaign-card__title d-flex flex-wrap align-items-center">
                                            <h4 class="h5 mb-1 mr-2"><a href="{{ route('admin.sponsors.byUser', ['user' => $user->id, 'campaign' => $camp->id]) }}">{{ $camp->name }}</a></h4>
                                            @if (!$userCampaign)
                                                <span class="badge badge-warning member-campaign-card__badge">Location not set</span>
                                            @else
                                                <span class="badge badge-secondary member-campaign-card__badge">{{ $userCampaign->pivot->location }}</span>
                                            @endif
                                        </div>
                                        <div class="member-campaign-card__summary">
                                            <div class="row no-gutters">
                                                <div class="col-6 py-1">
                                                    <span class="text-muted small">Total sponsors:</span>
                                                    <span class="d-block font-weight-medium">{{ $totalSponsors }}</span>
                                                </div>
                                                <div class="col-6 py-1">
                                                    <span class="text-muted small">Total amount:</span>
                                                    <span class="d-block font-weight-medium">₹{{ number_format($totalAmount) }}</span>
                                                </div>
                                                <div class="col-6 py-1">
                                                    <span class="text-muted small">Target met:</span>
                                                    <span class="d-block font-weight-medium">{{ $targetMet }}</span>
                                                </div>
                                                <div class="col-6 py-1">
                                                    <span class="text-muted small">Top amount:</span>
                                                    <span class="d-block font-weight-medium">₹{{ $topAmount ? number_format($topAmount->amount) : 0 }}</span>
                                                </div>
                                            </div>
                                            @if (!$userCampaign)
                                                <p class="text-muted mt-2 mb-0 member-campaign-card__hint">Set location for this campaign to add sponsors.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p>No campaigns found!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
