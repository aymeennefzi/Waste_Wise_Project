@extends('layouts.user')

@section('content')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div class="container">
    <h4 class="mb-4">My Donations</h4>



                        <table  class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Donor Name</th>
                                    <th scope="col">Cause</th>
                                    <th scope="col">Campaign</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($donations as $donation)
                                    <tr>
                                        <td>{{ $donation->amount }}</td>
                                        <td>{{ $donation->donorName }}</td>
                                        <td>{{ $donation->cause }}</td>
                                        <td>{{ $donation->campaign->name }}</td>
                                        <td> {{ $donation->status }}</td>
                                        <td>
                                            @if ($donation->status === \App\Enums\DonationStatus::CONFIRMED ||
                                             $donation->status === \App\Enums\DonationStatus::CANCELLED ||
                                                  $donation->status === \App\Enums\DonationStatus::FAILED)
                                                <button class="btn btn-warning" disabled>Edit</button>
                                            @else
                                                <a href="{{ route('donations.user.edit', $donation->id) }}" class="btn btn-warning">Edit</a>
                                            @endif
                                            @if ($donation->status !== \App\Enums\DonationStatus::CONFIRMED && $donation->status !== \App\Enums\DonationStatus::CANCELLED)
                                                <form action="{{ route('donations.user.cancel', $donation->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this donation?');">
                                                        Cancel
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


@endsection
