@extends('layouts.base', ['title' => "View sponsor"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
    <li class="breadcrumb-item"><a
            href="{{ route('admin.campaigns.show', $sponsor->campaign->id) }}">{{ $sponsor->campaign->name }}</a></li>
    <li class="breadcrumb-item">Sponsors</li>
    <li class="breadcrumb-item active">{{ $sponsor->name }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-header__title">Sponsor</div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table border">
                            <tr>
                                <th width="150">Name</th>
                                <td>{{ $sponsor->name }}</td>
                            </tr>
                            <tr>
                                <th>Place</th>
                                <td>{{ $sponsor->place }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $sponsor->phone }}</td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td>{{ number_format($sponsor->amount) }}</td>
                            </tr>
                            <tr>
                                <th>Amount Received</th>
                                <td>
                                    @if ($sponsor->amount_received)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-danger">No</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Payment Type</th>
                                <td>{{ $sponsor->payment_type }}</td>
                            </tr>
                            @if ($sponsor->payment_type === 'Recurring')
                            <tr>
                                <th>Payment Interval</th>
                                <td>{{ $sponsor->payment_type_interval }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Whatsapp</th>
                                <td>{{ $sponsor->whatsapp }}</td>
                            </tr>
                            <tr>
                                <th>Mode</th>
                                <td>{{ $sponsor->mode == 1 ? 'Cash' : 'Bank Transfer' }}</td>
                            </tr>
                            <tr>
                                <th>Transaction ID</th>
                                <td>{{ $sponsor->transaction_id }}</td>
                            </tr>
                            <tr>
                                <th>Bank</th>
                                <td>
                                    @if ($sponsor->bank == 1)
                                        HDFC BANK
                                    @elseif($sponsor->bank == 2)
                                        KERALA GRAMIN BANK
                                    @else
                                        NULL
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Receipt NO</th>
                                <td>{{ $sponsor->receipt_no }}</td>
                            </tr>
                            <tr>
                                <th>Added date</th>
                                <td>{{ $sponsor->created_at->format('d F, Y') }}</td>
                            </tr>
                            <tr>
                                <th>Last updated</th>
                                <td>{{ optional($sponsor->updated_at)->diffForHumans() }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <div class="card-header__title">Verification</div>
                </div>
                <div class="card-body">
                    @if ($sponsor->verification)
                        <span class="btn btn-block text-white bg-success">Verified</span>
                    @else
                        <span class="btn btn-block text-white bg-danger">Not verified</span>
                    @endif
                </div>
            </div>

            @include('components.print_letterpad', [
                'url' => route('admin.sponsors.letterpad.print', $sponsor->id),
            ])
        </div>
    </div>
@endsection
