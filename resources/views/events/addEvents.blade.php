@extends('layouts.adminLayout')

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <!-- Form to add an Event -->
            <div class="col-md-6">
                <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="eventName" class="form-label">Event Name</label>
                        <input type="text" class="form-control" id="eventName" name="eventName" required>
                    </div>
                    <div class="mb-3">
                        <label for="eventDate" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="eventDate" name="eventDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="descreption" class="form-label">Description</label>
                        <textarea class="form-control" id="descreption" name="descreption" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="location" name="location" required readonly>
                            <button type="button" class="btn btn-outline-secondary" id="openMapBtn">Choose on Map</button>
                        </div>
                    </div>
                    <div class="mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </div>
                </form>
            </div>
            <!-- Column for image -->
            <div class="col-md-6 text-center" style="margin-top: 50px">
                <img src="{{ asset('Back_office/assets/images/3.webp') }}" alt="Event illustration" class="img-fluid w-50">
                <h6>"Create memorable events for a better tomorrow"</h6>

            </div>
        </div>
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
