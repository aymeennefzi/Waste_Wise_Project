@extends('layouts.adminLayout')

@section('content')
<div class="card-header">
    <h4 class="mb-0">Edit the Donation</h4>
</div>
<div class="card-body">
    <form action="{{ route('donations.update', $donation->id) }}" method="POST">
        @csrf
        @method('PUT') 
        <input type="hidden" name="id" value="{{ $donation->id }}">
        
       
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" value="{{ $donation->amount }}" placeholder="Enter the amount" required>
        </div>
        <div class="form-group">
            <label for="donorName">Donor Name</label>
            <input type="text" class="form-control" id="donorName" name="donorName" value="{{ $donation->donorName }}" placeholder="Enter the donor name" required>
        </div>
        <div class="form-group">
            <label for="cause">Cause</label>
            <input type="text" class="form-control" id="cause" name="cause" value="{{ $donation->cause }}" placeholder="Enter the cause" required>
        </div>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
@endsection
