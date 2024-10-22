@extends('layouts.adminLayout')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title mb-4">Update Recycling Center</h2>
        <div class="row">
            <!-- Form Fields Column -->
            <div class="col-md-6">
                <form action="{{ route('recycling_centers.update', $center->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Recycling Center Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $center->name) }}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $center->address) }}">
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="opening_hours" class="form-label">Opening Hours</label>
                        <input type="text" class="form-control" id="opening_hours" name="opening_hours" value="{{ old('opening_hours', $center->opening_hours) }}">
                        @error('opening_hours')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Contact Info</label>
                        <input type="text" class="form-control" id="contact_info" name="contact_info" value="{{ old('contact_info', $center->contact_info) }}">
                        @error('contact_info')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="website_url" class="form-label">Website URL</label>
                        <input type="url" class="form-control" id="website_url" name="website_url" value="{{ old('website_url', $center->website_url) }}">
                        @error('website_url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $center->latitude) }}" readonly>
                        @error('latitude')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $center->longitude) }}" readonly>
                        @error('longitude')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Google Maps Link</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $center->location) }}" readonly>
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Update Center</button>
                    </div>
                </form>
            </div>

            <!-- Map Column -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Update Location on Map</h5>
                    </div>
                    <div class="card-body">
                        <div id="map" style="height: 600px; width: 100%; border-radius: 4px;"></div>
                    </div>
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
            // Initialize with the center's current coordinates
            const lat = {{ $center->latitude ?? 0 }};
            const lng = {{ $center->longitude ?? 0 }};

            // Create the map centered on the current location
            map = L.map('map').setView([lat, lng], 13);

            // Add the tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add initial marker at the center's current location
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);

            // Update fields when marker is dragged
            marker.on('dragend', function(event) {
                const latLng = marker.getLatLng();
                updateLocationFields(latLng);
            });

            // Add click event handler for the map
            map.on('click', function(e) {
                placeMarker(e.latlng);
                updateLocationFields(e.latlng);
            });
        }

        function placeMarker(latLng) {
            if (marker) {
                marker.setLatLng(latLng);
            } else {
                marker = L.marker(latLng, { draggable: true }).addTo(map);
                marker.on('dragend', function(event) {
                    const latLng = marker.getLatLng();
                    updateLocationFields(latLng);
                });
            }
        }

        function updateLocationFields(latLng) {
            const lat = latLng.lat.toFixed(6);
            const lng = latLng.lng.toFixed(6);

            // Update form fields
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Generate and set Google Maps link
            const googleMapsLink = `https://www.google.com/maps?q=${lat},${lng}`;
            document.getElementById('location').value = googleMapsLink;

            // Reverse geocoding to get address
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    if (data.display_name) {
                        document.getElementById('address').value = data.display_name;
                    }
                })
                .catch(error => console.error('Error fetching address:', error));
        }

        // Initialize map on page load
        initMap();

        // Handle window resize
        window.addEventListener('resize', function() {
            if (map) {
                setTimeout(function() {
                    map.invalidateSize();
                }, 500);
            }
        });
    });
</script>
@endsection
