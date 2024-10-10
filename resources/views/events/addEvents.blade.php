@extends('layouts.adminLayout')

@section('content')
<div class="container">
    <h1>Add Event</h1>

    <form method="POST" action="{{ route('events.store') }}" class="form-container">
        @csrf

        <div class="form-group">
            <div class="input-group">
                <div class="input-wrapper">
                    <label for="eventName">Event Name:</label>
                    <input type="text" id="eventName" name="eventName" required>
                </div>

                <div class="input-wrapper">
                    <label for="eventDate">Event Date:</label>
                    <input type="date" id="eventDate" name="eventDate" required>
                </div>
            </div>
            <div class="input-wrapper">
                <label for="descreption">Description:</label>
                <textarea id="descreption" name="descreption" required></textarea>
            </div>

            <div class="input-group">
                <div class="input-wrapper location-wrapper">
                    <label for="location">Location:</label>
                    <div class="location-input-group">
                        <input type="text" id="location" name="location" required readonly>
                        <button type="button" id="openMapBtn">Choose on Map</button>
                    </div>
                </div>


            </div>

            {{-- <div class="form-group">
                <div class="input-wrapper">
                    <label for="communityId">Community ID:</label>
                    <input type="number" id="communityId" name="communityId" required>
                </div>
            </div> --}}
        </div>


        <div class="form-group">
            <div class="input-wrapper">
                <button type="submit" class="btn">Add Event</button>
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
        z-index: 1;
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
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script><script>
document.addEventListener('DOMContentLoaded', function() {
    let map;
    let marker;
    let modal = document.getElementById("mapModal");
    let btn = document.getElementById("openMapBtn");
    let span = document.getElementsByClassName("close")[0];
    let confirmBtn = document.getElementById("confirmLocation");

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
            document.getElementById('location').value = latLng.lat.toFixed(6) + ', ' + latLng.lng.toFixed(6);
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
