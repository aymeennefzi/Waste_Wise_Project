@extends('layouts.adminLayout')

@section('content')
<div class="card-header">
    <h4 class="mb-0">Add a Donation</h4>
</div>
<div class="card-body">
    <form action="{{ route('donations.store') }}" method="POST">
        @csrf
       
        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter the amount" required>
        </div>
        <div class="form-group">
            <label for="donorName">Donor Name</label>
            <input type="text" class="form-control" id="donorName" name="donorName" placeholder="Enter the donor name" required>
        </div>
        <div class="form-group">
            <label for="cause">Cause</label>
            <input type="text" class="form-control" id="cause" name="cause" placeholder="Enter the cause" required>
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
@endsection
