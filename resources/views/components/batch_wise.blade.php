<div class="card card-group-row__card">
    <div class="card-header">
        <div class="card-header__title">Batches</div>
    </div>
    <div class="card-body table-responsive">
        @php
            $batchWise = \App\Models\Sponsor::batchWiseAmount($campaign->id);
        @endphp
        @if ($batchWise)
        <table class="table table-bordered">
            <tbody>
                @foreach ($batchWise as $batch)    
                    <tr>
                        <th width="130">{{ $batch['batch'] }}</th>
                        <td>₹{{ number_format($batch['amount']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No data!</p>
        @endif
        
    </div>
</div>