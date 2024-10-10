@extends('layouts.adminLayout')

@section('content')
<div class="col-xl-9" style="padding: 20px;">
    <!-- Add a Create New Event Button -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <!-- Left: All Events Text -->
        <h2 style="margin: 0;">All Events</h2>

        <!-- Right: Create New Event Button -->
        <a href="{{ route('events.create') }}" style="background-color: #007bff; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-size: 1rem; margin-right: 0px">
            <i class="fas fa-plus"></i> Create New Event
        </a>
    </div>

    <!-- Compact Events Table -->
    <table class="table table-sm table-striped table-bordered" style="width: 100%; background-color: #fff;">
        <thead style="background-color: #121111;">
            <tr>
                <th>Event</th>
                <th>Date</th>
                <th>Descreption</th>
                <th>Location</th>
                <th style="text-align: center;">Actions</th>
            </tr>
        </thead>
        <tbody style="color: #121111">
            @foreach ($events as $event)
            @php
                $location = explode(', ', $event->location);
                $latitude = $location[0];
                $longitude = $location[1];
                $googleMapsUrl = "https://www.google.com/maps?q={$latitude},{$longitude}";
            @endphp
            <tr>
                <td>{{ $event->eventName }}</td>
                <td>{{ $event->eventDate }}</td>
                <td>{{ $event->descreption }}</td>
                <td><a href="{{ $googleMapsUrl }}" target="_blank" style="color: #007bff;">Map</a></td>
                <td style="text-align: center;">
                    {{-- <a href="{{ $googleMapsUrl }}" target="_blank" style="color: #007bff; margin-right: 10px;">View</a> --}}

                    <form action="{{ route('events.edit', $event->id) }}" method="GET" style="display: inline;">
                        <button type="submit" style="background-color: #28a745; color: white; padding: 5px; border-radius: 5px; border: none; font-size: 0.8rem; cursor: pointer;">
                            Edit
                        </button>
                    </form>

                    <form method="POST" action="/events/{{ $event->id }}/destroy" style="display: inline;">
                        @csrf
                        @method('delete')
                        <button type="submit" style="background-color: #dc3545; color: white; padding: 5px; border-radius: 5px; border: none; font-size: 0.8rem; cursor: pointer;">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
