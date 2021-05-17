<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Place</th>
            <th>Phone</th>
            <th>Amount</th>
            <th>Amount received</th>
            <th>Whatsapp</th>
            <th>Mode</th>
            <th>Transaction ID</th>
            <th>Bank</th>
            <th>Receipt No</th>
            <th>Verification</th>
            @if ($mode == 'all')
                <th>Care of</th>
            @endif
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @if ($sponsors)
            @foreach ($sponsors as $key => $sponsor)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $sponsor->name }}</td>
                    <td>{{ $sponsor->place }}</td>
                    <td>{{ $sponsor->phone }}</td>
                    <td>{{ number_format($sponsor->amount) }}</td>
                    <td>{{ $sponsor->amount_received == 1 ? 'Yes' : 'No' }}</td>
                    <td>{{ $sponsor->whatsapp }}</td>
                    <td>{{ $sponsor->mode == 1 ? 'Cash' : 'Bank transfer' }}</td>
                    <td>{{ $sponsor->transaction_id }}</td>
                    <td>
                        @if ($sponsor->bank == 1)
                            HDFC BANK
                        @elseif($sponsor->bank == 2)
                            KERALA GRAMIN BANK
                        @else
                            NULL
                        @endif
                    </td>
                    <td>{{ $sponsor->receipt_no }}</td>
                    <td>{{ $sponsor->verification ? 'Verified' : 'Not verified' }}</td>
                    @if ($mode == 'all')
                        <td>{{ $sponsor->user->name }} - {{ $sponsor->user->batch }}</td>
                    @endif
                    <td>{{ optional($sponsor->created_at)->format('d F, Y') }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">No sponsors found!</td>
            </tr>
        @endif
    </tbody>
</table>
