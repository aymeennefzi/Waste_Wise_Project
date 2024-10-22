@extends('layouts.adminLayout')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title mb-4">Create Recycling Center</h2>
        <div class="row">
            <!-- Form Fields Column -->
            <div class="col-md-6">
                <form action="{{ route('recycling_centers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Recycling Center Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude') }}" readonly required>
                        @error('latitude')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude') }}" readonly required>
                        @error('longitude')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Google Maps Link</label>
                        <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" readonly>
                        @error('location')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="opening_hours" class="form-label">Opening Hours</label>
                        <input type="text" class="form-control" id="opening_hours" name="opening_hours" value="{{ old('opening_hours') }}" required>
                        @error('opening_hours')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contact_info" class="form-label">Contact Info</label>
                        <input type="text" class="form-control" id="contact_info" name="contact_info" value="{{ old('contact_info') }}">
                        @error('contact_info')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="website_url" class="form-label">Website URL</label>
                        <input type="url" class="form-control" id="website_url" name="website_url" value="{{ old('website_url') }}">
                        @error('website_url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image" required>
                        @error('image')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                            Enregistrer le centre
                        </button>
                    </div>
                </form>
            </div>

            <!-- Map Column -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Choose Location on Map</h5>
                    </div>
                    <div class="card-body">
                        <div id="map" style="height: 600px; border-radius: 4px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([36.8065, 10.1815], 13);

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Add a draggable marker
        var marker = L.marker([36.8065, 10.1815], { draggable: true }).addTo(map);

        // Update latitude, longitude, and Google Maps link on drag end
        marker.on('dragend', function () {
            var lat = marker.getLatLng().lat.toFixed(6);
            var lng = marker.getLatLng().lng.toFixed(6);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            document.getElementById('location').value = `https://www.google.com/maps?q=${lat},${lng}`;
        });
    });
</script>
@endsection
