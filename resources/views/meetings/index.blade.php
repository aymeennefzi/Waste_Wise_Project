@extends('HomePage.home')

@section('content')

<div class="container my-5">
    <h1 class="h3 mb-4">Your Meetings</h1>

    @if($meetings->isEmpty())
        <p>You have no scheduled meetings.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Owner</th>
                    <th>Buyer</th>
                    <th>Meeting Time</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($meetings as $meeting)
                    <tr>
                        <td>{{ $meeting->owner_id }}</td>
                        <td>{{ $meeting->buyer_id }}</td>
                        <td>{{ \Carbon\Carbon::parse($meeting->meeting_time)->format('Y-m-d H:i') }}</td>
                        <td>
                            @if($meeting->status == 1)
                                Waiting for answer
                            @elseif($meeting->status == 2)
                                Accepted
                            @elseif($meeting->status == 3)
                                Refused
                            @endif
                        </td>
                                            </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection