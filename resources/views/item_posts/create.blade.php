

@extends('HomePage.home') <!-- Adjust the path as necessary -->

@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Adding new post</h1>
        <div>
            <a href="{{ route('meetings.index') }}" class="btn btn-primary mx-2">Meetings</a>
            <a href="{{ route('item-posts.user') }}" class="btn btn-primary mx-2">Your Posts</a>
            <a href="{{ route('item-posts.create') }}" class="btn btn-primary">Create New Post</a>
        </div>
    </div>
    <form action="{{ route('item-posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">
                    The name field is required.
                </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control @error('category') is-invalid @enderror" id="category" name="category" value="{{ old('category') }}">
            @error('category')
                <div class="invalid-feedback">
                    The category field is required.
                </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    The description field is required.
                </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image">
            @error('image')
                <div class="invalid-feedback">
                    An image file is required.
                </div>
            @enderror
        </div>
        
        {{-- <div class="mb-3">
            <label for="lat" class="form-label">Latitude</label>
            <input type="text" class="form-control" id="lat" name="lat" required>
        </div>
        <div class="mb-3">
            <label for="lng" class="form-label">Longitude</label>
            <input type="text" class="form-control" id="lng" name="lng" required> --}}


    <div id="map" style="height:400px; width: 100%;" class="my-3 mb-14"></div>

    <script>
        let map;
        function initMap() {
            map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: 34.75599910503775, lng: 10.781388089414689 },
                zoom: 8,
                scrollwheel: true,
            });

            const uluru = { lat: 34.75599910503775, lng: 10.781388089414689 };
            let marker = new google.maps.Marker({
                position: uluru,
                map: map,
                draggable: true
            });

            google.maps.event.addListener(marker,'position_changed',
                function (){
                    let lat = marker.position.lat()
                    let lng = marker.position.lng()
                    $('#lat').val(lat)
                    $('#lng').val(lng)
                })

            google.maps.event.addListener(map,'click',
            function (event){
                pos = event.latLng
                marker.setPosition(pos)
            })
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
            type="text/javascript"></script>
            <div class="invisible">
                <input type="text" class="my-0 @error('lat') is-invalid @enderror" placeholder="lat" name="lat" id="lat" value="{{ old('lat') }}">
            </div>
            @error('lat')
                <div class="alert alert-danger mt-2">
                    The latitude field is required.
                </div>
            @enderror
            
            <div class="invisible">
                <label class="form-label">Lng</label>
                <input type="text" class="my-0 @error('lng') is-invalid @enderror" placeholder="lng" name="lng" id="lng" value="{{ old('lng') }}">
            </div>
            @error('lng')
                <div class="alert alert-danger mt-2">
                    The longitude field is required.
                </div>
            @enderror
            
            

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
