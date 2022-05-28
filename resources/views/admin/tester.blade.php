@extends('layouts.app')
@section('content')
<html>
    <table>
        <thead>
            <tr>
            <th>Name</th>
            <th>Credit</th>
            <th>Invoice</th>
            <th>Difference</th>
        </tr>
        </thead>
        <tbody>
            @foreach($testers as $test)
                @if($test->total_credit != -$test->total_invoices)

            <tr>
                <td>{{ $test->customer_name }}</td>
                <td>{{ $test->total_credit }}</td>
                <td>{{ $test->total_invoices }}</td>
                <td>{{ $test->total_credit +$test->total_invoices }}</td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</html>
@endsection
