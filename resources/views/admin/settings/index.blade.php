@extends('layouts.base', ['title' => "Settings"])

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-header__title">Settings</div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="post">
                @csrf

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dhic_batch">DHIC Batch</label>
                            <input type="number" class="form-control" name="dhic_batch" id="dhic_batch"
                                value="{{ setting('dhic_batch') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dhiu_batch">DHIU Batch</label>
                            <input type="number" class="form-control" name="dhiu_batch" id="dhiu_batch"
                                value="{{ setting('dhiu_batch') }}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-info"><span class="ml-2">Save</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
