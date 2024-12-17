@extends('Frontend.Layout.main')

@section('title', 'Hotels & Nature Camps in Ranthambore National Park, India')

@section('keywords', 'Ranthambore National Park Terms and Conditions, Ranthambore National Park group booking terms and conditions, Ranthambore National Park Booking Terms, Ranthambore National Park Safari Rules, Ranthambore National Park Cancellation Policy, Ranthambore National Park Refund Policy, Ranthambore National Park Privacy Policy, Ranthambore National Park Booking Modifications, Ranthambore National Park accommodation refund policy')

@section('description', 'Find top hotels in Ranthambore National Park, Rajasthan. Check out Ranthambore Tiger Reserve stays and nature camp resorts. Book hotels in Ranthambore.')

@section('section')



<div class="breadcrumb-area breed25">

<div class="container">

<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12">

<div class="breadcrumb-wrap">

<h2>Terms & Conditions</h2>

<ul class="breadcrumb-links">

<li>

<a href="{{url('/')}}">Home</a>

<i class="bx bx-chevron-right"></i>

</li>

<li>Terms & Conditions</li>

</ul>

</div>

</div>

</div>

</div>

</div>







<div class="destinations-area ">

<div class="container">

<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12 mt-5">

<div class="section-head pb-40">

<h1 class="fw-bold">Terms & Conditions For The Safari In Ranthambore</h1>

</div>

</div>

</div>

<div class="row col-12 mx-auto">

  <div class="col-lg-9">

  

    <div class="card">



      <div class="table-responsive">

        <table class="table w-100 mb-4">

          <tr><th class="mb-1 shadow brd-thm1"><i class="bx bxs-chevrons-right shadow" class="thm-clr2"></i></th><td class="brd-thm1">After the confirmed booking, No Refund or Cancellation is acceptable.</td></tr>

          <tr><th class="mb-1 shadow brd-thm1"><i class="bx bxs-chevrons-right shadow" class="thm-clr2"></i></th><td class="brd-thm1">The entry permits are non-exchangeable and non-transferable.</td></tr>

          <tr><th class="mb-1 shadow brd-thm1"><i class="bx bxs-chevrons-right shadow" class="thm-clr2"></i></th><td class="brd-thm1">The fees regarding the safari might change without any prior notice, and visitors have to pay the extra amount to the officials at the entrance gate at the time of entry into the park.</td></tr>

          <tr><th class="mb-1 shadow brd-thm1"><i class="bx bxs-chevrons-right shadow" class="thm-clr2"></i></th><td class="brd-thm1">The Govt. of Rajasthan reserves the Right to Admission.</td></tr>

          <tr><th class="mb-1 shadow brd-thm1"><i class="bx bxs-chevrons-right shadow" class="thm-clr2"></i></th><td class="brd-thm1">The opening and closing timings might change, or the park or any particular zone may be closed without prior notice in an emergency.</td></tr>

          <tr><th class="mb-1 shadow brd-thm1"><i class="bx bxs-chevrons-right shadow" class="thm-clr2"></i></th><td class="brd-thm1">Visitors must submit a photocopy of the Identity proof at the entrance before entering the park.</td></tr>

          <tr><th class="mb-1 shadow brd-thm1"><i class="bx bxs-chevrons-right shadow" class="thm-clr2"></i></th><td class="brd-thm1">The original ID proof will be checked at the time of entry.</td></tr>

          <tr><th class="mb-1 shadow brd-thm1"><i class="bx bxs-chevrons-right shadow" class="thm-clr2"></i></th><td class="brd-thm1">There is a charge for using the still camera.</td></tr>

          <tr><th class="mb-1 shadow brd-thm1"><i class="bx bxs-chevrons-right shadow" class="thm-clr2"></i></th><td class="brd-thm1">Terms and Conditions are subject to change and may be appended or amended without prior notice or information due to numerous Govt. Policies.</td></tr>

        </table>                        

      </div>

    </div>





  

<!-- <div class="card card-bg my-3 my-lg-4">

    <div class="card-body">

        <img src="{{asset('public/assets/images/t&c.webp')}}" alt="Terms and Conditions" class="img-fluid  rounded" style="width:100%;">

    </div>

</div> -->

<h2 class="mb-3 h2_stl">Payments</h2>

<p class="mb-4" style="text-align:justify;">

To purchase tour packages or our related services through our website, we collect some advance payment to hold the booking on a confirmed basis, and the rest of the package cost can be paid upon arrival to the destination but before the commencement of our services. We have the sole right to decide the mode of payment and the amount to be paid in advance. Furthermore, it varies according to the nature of the services we offer. Full payment must be sent in advance during the peak season of Ranthambore Tourism (X-mas, New Year & Festival Time) to hold the booking of hotels and resorts.

</p>

