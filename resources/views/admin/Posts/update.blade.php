@extends('layouts.adminLayout')
    @section('content')

    <div class="container mt-5">
        <h2 class="text-primary mb-4">Update Post</h2>
    
        <form action="{{ route('admin.itemposts.update', $itemPost->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $itemPost->name) }}" >
                @error('name')
                    <div class="invalid-feedback">
                        The name field must be filled out.
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category', $itemPost->category) }}" >
                @error('category')
                    <div class="invalid-feedback">
                        The category field must be filled out.
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" >{{ old('description', $itemPost->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        The description field must be filled out.
                    </div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <small class="form-text  " style="color: #ffffff">Leave blank if you do not want to change the image.</small>
            </div>
    
            <div id="map" style="height:400px; width: 100%;" class="my-3 mb-4"></div>
    
            <script>
                let map;
                function initMap() {
                    map = new google.maps.Map(document.getElementById("map"), {
                        center: { lat: {{ $itemPost->lat }}, lng: {{ $itemPost->lng }} }, // Use the current lat/lng from the itemPost
                        zoom: 8,
                        scrollwheel: true,
                    });
    
                    const marker = new google.maps.Marker({
                        position: { lat: {{ $itemPost->lat }}, lng: {{ $itemPost->lng }} },
                        map: map,
                        draggable: true
                    });
    
                    google.maps.event.addListener(marker, 'position_changed', function () {
                        let lat = marker.getPosition().lat();
                        let lng = marker.getPosition().lng();
                        document.getElementById('lat').value = lat;
                        document.getElementById('lng').value = lng;
                    });
    
                    google.maps.event.addListener(map, 'click', function (event) {
                        marker.setPosition(event.latLng);
                    });
                }
            </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
        type="text/javascript"></script>
    
            <input type="hidden" name="lat" id="lat" value="{{ old('lat', $itemPost->lat) }}">
            <input type="hidden" name="lng" id="lng" value="{{ old('lng', $itemPost->lng) }}">
    
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
    
    @endsection
