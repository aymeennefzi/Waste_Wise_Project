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
            <h2 class="mb-0">Add a Donation</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('donations.user.store') }}" method="POST" >
                @csrf
                <input type="hidden" name="campaign_id" value="{{ request()->get('campaign_id') }}"> 

                <div class="mb-3">
                    <label for="amount" class="form-label"> Amount</label>
                    <input type="number" name="amount" id="amount" class="form-control" placeholder="Enter the amount" required>
                </div>

                <div class="mb-3">
                    <label for="donorName" class="form-label"> Donor Name</label>
                    <input type="text" class="form-control" id="donorName" name="donorName" placeholder="Enter the donor name" required>
                    </div>

                <div class="mb-3">
                    <label for="cause" class="form-label"> Cause</label>
                    <input type="text" class="form-control" id="cause" name="cause" placeholder="Enter the cause" required>
                    </div>

                <button type="submit" class="btn btn-teal" style="background-color: #008080; border-color: #008080; color: white;">
                    <i class="fas fa-plus"></i> Add donation
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
</style>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
@endsection