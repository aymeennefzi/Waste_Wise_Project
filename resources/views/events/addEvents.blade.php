<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f5f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #495057;
            font-size: 16px;
            font-weight: 500;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            color: #495057;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-group textarea {
            resize: vertical;
            height: 150px;
        }

        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            color: white;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        #map {
            height: 400px;
            margin-top: 15px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #ced4da;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 20px;
            }

            h1 {
                font-size: 24px;
            }

            .btn {
                padding: 12px;
                font-size: 16px;
            }
        }
    </style>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
</head>
<body>
    <div class="container">
        <h1>Add Event</h1>

        <form method="POST" action="{{ route('events.store') }}">
            @csrf

            <div class="form-group">
                <label for="eventName">Event Name:</label>
                <input type="text" id="eventName" name="eventName" required>
            </div>

            <div class="form-group">
                <label for="eventDate">Event Date:</label>
                <input type="date" id="eventDate" name="eventDate" required>
            </div>

            <div class="form-group">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>
                <div id="map"></div>
            </div>

            <div class="form-group">
                <label for="descreption">Description:</label>
                <textarea id="descreption" name="descreption" required></textarea>
            </div>

            <div class="form-group">
                <label for="communityId">Community ID:</label>
                <input type="number" id="communityId" name="communityId" required>
            </div>

            <button type="submit" class="btn">Add Event</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var map = L.map('map').setView([51.505, -0.09], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            var geocoder = L.Control.geocoder({
                defaultMarkGeocode: false
            })
            .on('markgeocode', function(e) {
                var latlng = e.geocode.center;
                map.setView(latlng, 13);
                if (marker) {
                    map.removeLayer(marker);
                }
                marker = L.marker(latlng).addTo(map);
                var locationInput = document.getElementById('location');
                locationInput.value = latlng.lat + ', ' + latlng.lng;
            })
            .addTo(map);

            var marker;

            map.on('click', function(e) {
                var locationInput = document.getElementById('location');
                locationInput.value = e.latlng.lat + ', ' + e.latlng.lng;

                if (marker) {
                    map.removeLayer(marker);
                }

                marker = L.marker(e.latlng).addTo(map);
            });
        });
    </script>
</body>
</html>
