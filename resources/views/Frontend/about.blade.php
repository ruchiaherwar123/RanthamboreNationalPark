@extends('Frontend.Layout.main')
@section('title', 'Ranthambore National Park |Best Travel Agency')
@section('keywords', 'Best Travel Agency')
@section('description', 'Explore the wonders of Ranthambore National Park with the expertise of the best travel agency. Plan your adventure seamlessly and embark on an unforgettable journey amidst nature marvels. Book your trip now for an immersive experience like no other.')
@section('section')

<div class="breadcrumb-area">
<div class="container">
<div class="row">
<div class="col-lg-12 col-md-12 col-sm-12">
<div class="breadcrumb-wrap">
<h2>About Us</h2>
<ul class="breadcrumb-links">
<li>
<a href="{{url('/')}}">Home</a>
<i class="bx bx-chevron-right"></i>
</li>
<li>About Us</li>
</ul>
</div>
</div>
</div>
</div>
</div>

<div class="about-wrapper mt-50">
    <div class="container">
        <div class="row mx-auto">
            <div class="col-lg-12 col-md-12 mt-3">
                <div class="section-head head-left">
                    <h1 class="mb-2 h3_stl text-center">About Us</h1>
                    <p class="mb-3">We're more than just a place to book your trip. We want to make sure you have tons of fun and explore lots of cool stuff! As the best travel agency , we know it can be hard to find all the right info when you're planning a trip. That's where we step in to help. We work with the people who provide services and the people who want to use them, making it easy for you to book what you need.</p>
                </div>
            </div>
            <div class="col-lg-5 col-md-12 mt-3 mx-auto" >
                <div class="">
                    <div class="about-img wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms">
                        <img src="{{asset('public/assets/images/about-1.webp')}}" alt="about-1" class="img-fluid w-100">
                    </div>
                </div>
            </div>

            <div class="col-12 mt-4">
                <p>We think visiting an Indian national park should be about more than just staying in a fancy hotel. There's so much cool stuff to see and do outside of the resorts! We want to help you discover all the hidden gems around the park, so you can make awesome memories. Our goal is to make sure you have the best time ever when you visit Indian national parks. We use the latest tech and our own knowledge to make sure your trip is super smooth. So, when you choose us, get ready for an amazing adventure in the heart of India's wilderness!</p>
            </div>
        </div>
    </div>
</div>

<div class="about-wrapper mt-50 mb-5">
    <div class="container">
        <div class="card px-4 py-4 shadow p-3 mb-4 bg-white rounded">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="mb-3">About The Services</h2>
                <p style="text-align:justify;">Strong Associations with all the hotels and resorts at bandhavgarh, enables us to give our clients their best value for money. This trait of our, makes us the most attractive tour and travel agency for you. We are prompt in our replies to your queries, and this has earned us a reputation as one of the best and most efficient tour and travel operators in India by both our clients and our overseas partners.</p>
            </div>
        </div>
        </div>
        <div class="card px-4 py-4 shadow p-3 mb-4 bg-white rounded">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="mb-3">Our Motto</h2>
                <p style="text-align:justify;">Customer satisfaction & quality services is our prime motto. The company has always provided the best quality in terms of service to its customers. The travellers have always had a satisfied note of the services provided by us.</p>
            </div>
        </div>
        </div>
        <div class="card px-4 py-4 shadow p-3 mb-4 bg-white rounded">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="mb-3">Disclaimer</h2>
                <ul type="circle">
                    <li class="mb-2" style="text-align:justify;">•   Experience Staff, and Assopciation with most of the hotels in Bandhavgarh National Park area, enables us to give our clients their best value for money. This trait of our, makes us the most attractive tour and travel agency agenncy for Wildlife Travel in India. We are prompt in our replies to your queries, and this has earned us a reputation as one of the best and most efficient tour and travel operators in India by both our clients and our overseas partners.</li>
                    <!-- <li class="mb-2" style="text-align:justify;">•   Bandhavgarh-National-Park.com act only in the capacity of agent for the hotels, airlines, transporters, railways & contractors providing other services & all exchange orders, receipts, contracts & tickets issued by us are issued subject to terms & conditions under which these services are provided by them.</li> -->
                    <li class="mb-2" style="text-align:justify;">•   We do not have any insurance policy covering the expenses for accident, sickness, loss due to theft, or any other reasons. Visitors are advised to seek such insurance arrangements in their home country. All baggages & personal property/s at all times are at the client’s risk.</li>
                    <li class="mb-2" style="text-align:justify;">•   All itineraries are sample itineraries, intended to give you a general idea of the likely trip schedule. Numerous factors such as weather, road conditions, the physical ability of the participants etc. may dictate itinerary changes either before the tour or while on the trail. We reserve the right to change any schedule in the interest of the trip participants’ safety, comfort & general well being.</li>
                    <li class="mb-2" style="text-align:justify;">•   We shall not be responsible for any delays & alterations in the programme or expenses incurred – directly or indirectly – due to natural hazards, flight cancellations, accident, breakdown of machinery or equipments, breakdown of transport, weather, sickness, landslides, political closures or any untoward incidents.</li>
                </ul>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection