@extends('layouts.user')

@section('content')
<div class="event-grid">
    @foreach ($events as $event)
    @php
        $location = explode(', ', $event->location);
        $latitude = $location[0];
        $longitude = $location[1];
        $googleMapsUrl = "https://www.google.com/maps?q={$latitude},{$longitude}";
    @endphp

    <div class="event-card">
        <div class="card-header">
            <h2>{{ $event->eventName }}</h2>
        </div>

        <div class="card-content">
            <p><strong>Date:</strong> {{ $event->eventDate }}</p>
            <p><strong>Location:</strong> <a href="{{ $googleMapsUrl }}" target="_blank">{{ $event->location }}</a></p>
            <p class="description"><strong>Description:</strong> {{ \Illuminate\Support\Str::limit($event->descreption, 100) }}</p>
        </div>

        <div class="card-footer">
            <a href="{{ $googleMapsUrl }}" target="_blank" class="map-button">View on Google Maps</a>
        </div>
    </div>
    @endforeach
</div>

<style>
    .event-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .event-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        transition: transform 0.3s;
        display: flex;
        flex-direction: column;
    }

    .event-card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        background-color: #121212;
        color: white;
        padding: 15px;
    }

    .card-header h2 {
        font-size: 1.2rem;
        margin: 0;
        color: #f8f9fa;
    }

    .card-content {
        padding: 15px;
        flex-grow: 1;
    }

    .card-content p {
        margin-bottom: 10px;
    }

    .description {
        flex-grow: 1;
    }

    .card-footer {
        background-color: #f8f9fa;
        padding: 10px;
        text-align: center;
    }

    .map-button {
        background-color: #0c0c0c;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        text-decoration: none;
        font-size: 0.9rem;
        display: inline-block;
    }

    @media (max-width: 1200px) {
        .event-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .event-grid {
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        }
    }
</style>
@endsection
