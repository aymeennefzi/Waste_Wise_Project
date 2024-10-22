@extends('layouts.adminLayout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Form to add an Event -->
            <div class="col-md-6">
                <form action="{{ route('events.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="eventName" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="eventName" name="eventName" value="{{ old('eventName') }}">
                        @error('eventName')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="eventDate" name="eventDate" value="{{ old('eventDate') }}">
                        @error('eventDate')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="descreption" class="form-label">Description</label>
                        <textarea class="form-control" id="descreption" name="descreption">{{ old('descreption') }}</textarea>
                        @error('descreption')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required readonly>
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Create Event</button>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let map;
        let marker;

        function initMap() {
            // Initialize the map with a default view
            map = L.map('map').setView([0, 0], 2);

            // Add the tile layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add click event listener to the map
            map.on('click', function(e) {
                placeMarker(e.latlng);
            });
        }

        function placeMarker(latLng) {
            if (marker) {
                marker.setLatLng(latLng);
            } else {
                marker = L.marker(latLng).addTo(map);
            }
            // Update the location input field
            document.getElementById('location').value = latLng.lat.toFixed(6) + ', ' + latLng.lng.toFixed(6);
        }

        // Initialize the map
        initMap();
    });
</script>
@endsection