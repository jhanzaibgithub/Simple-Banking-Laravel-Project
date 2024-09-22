{{-- resources/views/account/deposit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mt-5 w-50">
    <div class="card">
        <div class="card-header">
            Deposit Money
        </div>
        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

    <form action="{{ route('deposit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="amount" class="form-label"><b>Amount</b></label>
            <input type="number" class="form-control" id="amount" name="amount" required>
        </div>
        <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Deposit</button>
        </div>
    </form>
        </div>
        </div>
</div>
@endsection
