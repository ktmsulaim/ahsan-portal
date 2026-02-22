<div class="card card-group-row__card dashboard-table-card">
    <div class="card-header dashboard-table-card__header">
        <div class="card-header__title">Batches</div>
    </div>
    <div class="card-body table-responsive p-0">
        @php
            $batchWise = \App\Models\Sponsor::batchWiseAmount($campaign->id);
        @endphp
        @if ($batchWise)
        <table class="table table-bordered dashboard-table">
            <thead>
                <tr>
                    <th>Batch</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($batchWise as $batch)
                    <tr>
                        <td class="font-weight-medium">{{ $batch['batch'] }}</td>
                        <td class="text-right dashboard-table__amount">₹{{ number_format($batch['amount']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-muted text-center py-4 mb-0">No data</p>
        @endif
    </div>
</div>