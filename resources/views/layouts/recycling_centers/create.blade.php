@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-12">
    <h1 class="text-2xl font-bold mb-6">Créer un centre de recyclage</h1>

    <form action="{{ route('recycling_centers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nom du centre</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                <input type="text" name="address" id="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="latitude" class="block text-sm font-medium text-gray-700">Latitude</label>
                <input type="text" name="latitude" id="latitude" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="longitude" class="block text-sm font-medium text-gray-700">Longitude</label>
                <input type="text" name="longitude" id="longitude" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="opening_hours" class="block text-sm font-medium text-gray-700">Heures d'ouverture</label>
                <input type="text" name="opening_hours" id="opening_hours" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div>
                <label for="contact_info" class="block text-sm font-medium text-gray-700">Informations de contact</label>
                <input type="text" name="contact_info" id="contact_info" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="website_url" class="block text-sm font-medium text-gray-700">URL du site web</label>
                <input type="url" name="website_url" id="website_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700">Lien Google Maps</label>
                <input type="text" name="location" id="location" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            </div>

            <div class="col-span-2">
                <label for="image" class="block text-sm font-medium text-gray-700">Photo du centre</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full text-gray-700" required>
            </div>

            <div class="col-span-2">
                <label class="block text-sm font-medium text-gray-700">Sélectionner l'emplacement sur la carte</label>
                <!-- Div pour la carte Leaflet -->
                <div id="map" style="height: 400px; width: 100%;" class="mt-2 rounded-md shadow-sm"></div>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                Enregistrer le centre
            </button>
        </div>
    </form>
</div>

@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var map = L.map('map').setView([36.8065, 10.1815], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([36.8065, 10.1815], { draggable: true }).addTo(map);

        marker.on('dragend', function () {
            var lat = marker.getLatLng().lat;
            var lng = marker.getLatLng().lng;

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;
            document.getElementById('location').value = `https://www.google.com/maps?q=${lat},${lng}`;
        });

        document.getElementById('latitude').addEventListener('change', function () {
            var lat = parseFloat(this.value);
            var lng = parseFloat(document.getElementById('longitude').value);
            if (!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 13);
            }
        });

        document.getElementById('longitude').addEventListener('change', function () {
            var lat = parseFloat(document.getElementById('latitude').value);
            var lng = parseFloat(this.value);
            if (!isNaN(lat) && !isNaN(lng)) {
                marker.setLatLng([lat, lng]);
                map.setView([lat, lng], 13);
            }
        });

        setTimeout(function () {
            map.invalidateSize();
        }, 500);
    });
</script>
@endsection