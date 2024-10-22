@extends('layouts.adminLayout')

@section('content')
<div class="card-header">
    <h4 class="mb-0">Welcome to Waste Wise</h4>
</div>
<div class="card-body">
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">About Waste Wise</h5>
                    <p class="card-text">
                        Waste Wise is an application dedicated to promoting recycling and waste management. Our goal is to raise awareness among users about the importance of recycling while providing tools and resources to facilitate waste collection and sorting. With Waste Wise, you can track your recycling efforts, access information on recyclable materials, and discover tips to reduce your ecological footprint.
                    </p>
                    <ul>
                        <li><strong>Track Your Recycling Efforts:</strong> Keep a record of the waste you recycle and monitor your progress over time.</li>
                        <li><strong>Access Recycling Information:</strong> Learn about various recyclable materials and the correct ways to dispose of them.</li>
                        <li><strong>Receive Eco-Friendly Tips:</strong> Get practical advice on how to reduce your ecological footprint and adopt sustainable practices.</li>
                        <li><strong>Connect with Local Recycling Programs:</strong> Find nearby recycling centers and participate in community recycling initiatives.</li>
                    </ul>
                    <div class="text-center">
                        <img src="{{ asset('Back_office/assets/images/Waste.png') }}" alt="Waste Wise App" class="img-fluid" style="max-width: 50%; height: auto;">
                    </div>
                </div>
            </div>
        </div>
    </div><!--End Row-->
</div>
@endsection
