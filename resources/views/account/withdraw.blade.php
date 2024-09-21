@extends('layouts.app')

@section('content')
<div class="container mt-5 w-50">
    <div class="card">
        <div class="card-header">
            Withdraw Money
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

            <form action="{{ route('withdraw') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="amount" class="form-label"> <b>Amount</b></label>
                    <input type="number" step="0.01" class="form-control" name="amount" id="amount" required>
                </div>
                <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Withdraw</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
