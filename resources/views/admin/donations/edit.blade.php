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
            <input type="number" class="form-control" id="amount" name="amount" value="{{ $donation->amount }}" required>
        </div>
        
        <div class="form-group">
            <label for="donorName">Donor Name</label>
            <input type="text" class="form-control" id="donorName" name="donorName" value="{{ $donation->donorName }}" required>
        </div>
        
        <div class="form-group">
            <label for="cause">Cause</label>
            <input type="text" class="form-control" id="cause" name="cause" value="{{ $donation->cause }}" required>
        </div>

        <div class="form-group">
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status" required>
        <option value="{{ \App\Enums\DonationStatus::PENDING }}" {{ $donation->status === \App\Enums\DonationStatus::PENDING ? 'selected' : '' }}>
            {{ \App\Enums\DonationStatus::PENDING->label() }}
        </option>
        <option value="{{ \App\Enums\DonationStatus::CONFIRMED }}" {{ $donation->status === \App\Enums\DonationStatus::CONFIRMED ? 'selected' : '' }}>
            {{ \App\Enums\DonationStatus::CONFIRMED->label() }}
        </option>
        <option value="{{ \App\Enums\DonationStatus::FAILED }}" {{ $donation->status === \App\Enums\DonationStatus::FAILED ? 'selected' : '' }}>
            {{ \App\Enums\DonationStatus::FAILED->label() }}
        </option>
    </select>
</div>


        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