<p class="mb-4" style="text-align:justify;">

In case of unavailability in the mentioned resorts or stays, alternate accommodation will be arranged immediately in similar category resorts.

</p>

<h2 class="mb-3 h2_stl">Mode of Payment:</h2>

<p class="mb-4" style="text-align:justify;">

Our user-friendly website provides options for overseas advance payment via net banking, Master/Visa debit, or credit card. Foreign nationals can make payment through currency notes/traveler cheques or through master/visa American Express Credit Card. Please note that in case of payment made through a credit card, the bank charges, as applicable, will be added to the total amount and paid simultaneously.

</p>

<p class="mb-4" style="text-align:justify;">

<b>In peak season -</b> weekends or weekdays (Holi, Diwali, X'Mas & New Year) hotel/Forest Lodges bookings, a separate cancellation policy is applicable (which would be advised as and when required).

</p>

<p class="mb-4" style="text-align:justify;">

<b>Important Note:</b><br> If your safari is not booked due to a technical error or seat non-availability, we will refund the whole amount to your given bank account. The same would be communicated accordingly.

</p>

  </div>





<div class="col-lg-3 my-4 px-0">

<div class="blog-sidebar">

<div class="row col-12 mx-auto ">

<div class="col-lg-12">

<div class="sidebar-searchbox card shadow brd-thm1">

<div class="input-group search-box">

<div class="contact-form">

<form action="{{route('submit_contact')}}" method="POST">

  @csrf

  <h2 class="categorie-head thm-clr h2_stl">Contact Us</h2>

  <div class="row">

  <div class="col-lg-12 mb-2">

  <input type="text" name="name" placeholder="Full Name" required>

  @error('name')

  <span class="text-danger" style="position:absolute;">{{ $message }}</span>

  @enderror

  </div>

  <div class="col-lg-12 mb-2">

  <input type="text" name="subject" placeholder="Subject" required>

  @error('subject')

  <span class="text-danger" style="position:absolute;">{{ $message }}</span>

  @enderror

  </div>

  <div class="col-lg-12 mb-2">

  <input type="email" name="email" placeholder="Your Email" required>

  @error('email')

  <span class="text-danger" style="position:absolute;">{{ $message }}</span>

  @enderror

  </div>

  <div class="col-lg-12 mb-2">

  <input type="text" name="mobile" placeholder="Phone" required>

  @error('mobile')

  <span class="text-danger" style="position:absolute;">{{ $message }}</span>

  @enderror

  </div>

  <div class="col-lg-12 mb-2">

  <textarea cols="30" rows="5" name="message" placeholder="Write Message" required></textarea>

  @error('message')

  <span class="text-danger" style="position:absolute;">{{ $message }}</span>

  @enderror

  </div>

  <div class="col-lg-12 mb-2">

  <input type="submit" class="btn-common mt-2 thm-bg2" value="Contact Us Now" >

  </div>

  </div>

</form>

</div>

</div>

</div>

</div>



<div class="col-lg-12 col-md-6  mt-20">

<div class="blog-categorie  card shadow brd-thm1 h-100">

<h2 class="categorie-head thm-clr h2_stl mb-2" >Important Links</h2>

<ul>

<li><a href="{{route('faq')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> FAQ</a></li>

<li><a href="{{route('geographical')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Geography About Park</a></li>

<li><a href="{{route('tandc')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Terms & Conditions</a></li>

<li><a href="{{route('safari_tips')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Safari Tips</a></li>

</ul>

</div>

</div>



<div class="col-lg-12 col-md-6 mt-20">

<div class="blog-categorie card shadow brd-thm1 h-100">

<h2 class="categorie-head thm-clr h2_stl mb-2" >Notices</h2>

<ul>

<li><a href="{{route('how_to_reach')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> How to reach</a></li>

<li><a href="{{route('best_time')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Best time to visit</a></li>

<li><a href="{{route('places_to_visit')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Why Is Ranthambore Famous</a></li>

<li><a href="{{route('history')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Park History</a></li>

</ul>

</div>

</div>



<div class="col-lg-12 col-md-6 mt-20">

<div class="blog-categorie  card shadow brd-thm1 h-100">

<h2 class="categorie-head thm-clr h2_stl mb-2" >About</h2>

<ul>

<li><a href="{{route('floraandfauna')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Flora And Fauna</a></li>

<li><a href="{{route('onlinesafari')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Jeep Safari</a></li>

<li><a href="{{route('best_tiger_zone')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Best Safari Zone</a></li>

<li><a href="{{route('birds')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Birds Lists</a></li>

<li><a href="{{route('jungle_safari')}}" class="thm-clr2"><i class="bx bxs-chevrons-right"></i> Jungle Safari</a></li>

</ul>

</div>

</div>







</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

@endsection