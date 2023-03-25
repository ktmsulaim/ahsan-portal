@extends('layouts.app', ['title' => 'Choose location'])

@section('content')
    <div class="row">
        <div class="col-md-6 m-auto">
            <div class="card">
                <div class="card-body">
                    @if ($campaign->locations)    
                        <h4>Choose a location</h4>
                        <p>{{ $campaign->name }} is grouped by locations. Please choose a location to proceed.</p>

                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <select class="form-control" name="location" id="location" required>
                                    @foreach ($campaign->locations as $key => $value)
                                        <option value="{{ $key }}">{{ $key }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary">Save</button>
                        </form>
                    @else
                        <p>Oops! something went wrong. Please contact the web admin.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection