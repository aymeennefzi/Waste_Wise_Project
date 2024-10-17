@extends('HomePage.home')

@section('content')
<div class="container my-5">
    <h1 class="h3">Schedule a Meeting</h1>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">{{ $itemPost->name }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $itemPost->description }}</p>
            <p class="card-text"><strong>Location:</strong> {{ $itemPost->address }}</p>
        </div>
    </div>

    <form action="{{ route('meetings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="item_post_id" value="{{ $itemPost->id }}">
        <input type="hidden" name="owner_id" value="{{ $itemPost->user_id }}">
        <input type="hidden" name="buyer_id" value="{{ Auth::id() }}">
        <input type="hidden" name="status" value="1">
    
        <div class="mb-3">
            <label for="meeting_time" class="form-label">Meeting Time</label>
            <input type="datetime-local" name="meeting_time" class="form-control" required>
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
            draggable: false // Set draggable to false to make the marker fixed
        });
    }
</script>
        </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"
    type="text/javascript"></script>



    
        <button type="submit" class="btn btn-primary">Schedule Meeting</button>
    </form>
    
</div>
@endsection
