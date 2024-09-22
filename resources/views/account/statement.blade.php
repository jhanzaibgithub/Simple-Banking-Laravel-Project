@extends('layouts.app')

@section('content')

<div class="container my-4 w-50">
    <h3>Statement of Account</h3>
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
            <tr  style="background-color: white;">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>{{ $transaction->amount }}</td>

            
                <td>
                    @if($transaction->receiver_email == Auth::user()->email)
                        Received
                    @else
                        {{ $transaction->type }}
                    @endif
                </td>


                <td>
                    @if($transaction->receiver_email == Auth::user()->email)
                        Received from <br> {{ $transaction->sender ? $transaction->sender->email : 'Unknown sender' }}
                    @elseif($transaction->type == 'transfer')
                        Transfer to <br> {{ $transaction->receiver_email }}
                    @else
                        {{ $transaction->type }}
                    @endif
                </td>

                <td>{{ $transaction->after_balance }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
