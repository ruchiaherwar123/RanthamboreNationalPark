@extends('Frontend.Layout.main')

@section('title', 'Contact Information: Connect with Our Esteemed Team for More Information')

@section('keywords', 'Ranthambore National Park Contact, Ranthambore National Park Booking Inquiries, Ranthambore National Park Customer Support, Ranthambore National Park Safari Bookings, Ranthambore National Park Accommodation Reservations, Ranthambore National Park Wildlife Tours, Ranthambore National Park Complaints, Ranthambore National Park Suggestions')

@section('description', 'Need assistance? Contact us now and get in touch with us quickly. Find our contact information, mail, and address here.')

@section('section')

@if (session('contact'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">

  {{ session('contact') }}

  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

  </div>

@endif

@if (session('error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

  {{ session('error') }}

  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

  </div>

@endif

<div class="breadcrumb-area breed7">

<div class="container">

<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12">

<div class="breadcrumb-wrap">

<h2 class="text-white">Contact US</h2>

<ul class="breadcrumb-links">

<li>

<a href="{{url('/')}}">Home</a>

<i class="bx bx-chevron-right"></i>

</li>

<li class="">Contact Us</li>

</ul>

</div>

</div>

</div>

</div>

</div>



<div class="contact-wrapper pt-40">

<div class="contact-cards">

<div class="container">

<div class="row">

<div class="col-lg-4 col-md-12 col-sm-12">

<div class="contact-card">

<div class="contact-icon"><i class="flaticon-arrival"></i>

</div>

<div class="contact-info">

<h2>Address</h2>

<a href="https://maps.app.goo.gl/qxSMW8QhKAHkJMak8" target="_blank" style="color:grey">Ranthambore National Park</a>

</div>

</div>

</div>

<div class="col-lg-4 col-md-12 col-sm-12">

<div class="contact-card">

<div class="contact-icon"><i class="flaticon-customer-service"></i>

</div>

<div class="contact-info">

<h2>Email & Phone</h2>

<p style="font-size:17px;">+91-7303062162</p>

<p style="font-size:14px;">info@ranthamborenationalparkonline.net</p>

</div>

</div>

</div>

<div class="col-lg-4 col-md-12 col-sm-12">

<div class="contact-card">

<div class="contact-icon"><i class="flaticon-thumbs-up"></i>

</div>

<div class="contact-info">

<h2>Social Media</h2>

<ul class="contact-icons">

<li><a href="https://www.instagram.com/indianationalparktour?igsh=MXFkYXEyMXAwNjNlZg==" target="blank"><i class="bx bxl-instagram"></i></a></li>

<li><a href="https://www.facebook.com/profile.php?id=61558886519797&mibextid=LQQJ4d" target="blank"><i class="bx bxl-facebook"></i></a></li>

<!--<li><a href="#"><i class="bx bxl-twitter"></i></a></li>-->

<!--<li><a href="#"><i class="bx bxl-whatsapp"></i></a></li>-->

</ul>

</div>

</div>

</div>

</div>

</div>

</div>

<div class="container-fluid contact-div">

    <div class="contact-inputs pt-40">

        <div class="row col-12 mx-auto">

            <div class="col-lg-8 mx-auto">

            <div class="card px-4 py-4 p-3 mb-5 rounded ">

                <div class="col-lg-12">

                    <div class="contact-form">

                    <form action="{{ route('submit_contact') }}" method="POST">
                        @csrf
                        <h1 class="contact-d-head text-white mb-2">Contact Us</h1>
                        <div class="row">
                            <!-- Full Name Field -->
                            <div class="col-lg-6">
                                <input type="text" name="name" class="shadow brd-thm1" placeholder="Full Name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger" style="font-size: 0.875rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Subject Field -->
                            <div class="col-lg-6">
                                <input type="text" name="subject" class="shadow brd-thm1" placeholder="Subject" value="{{ old('subject') }}">
                                @error('subject')
                                    <span class="text-danger" style="font-size: 0.875rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Email Field -->
                            <div class="col-lg-6">
                                <input type="email" name="email" class="shadow brd-thm1" placeholder="Your Email" value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger" style="font-size: 0.875rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Mobile Field -->
                            <div class="col-lg-6">
                                <input type="number" name="mobile" class="shadow brd-thm1" placeholder="Phone" value="{{ old('mobile') }}">
                                @error('mobile')
                                    <span class="text-danger" style="font-size: 0.875rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Message Field -->
                            <div class="col-lg-12">
                                <textarea cols="30" rows="7" name="message" class="shadow brd-thm1" placeholder="Write Message">{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="text-danger" style="font-size: 0.875rem;">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-lg-12">
                                <input type="submit" value="Submit Now">
                            </div>
                        </div>
                    </form>
                    
                    </div>

                </div>

            </div>

            </div>

        </div>

    </div>

</div>



@endsection