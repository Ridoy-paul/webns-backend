<table class="table table-sm table-bordered mt-3">
    <thead>
        <tr>
            <th>Date</th>
            <th>Visitors</th>
        </tr>
    </thead>
    <tbody>
        @foreach($visitors as $visitor)
            <tr>
                <td>
                    {{ \Carbon\Carbon::parse($visitor->visit_date)->format('l, d-m-Y') }}
                </td>
                <td>{{ $visitor->visitor_qty }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
