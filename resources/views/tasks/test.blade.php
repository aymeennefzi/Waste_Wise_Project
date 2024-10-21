@extends('layouts.adminLayout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>

        <h1>testttttttt</h1>
    </body>
    </html>
@endsection








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Events</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f8fa;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #1c1e21;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar h1 {
            font-size: 24px;
            margin: 0;
            font-weight: 500;
        }

        .navbar .create-button {
            background-color: #007bff;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .navbar .create-button:hover {
            background-color: #0056b3;
        }

        .card-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-content {
            padding: 16px;
        }

        .card h2 {
            font-size: 20px;
            margin: 0 0 8px;
            color: #343a40;
        }

        .card p {
            margin: 8px 0;
            color: #6c757d;
        }

        .card p strong {
            color: #343a40;
        }

        .card .description {
            color: #495057;
            margin-top: 16px;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

        .icons {
            display: flex;
            justify-content: space-between;
            padding: 8px 16px;
            border-top: 1px solid #dee2e6;
        }

        .icons button {
            background: none;
            border: none;
            color: #6c757d;
            font-size: 18px;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .icons button:hover {
            color: #dc3545;
        }

        .icons i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <h1>All Events</h1>
        <a href="/events/create" class="create-button">Create Event</a>
    </div>

    <div class="card-container">
        @foreach ($events as $event)
            @php
                $location = explode(', ', $event->location);
                $latitude = $location[0];
                $longitude = $location[1];
                $googleMapsUrl = "https://www.google.com/maps?q={$latitude},{$longitude}";
            @endphp
            <div class="card">
                <!-- Image placeholder -->
                <img src="https://via.placeholder.com/300x180" alt="Event Image">

                <div class="card-content">
                    <h2>{{ $event->eventName }}</h2>
                    <p><strong>Date:</strong> {{ $event->eventDate }}</p>
                    <p><strong>Location:</strong> <a href="{{ $googleMapsUrl }}" target="_blank">{{ $event->location }}</a></p>
                    <p class="description"><strong>Description:</strong> {{ $event->description }}</p>
                    <p><strong>Community:</strong> {{ $event->communityId }}</p>
                </div>

                <div class="icons">
                    <form action="{{ route('events.edit', $event->id) }}" method="GET">
                        <button type="submit"><i class="fas fa-edit"></i></button>
                    </form>

                    <form method="POST" action="/events/{{ $event->id }}/destroy">
                        @csrf
                        @method('delete')
                        <button type="submit"><i class="fa fa-trash"></i></button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>




{{--

<div class="col-xl-9" style=" display: flex; flex-wrap: wrap; gap: 10px;">
    @foreach ($events as $event)
    @php
        $location = explode(', ', $event->location);
        $latitude = $location[0];
        $longitude = $location[1];
        $googleMapsUrl = "https://www.google.com/maps?q={$latitude},{$longitude}";
    @endphp

    <div class="card" style="background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: calc(33.33% - 10px); overflow: hidden; transition: transform 0.3s;">
        <div class="card-header" style="background-color: #121212; color: white; padding: 15px;">
            <h2 style="font-size: 1.5rem; margin: 0; color: #f8f9fa">{{ $event->eventName }}</h2>
        </div>

        <div class="card-content" style="padding: 15px;">
            <p style="margin-bottom: 10px;"><strong>Date:</strong> {{ $event->eventDate }}</p>
            <p style="margin-bottom: 10px;"><strong>Location:</strong> <a href="{{ $googleMapsUrl }}" target="_blank" style=" text-decoration: none;">{{ $event->location }}</a></p>
            <p class="description" style="margin-bottom: 10px;"><strong>Description:</strong> {{ \Illuminate\Support\Str::limit($event->descreption, 100) }}</p>
            <p style="margin-bottom: 10px;"><strong>Community:</strong> {{ $event->communityId }}</p>
        </div>

        <div class="card-footer" style="background-color: #f8f9fa; padding: 10px; text-align: center;">
            <a href="{{ $googleMapsUrl }}" target="_blank" style="background-color: #0c0c0c; color: white; padding: 10px 15px; border-radius: 5px; text-decoration: none; font-size: 0.9rem;">View on Google Maps</a>

            <div style="margin-top: 10px; display: flex; justify-content: center; gap: 10px;">
                <!-- Edit Button -->
                <form action="{{ route('events.edit', $event->id) }}" method="GET">
                    <button type="submit" style="background-color: #007bff; color: white; padding: 10px 15px; border-radius: 5px; border: none; font-size: 0.9rem; cursor: pointer;">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                </form>

                <!-- Delete Button -->
                <form method="POST" action="/events/{{ $event->id }}/destroy">
                    @csrf
                    @method('delete')
                    <button type="submit" style="background-color: #dc3545; color: white; padding: 10px 15px; border-radius: 5px; border: none; font-size: 0.9rem; cursor: pointer;">
                        <i class="fa fa-trash"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>
 --}}
