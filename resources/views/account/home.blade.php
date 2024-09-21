@extends('layouts.app')

@section('content')
<div class="container mt-5 w-50">
    <div class="card text-center">
        <div class="card-header">
            <span> Welcome </span> <span><b>{{ $users->name }}</b></span>

        </div>
        <div class="card-body">
            <p class="card-text">Your ID: {{ $users->email }}</p>
            <h4>Your Balance: <span class="text-success">{{ $account->balance ?? 0 }}</span></h4>
        </div>
    </div>
</div>
@endsection
