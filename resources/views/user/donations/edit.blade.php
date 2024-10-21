@extends('layouts.user')

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

<div class="container p-4">
    <div class="card shadow" style="border-radius: 10px;">
        <div class="card-header text-center" style="background-color: #008080; color: white;">
            <h2 class="mb-0">Edit Donation</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('donations.user.update', $donation->id) }}" method="POST">
                @csrf
                @method('PUT')

                <input type="hidden" name="campaign_id" value="{{ $donation->campaign_id }}"> <!-- Hidden field for campaign ID -->

                <div class="mb-3">
                    <label for="amount" class="form-label">Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control @error('amount') is-invalid @enderror" value="{{ old('amount', $donation->amount) }}" >
                    @error('amount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="donorName" class="form-label">Donor Name</label>
                    <input type="text" class="form-control @error('donorName') is-invalid @enderror" id="donorName" name="donorName" value="{{ old('donorName', $donation->donorName) }}" >
                    @error('donorName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="cause" class="form-label">Cause</label>
                    <input type="text" class="form-control @error('cause') is-invalid @enderror" id="cause" name="cause" value="{{ old('cause', $donation->cause) }}" >
                    @error('cause')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-teal" style="background-color: #008080; border-color: #008080; color: white;">
                    <i class="fas fa-save"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .container {
        max-width: 600px;
        margin-top: 20px;
    }

    .card {
        border-radius: 10px;
    }

    .card-header {
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .btn-teal {
        background-color: #008080;
        border-color: #008080;
        color: white;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        border-radius: 5px;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .text-danger {
        font-size: 0.875rem;
    }
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection
