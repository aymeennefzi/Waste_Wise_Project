@extends('layouts.adminLayout')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card-header">
    <h4 class="mb-0">Edit the Donation</h4>
</div>
<div class="card-body">
    <form action="{{ route('donations.admin.update', $donation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount', $donation->amount) }}" >
            @error('amount')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="donorName">Donor Name</label>
            <input type="text" class="form-control @error('donorName') is-invalid @enderror" id="donorName" name="donorName" value="{{ old('donorName', $donation->donorName) }}" >
            @error('donorName')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="cause">Cause</label>
            <input type="text" class="form-control @error('cause') is-invalid @enderror" id="cause" name="cause" value="{{ old('cause', $donation->cause) }}" >
            @error('cause')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" >
                <option value="{{ \App\Enums\DonationStatus::PENDING }}" {{ old('status', $donation->status) === \App\Enums\DonationStatus::PENDING ? 'selected' : '' }}>
                    {{ \App\Enums\DonationStatus::PENDING->label() }}
                </option>
                <option value="{{ \App\Enums\DonationStatus::CONFIRMED }}" {{ old('status', $donation->status) === \App\Enums\DonationStatus::CONFIRMED ? 'selected' : '' }}>
                    {{ \App\Enums\DonationStatus::CONFIRMED->label() }}
                </option>
                <option value="{{ \App\Enums\DonationStatus::FAILED }}" {{ old('status', $donation->status) === \App\Enums\DonationStatus::FAILED ? 'selected' : '' }}>
                    {{ \App\Enums\DonationStatus::FAILED->label() }}
                </option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
