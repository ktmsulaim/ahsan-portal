@extends('layouts.base', ['title' => "Reports"])

@section('breadcrumb')
    <li class="breadcrumb-item active"><a href="{{ route('admin.reports.index') }}">Reports</a></li>
@endsection


@section('content')

    @if ($camp)
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <div class="card-header__title">WhatsApp reports</div>
            </div>
            <div class="card-body">
                <p class="mb-2">Generate copy-paste ready reports for WhatsApp (batch wise, toppers, target).</p>
                <a href="{{ route('admin.reports.whatsapp') }}" class="btn btn-success">Open WhatsApp reports</a>
            </div>
        </div>
        <div class="row card-group-row">
            <div class="col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-header">
                        <div class="card-header__title">Toppers</div>
                    </div>
                    <div class="card-body">
                        <p>Get topper of {{ $camp->name }}</p>

                        <form action="{{ route('admin.reports.show') }}" method="get">
                            <input type="hidden" name="name" value="toppers">
                           <div class="form-group">
                            <select name="count" id="count" class="form-control" required>
                                <option value="1">1</option>
                                <option value="3">3</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="25">25</option>
                            </select>
                           </div>

                            <div class="form-group">
                                <button class="btn btn-info">Get</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-header">
                        <div class="card-header__title">Amount not received</div>
                    </div>
                    <div class="card-body">
                        <p>Get list of sponsors not received the amount in {{ $camp->name }}</p>

                        <form action="{{ route('admin.reports.show') }}" method="get">
                            <input type="hidden" name="name" value="amount_not_received">
                            <div class="form-group">
                                <button class="btn btn-info">Get</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
           
            <div class="col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-header">
                        <div class="card-header__title">Members with 0</div>
                    </div>
                    <div class="card-body">
                        <p>Get list of members not actively included in {{ $camp->name }}</p>

                        <form action="{{ route('admin.reports.show') }}" method="get">
                            <input type="hidden" name="name" value="members_with_zero">
                            <div class="form-group">
                                <button class="btn btn-info">Get</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-header">
                        <div class="card-header__title">Top of the batch</div>
                    </div>
                    <div class="card-body">
                        <p>Get topper of each batches in {{ $camp->name }}</p>

                        <form action="{{ route('admin.reports.show') }}" method="get">
                            <input type="hidden" name="name" value="toppers_each_batch">
                            <div class="form-group">
                                <button class="btn btn-info">Get</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="col-md-12">
            <p>No active campaign found!</p>
        </div>
    @endif


@endsection