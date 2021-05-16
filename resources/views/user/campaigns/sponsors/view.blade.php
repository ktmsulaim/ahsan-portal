@extends('layouts.app', ['title' => "View sponsor"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('user.campaigns.index') }}">Campaigns</a></li>
    <li class="breadcrumb-item"><a href="{{ route('user.campaigns.show', $sponsor->campaign->id) }}">{{ $sponsor->campaign->name }}</a></li>
    <li class="breadcrumb-item">Sponsors</li>
    <li class="breadcrumb-item active">{{ $sponsor->name }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-header__title m-0">Sponsor</div>
                    <div class="card-tools">
                        <a class="btn btn-info btn-sm" href="{{ route('user.sponsors.edit', $sponsor->id) }}">
                            <span class="material-icons">create</span> Edit
                        </a>
                    </div>
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
                    <p>Office use only</p>
                    @if ($sponsor->verification)
                        <span class="btn btn-block text-white bg-success">Verified</span>
                    @else
                        <span class="btn btn-block text-white bg-danger">Not verified</span>
                    @endif
                </div>
            </div>

            @if ($sponsor->amount >= 5000)
            <div class="card">
                <div class="card-header">
                    <div class="card-header__title">Letterpad</div>
                </div>
                <div class="card-body">
                    <p>Let the donor know our happiness. Send it today</p>
                    <form target="_blank" action="{{ route('user.sponsors.letterpad.print', $sponsor->id) }}" method="get">
                        <div class="form-group">
                            <select class="form-control" name="lang" id="lang" required>
                                <option value="ml">Malayalam</option>
                                <option value="ar" disabled>Arabic</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" name="name_in_lang" id="name_in_lang" class="form-control" placeholder="Name in selected language">
                        </div>
                        <div class="form-group">
                            <input type="text" name="amount_in_lang" id="amount_in_lang" class="form-control" placeholder="Amount in selected language">
                        </div>

                        <button class="btn btn-success">Print</button>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection