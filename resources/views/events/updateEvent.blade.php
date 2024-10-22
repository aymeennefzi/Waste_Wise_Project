@extends('layouts.adminLayout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Form to update an Event -->
            <div class="col-md-6">
                <h5 class="card-title">Update Event</h5>
                <form action="{{ route('events.update', $event->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="eventName" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="eventName" name="eventName" value="{{ old('eventName', $event->eventName) }}">
                        @error('eventName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="eventDate" name="eventDate" value="{{ old('eventDate', $event->eventDate) }}">
                        @error('eventDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descreption" class="form-label">Description</label>
                        <textarea class="form-control" id="descreption" name="descreption" rows="3">{{ old('descreption', $event->descreption) }}</textarea>
                        @error('descreption')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $event->location) }}" readonly>
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Update Event</button>
                    </div>
                </form>
            </div>

            <!-- Map and Image Column -->
            <div class="col-md-6">
                <!-- Map Container -->
                <div class="mb-4">
                    <label class="form-label">Choose Location on Map</label>
                    <div id="map" style="height: 300px; width: 100%; border-radius: 8px;"></div>
                </div>


            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<style>
    .card {
        margin-top: 30px;
    }
    .form-label {
        font-weight: bold;
    }
    .btn-primary {
        background-color: #4CAF50;
        border-color: #4CAF50;
    }
    .btn-primary:hover {
        background-color: #45a049;
        border-color: #45a049;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let map;
    let marker;
    let locationInput = document.getElementById('location');

    function initMap() {
        // Initialize map
        map = L.map('map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add click event listener
        map.on('click', function(e) {
            placeMarker(e.latlng);
            updateLocationInput(e.latlng);
        });

        // Set initial marker if location exists
        let initialLocation = locationInput.value.split(',');
        if (initialLocation.length === 2) {
            let lat = parseFloat(initialLocation[0]);
            let lng = parseFloat(initialLocation[1]);
            if (!isNaN(lat) && !isNaN(lng)) {
                let initialLatLng = L.latLng(lat, lng);
                placeMarker(initialLatLng);
                map.setView(initialLatLng, 13);
            }
        }
    }

    function placeMarker(latLng) {
        if (marker) {
            marker.setLatLng(latLng);
        } else {
            marker = L.marker(latLng).addTo(map);
        }
    }

    function updateLocationInput(latLng) {
        locationInput.value = latLng.lat.toFixed(6) + ', ' + latLng.lng.toFixed(6);
    }

    // Initialize the map
    initMap();
});
</script>
@endsection