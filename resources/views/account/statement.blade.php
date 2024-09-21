@extends('layouts.app')

@section('content')





<div class="container my-4 w-50">
    <h3>Statement of account</h3>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>DateTime</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Details</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $loop->iteration }}</td>
                  <td>{{ $transaction->created_at }}</td>
                  <td>{{ $transaction->amount }}</td>

                <td>{{ $transaction->type }}</td>
                <td>
                    @if($transaction->type == 'transfer')
                        Transfer to <br> {{ $transaction->receiver_email }}
                        @else
                        {{ $transaction->type }} <!-- Show the type for non-transfer transactions -->
                        @endif
                    </td>
                <td>{{ $transaction->after_balance }}</td>


                </tr>
                @endforeach
            </tbody>
        </table>


</div>


@endsection
