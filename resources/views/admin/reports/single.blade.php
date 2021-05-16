@extends('layouts.base', ['title' => strtoupper(str_replace('_', ' ', $name)) . " - Reports"])

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.reports.index') }}">Reports</a></li>
    <li class="breadcrumb-item active">{{ str_replace('_', ' ', $name) }}</li>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-header__title">{{ strtoupper(str_replace('_', ' ', $name)) }}</div>
                </div>
                <div class="card-body">
                    @if ($data)     
                    <div class="table-responsive">
                        <table class="table">
                            @if ($name == 'toppers')
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Batch</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $topper)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $topper->name }}</td>
                                            <td>{{ $topper->batch }}</td>
                                            <td>{{ $topper->total_amount }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @elseif($name == 'amount_not_received')
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Place</th>
                                    <th>Phone</th>
                                    <th>Amount</th>
                                    <th>Care of</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $sponsor)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $sponsor->name }}</td>
                                        <td>{{ $sponsor->place }}</td>
                                        <td>{{ $sponsor->phone }}</td>
                                        <td>{{ number_format($sponsor->amount) }}</td>
                                        <td><a href="{{ route('admin.users.show', $sponsor->user->id) }}">{{ $sponsor->user->name }}</a></td>
                                        <td>{{ $sponsor->created_at->format('d F, y') }}</td>
                                        <td><a href="{{ route('admin.sponsors.show', $sponsor->id) }}" class="btn btn-sm btn-info">View</a></td>
                                    </tr>
                                @endforeach
                            </tbody>

                            @elseif ($name == 'members_with_zero')
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Batch</th>
                                        <th>Phone</th>
                                        <th>Phone 2</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->batch }}</td>
                                        <td>{{ $user->phone_personal }}</td>
                                        <td>{{ $user->phone_home }}</td>
                                        <td><a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">View</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            @elseif ($name == 'toppers_each_batch')
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Batch</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $key => $batch)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>Batch {{ $key + 1 }}</td>
                                            <td>{{ $batch ? $batch->name : 'NULL' }}</td>
                                            <td>{{ $batch ? number_format($batch->total_amount) : 0 }}</td>
                                            <td>{!! $batch ? '<a href="'.route('admin.users.show', $batch->id) . '" class="btn btn-sm btn-info">View</a>' : 'NULL' !!}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                        </table>
                    </div>
                    @else
                        <p>No data found!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $('.table').DataTable();
        })
    </script>
@endsection