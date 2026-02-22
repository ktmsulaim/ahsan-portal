@extends('layouts.base', ['title' => 'WhatsApp Reports'])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Reports</a></li>
    <li class="breadcrumb-item active">WhatsApp Reports</li>
@endsection

@section('content')
    @if ($camp)
        <p class="text-muted mb-3">Generate copy-paste ready reports for sharing on WhatsApp. Select a report, then copy to clipboard.</p>
        <div class="row card-group-row">
            <div class="col-md-6 col-lg-3 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-header">
                        <div class="card-header__title">Batch wise total</div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Total amount sponsored and received, batch wise with member breakdown.</p>
                        <a href="{{ route('admin.reports.whatsapp.show', ['type' => 'batchWise']) }}" class="btn btn-success">
                            Generate &amp; copy
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-header">
                        <div class="card-header__title">Batch wise not received</div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Amount not yet received, batch wise.</p>
                        <a href="{{ route('admin.reports.whatsapp.show', ['type' => 'batchWiseNotReceived']) }}" class="btn btn-success">
                            Generate &amp; copy
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-header">
                        <div class="card-header__title">Toppers</div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Top performers. Choose count then generate.</p>
                        <form action="{{ route('admin.reports.whatsapp.show') }}" method="get" class="form-inline">
                            <input type="hidden" name="type" value="toppers">
                            <select name="limit" class="form-control form-control-sm mr-3">
                                <option value="5">Top 5</option>
                                <option value="10" selected>Top 10</option>
                                <option value="15">Top 15</option>
                                <option value="25">Top 25</option>
                            </select>
                            <button type="submit" class="btn btn-success btn-sm mt-2 mt-md-0 pt-2 pb-2">Generate &amp; copy</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 card-group-row__col">
                <div class="card card-group-row__card">
                    <div class="card-header">
                        <div class="card-header__title">Target</div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small">Campaign target, sponsored and received totals with locations.</p>
                        <a href="{{ route('admin.reports.whatsapp.show', ['type' => 'target']) }}" class="btn btn-success">
                            Generate &amp; copy
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-warning">No active campaign found.</div>
    @endif
@endsection
