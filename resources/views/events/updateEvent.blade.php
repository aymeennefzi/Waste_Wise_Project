@extends('layouts.adminLayout')

@section('content')
<div class="container">
    <h1>Update Event</h1>

    <form method="POST" action="{{ route('events.update', $event->id) }}" class="form-container">
        @csrf
        @method('PUT')

        <div class="form-group">
            <div class="input-group">
                <div class="input-wrapper">
                    <label for="eventName">Event Name:</label>
                    <input type="text" id="eventName" name="eventName" value="{{ old('eventName', $event->eventName) }}" required>
                </div>

                <div class="input-wrapper">
                    <label for="eventDate">Event Date:</label>
                    <input type="date" id="eventDate" name="eventDate" value="{{ old('eventDate', $event->eventDate) }}" required>
                </div>
            </div>

            <div class="input-wrapper">
                <label for="descreption">Description:</label>
                <textarea id="descreption" name="descreption" required>{{ old('descreption', $event->descreption) }}</textarea>
            </div>

            <div class="input-group">
                <div class="input-wrapper location-wrapper">
                    <label for="location">Location:</label>
                    <div class="location-input-group">
                        <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}" required readonly>
                        <button type="button" id="openMapBtn">Choose on Map</button>
                    </div>
                </div>


            </div>

            <div class="form-group">
                <div class="input-wrapper">
                    <button type="submit" class="btn">Update Event</button>
                </div>
            </div>
        </div>

    </form>
</div>

<!-- Map Modal -->
<div id="mapModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div id="map"></div>
        <button id="confirmLocation">Confirm Location</button>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<style>
    .form-container {
        max-width: 600px;
        margin: auto;
        margin-top: 30px;
    }

    .input-group {
        display: flex;
        gap: 20px;
        margin-bottom: 15px;
    }

    .input-wrapper {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .location-wrapper {
        flex: 2;
    }

    .location-input-group {
        display: flex;
        gap: 10px;
    }

    .location-input-group input {
        flex: 1;
    }

    label {
        margin-bottom: 5px;
    }

    input, select, textarea {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    button {
        padding: 8px 15px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    #map {
        height: 400px;
        width: 100%;
        margin-bottom: 20px;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let map;
    let marker;
    let modal = document.getElementById("mapModal");
    let btn = document.getElementById("openMapBtn");
    let span = document.getElementsByClassName("close")[0];
    let confirmBtn = document.getElementById("confirmLocation");
    let locationInput = document.getElementById('location');

    function initMap() {
        map = L.map('map').setView([0, 0], 2);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        map.on('click', function(e) {
            placeMarker(e.latlng);
        });

        // Set initial marker if location is already set
        let initialLocation = locationInput.value.split(',');
        if (initialLocation.length === 2) {
            let lat = parseFloat(initialLocation[0]);
            let lng = parseFloat(initialLocation[1]);
            if (!isNaN(lat) && !isNaN(lng)) {
                placeMarker(L.latLng(lat, lng));
                map.setView([lat, lng], 13);
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

    btn.addEventListener('click', function() {
        modal.style.display = "block";
        if (!map) {
            initMap();
        } else {
            map.invalidateSize();
        }
    });

    span.addEventListener('click', function() {
        modal.style.display = "none";
    });

    confirmBtn.addEventListener('click', function() {
        if (marker) {
            let latLng = marker.getLatLng();
            locationInput.value = latLng.lat.toFixed(6) + ', ' + latLng.lng.toFixed(6);
        }
        modal.style.display = "none";
    });

    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    });
});
</script>

@endsection
