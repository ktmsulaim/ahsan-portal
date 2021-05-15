@extends('layouts.base', ['title' => "Edit sponsor"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.index') }}">Campaigns</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.campaigns.show', $sponsor->campaign->id) }}">{{ $sponsor->campaign->name }}</a></li>
    <li class="breadcrumb-item">Sponsors</li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body card-form__body">
                    <form id="sponsorEditForm" action="{{ route('admin.sponsors.update', $sponsor->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" value="{{ old('name', $sponsor->name) }}" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="place">Place</label>
                                    <input type="text" class="form-control" id="place" value="{{ old('place', $sponsor->place) }}" name="place" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="tel" class="form-control" id="phone" value="{{ old('phone', $sponsor->phone) }}" name="phone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" min="0" class="form-control" id="amount" value="{{ old('amount', $sponsor->amount) }}" name="amount" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="amount_received">Amount received</label>
                                    <select name="amount_received" id="amount_received" class="form-control" required>
                                        <option {{ $sponsor->amount_received == 0 ? 'selected' : '' }} value="0">No</option>
                                        <option {{ $sponsor->amount_received == 1 ? 'selected' : '' }} value="1">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp">Whatsapp</label>
                                    <input type="text" class="form-control" id="whatsapp" value="{{ old('whatsapp', $sponsor->whatsapp) }}" name="whatsapp">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mode">Mode</label>
                                    <select name="mode" id="mode" class="form-control">
                                        <option value="">Select a mode</option>
                                        <option {{ $sponsor->mode == 1 ? 'selected' : '' }} value="1">Cash</option>
                                        <option {{ $sponsor->mode == 2 ? 'selected' : '' }} value="2">Bank transfer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="transaction_id">Transaction ID</label>
                                    <input type="text" placeholder="If available" class="form-control" value="{{ old('transaction_id', $sponsor->transaction_id) }}" id="transaction_id" name="transaction_id">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="bank">Bank</label>
                                    <select name="bank" id="bank" class="form-control">
                                        <option value="">Select a bank</option>
                                        <option {{ $sponsor->bank == 1 ? 'selected' : '' }} value="1">HDFC BANK</option>
                                        <option {{ $sponsor->bank == 2 ? 'selected' : '' }} value="2">KERALA GRAMIN BANK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="receipt_no">Receipt No</label>
                                    <input type="number" min="0" class="form-control" id="receipt_no" value="{{ old('receipt_no', $sponsor->receipt_no) }}" name="receipt_no">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            @include('components.errors')
            <div class="card">
                <div class="card-header">
                    <div class="card-header__title">Office use only</div>
                </div>
                <div class="card-body">
                    <p>Verify all data and mark as verified</p>
                    <div class="form-group">
                        <select form="sponsorEditForm" name="verification" id="verification" class="form-control">
                            <option {{ $sponsor->verification == 0 ? 'selected' : '' }} value="0">Not verified</option>
                            <option {{ $sponsor->verification == 1 ? 'selected' : '' }} value="1">Verified</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="card-header__title text-danger">Delete sponsor</div>
                </div>
                <div class="card-body">
                    @include('components.delete_form', ['type' => 'sponsor', 'deleteUrl' => route('admin.sponsors.destroy', $sponsor->id)])
                </div>
            </div>
        </div>
    </div>
@endsection