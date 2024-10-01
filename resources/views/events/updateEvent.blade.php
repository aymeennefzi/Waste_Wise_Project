<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 750px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
            font-size: 2rem;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-group label {
            display: block;
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
        }
        .form-group input,
        .form-group textarea {
            width: 85%;
            padding: 12px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin: 0 auto;
            display: block;
        }
        .form-group textarea {
            height: 120px;
            resize: vertical;
        }
        .btn {
            display: block;
            width: 85%;
            padding: 12px;
            font-size: 1rem;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 6px;
            text-align: center;
            cursor: pointer;
            margin: 20px auto 0;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        #map {
            height: 350px;
            margin-top: 20px;
            border-radius: 8px;
        }
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 20px;
            }
            .form-group input,
            .form-group textarea,
            .btn {
                width: 100%;
            }
        }
    </style>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>
<body>
    <div class="container">
        <h1>Update Event</h1>

        <form method="POST" action="{{ route('events.update', $event->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="eventName">Event Name:</label>
                <input type="text" class="form-control" id="eventName" name="eventName" value="{{ $event->eventName }}" required>
            </div>

            <div class="form-group">
                <label for="eventDate">Event Date:</label>
                <input type="date" class="form-control" id="eventDate" name="eventDate" value="{{ $event->eventDate }}" required>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}" required>
                <div id="map"></div>
            </div>

            <div class="form-group">
                <label for="descreption">Description:</label>
                <textarea class="form-control" id="descreption" name="descreption" required>{{ $event->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="communityId">Community ID:</label>
                <input type="number" class="form-control" id="communityId" name="communityId" value="{{ $event->communityId }}" required>
            </div>

            <button type="submit" class="btn">Update Event</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var location = "{{ $event->location }}".split(', ');
            var latitude = parseFloat(location[0]);
            var longitude = parseFloat(location[1]);

            var map = L.map('map').setView([latitude, longitude], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var geocoder = L.Control.geocoder({
                defaultMarkGeocode: false
            }).on('markgeocode', function(e) {
                var latlng = e.geocode.center;
                map.setView(latlng, 13);
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker(latlng).addTo(map);
                document.getElementById('location').value = latlng.lat + ', ' + latlng.lng;
            }).addTo(map);

            var marker = L.marker([latitude, longitude]).addTo(map);

            map.on('click', function(e) {
                document.getElementById('location').value = e.latlng.lat + ', ' + e.latlng.lng;

                if (marker) {
                    map.removeLayer(marker);
                }

                marker = L.marker(e.latlng).addTo(map);
            });
        });
    </script>
</body>
</html>
