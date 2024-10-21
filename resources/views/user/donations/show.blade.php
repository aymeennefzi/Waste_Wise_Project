@extends('layouts.user')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="card">
    <div class="card-header">
        <h4>Détails de la Donation</h4>
    </div>
    <div class="card-body">
        <h5>Nom du Donateur: {{ $donation->donorName }}</h5>
        <p>Montant: {{ $donation->amount }}</p>
        <p>Cause: {{ $donation->cause }}</p>
        <p>Status: {{ \App\Enums\DonationStatus::from($donation->status)->label() }}</p> <!-- Display the status -->
        <a href="{{ route('donations.index') }}" class="btn btn-primary">Retour à la liste</a>
    </div>
</div>
@endsection
