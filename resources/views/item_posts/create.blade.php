

@extends('HomePage.home') <!-- Adjust the path as necessary -->

@section('content')

<div class="container mt-5">
    <h2 class="text-primary mb-4">Add New Post</h2>

    <form action="{{ route('item-posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" id="category" name="category" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
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
                <input type="text" class="my-0"  placeholder="lat" name="lat" id="lat">
            </div>
            <div class=" invisible ">
                <label  class="form-label">Lng</label>
                <input type="text" class="my-0" placeholder="lng" name="lng" id="lng">
            </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection