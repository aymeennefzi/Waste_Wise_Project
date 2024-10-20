@extends('layouts.adminLayout')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title mb-4">Create Recycling Center</h2>
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
</div>

<!-- Map Modal -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mapModalLabel">Choose Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 400px;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmLocation">Confirm Location</button>
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
        let modal = new bootstrap.Modal(document.getElementById('mapModal'));
        let openMapBtn = document.getElementById('openMapBtn');
        let confirmBtn = document.getElementById('confirmLocation');

        function initMap() {
            map = L.map('map').setView([0, 0], 2);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

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
        }

        openMapBtn.addEventListener('click', function() {
            modal.show();
            if (!map) {
                initMap();
            } else {
                map.invalidateSize();
            }
        });

        confirmBtn.addEventListener('click', function() {
            if (marker) {
                let latLng = marker.getLatLng();
                document.getElementById('latitude').value = latLng.lat.toFixed(6);
                document.getElementById('longitude').value = latLng.lng.toFixed(6);
                document.getElementById('location').value = latLng.lat.toFixed(6) + ', ' + latLng.lng.toFixed(6);
            }
            modal.hide();
        });

        document.getElementById('mapModal').addEventListener('shown.bs.modal', function () {
            map.invalidateSize();
        });
    });
</script>
@endsection
