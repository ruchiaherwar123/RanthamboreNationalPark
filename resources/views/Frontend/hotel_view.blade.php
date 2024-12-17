@extends('Frontend.Layout.main')
@section('title', $pageTitle)
@section('keywords', $pageKeywords)
@section('description', $pageDescription)
@section('section')

<div class="breadcrumb-area breed26">
    <div class="container">
        <div class="row col-12">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="breadcrumb-wrap">
                    <h2>{{$hotel[0]->name}}</h2>
                    <ul class="breadcrumb-links">
                    <li>
                    <a href="{{url('/')}}">Resort Booking</a>
                    <i class="bx bx-chevron-right"></i>
                    </li>
                    <li>{{$hotel[0]->name}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container my-3">
     <div class="col-12 row mx-auto">
        <div class="col-md-12 col-sm-12  wow fadeInUp" data-wow-delay="0.3s">
            <h1 class="mb-2 pb-0 fw-bold">{{$hotel[0]->name}}</h1>
            <p class="mb-4 pb-0"><i class="fa fa-map-marker text-primaryy"></i> {{$hotel[0]->location}}</p>
            <!--<p>Home > Hotels > {{$hotel[0]->name}} </p>-->
        </div>
     </div>
</div>
<div class="container">
        <div class="row mx-auto hotel-view-img">
            <div class="col-lg-7 col-md-6 col-sm-12 wow fadeInUp h-100" data-wow-delay="0.1s">
                <div class="col-12 h-100">
                    @php 
                    $images = json_decode($hotel[0]->image);
                    $alt_tag = json_decode($hotel[0]->alt);
                    @endphp
                    <!-- Large image -->
                    <img src="{{ asset('public/hotelimage/'.$images[0])}}" style="width:100%; height:100%; object-fit:cover;" alt="@if($alt_tag){{$alt_tag[0]}}@endif" loading="lazy">
                </div>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12 wow fadeInUp h-100" data-wow-delay="0.1s">
                <!-- Small images -->
                <div class="row h-100">
                    @foreach($images as $key => $image)
                        @if($key > 0 && $key <= 4) <!-- Skip the first image (already displayed as large) and show the next four -->
                        <div class="col-6 my-2" style="height:45%;">
                            <img src="{{ asset('public/hotelimage/'.$image)}}" style=" height:100%;width:100%; object-fit:cover;" alt="@if(isset($alt_tag[$key])){{$alt_tag[$key]}}@endif" loading="lazy">
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
     
    </div><!--div close for row-->
</div><!--div close for container-->

<div class="container text-justify my-4">
    <h2 class="mb-3 text-dark">Description</h2>
    <p class="text-justify" >{!!$hotel[0]->description!!}</p>
</div>


<section>
    <div class="container">
        <div class="row col-12 mx-auto p-3 card-bg brd-thm2">
            <div id="scrollspyHeading2" class="text-justify"><h2 class="ff h2_stl text-dark">Available Rooms</h2>
                <div class="row mx-auto col-12">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card p-2 shadow-sm mt-4" style="border-radius:10px;">
                            <h2 class="h4_stl" style="color:#63743d; text-align:left;">One Night Stay Price</h2>
                            <h2 class="h4_stl" style="color:#63743d;">₹ {{$hotel[0]->price}}</h2>
                            <form action="{{url('/book_room')}}" method="post"> 
                            @csrf
                            <input type="hidden" name="room_price"  value="{{$hotel[0]->price}}" class="mt-2 w-100">
                            <input type="hidden" name="hotel" value="{{$hotel[0]->name}}" class="mt-2 w-100">
                            <div class="card-footer border-0 bg-white ps-0">
                            <button class="btn text-white table-row-clr li-item"  type="submit">Book Now</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card p-2 shadow-sm mt-4" style="border-radius:10px;">
                            <h2 class="h4_stl" style="color:#63743d; text-align:left;">Two Night Stay Price</h2>
                            <h2 class="h4_stl" style="color:#63743d;">₹ {{$hotel[0]->price2}}</h2>
                            <form action="{{url('/book_room')}}" method="post"> 
                            @csrf
                            <input type="hidden" name="room_price"  value="{{$hotel[0]->price2}}" class="mt-2 w-100">
                            <input type="hidden" name="hotel" value="{{$hotel[0]->name}}" class="mt-2 w-100">
                            <div class="card-footer border-0 bg-white ps-0">
                            <button class="btn text-white table-row-clr li-item"  type="submit">Book Now</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card p-2 shadow-sm mt-4" style="border-radius:10px;">
                            <h2 class="h4_stl" style="color:#63743d; text-align:left;">Three Night Stay Price</h2>
                            <h2 class="h4_stl" style="color:#63743d;">₹ {{$hotel[0]->price3}}</h2>
                            <form action="{{url('/book_room')}}" method="post"> 
                             @csrf
                            <input type="hidden" name="room_price"  value="{{$hotel[0]->price3}}" class="mt-2 w-100">
                            <input type="hidden" name="hotel" value="{{$hotel[0]->name}}" class="mt-2 w-100">
                            <div class="card-footer border-0 bg-white ps-0">
                            <button class="btn text-white table-row-clr li-item"  type="submit">Book Now</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
   <section class="container my-4">
     <div class="row col-12 mx-auto" >
        <h2 class="border-bottom thm-bg text-white h2_stl">facilities</h2>
         <table class="table  table-hover table-striped">
             <tbody>
                <tr>
                    <td><p class="li-item"><i class="fa fa-snowflake-o fa-lg me-2"></i> Air-Conditioning</p></td>
                    <td><p class="li-item"><i class="fa fa-wifi fa-lg me-2"></i> Internet Wi-fi</p></td>
               </tr>
               <tr>
                   <td><p class="li-item"><i class="fa fa-television fa-lg me-2"></i> Dining Area</p></td>
                   <td><p class="li-item"><i class="fa fa-coffee fa-lg me-2"></i> House Keeping</p></td>
               </tr>
              <tr>
                  <td><p class="li-item"><i class="fa fa-bed fa-lg me-2"></i> Living Room</p></td>
                  <td><p class="li-item"><i class="fa fa-bath fa-lg me-2"></i> Bathroom</p></td>
              </tr>
             </tbody>
         </table>
        </div>
        <div class="row col-12 mx-auto " >
        <h2 class="border-bottom thm-bg text-white h2_stl">Hotel Services</h2>
         <table class="table table-bordered table-hover table-striped">
             <tbody class="">
                 <tr><td><p class="li-item"><i class="fa fa-check-circle-o fa-lg me-2 "></i>Havana Lobby bar</p></td></tr>
                 <tr><td><p class="li-item"><i class="fa fa-check-circle-o fa-lg me-2 "></i>Fiesta Restaurant</p></td></tr>
                 <tr><td><p class="li-item"><i class="fa fa-check-circle-o fa-lg me-2 "></i>Hotel transport services</p></td></tr>
                 <tr><td><p class="li-item"><i class="fa fa-check-circle-o fa-lg me-2 "></i>Free luggage deposit</p></td></tr>
                 <tr><td><p class="li-item"><i class="fa fa-check-circle-o fa-lg me-2 "></i>Laundry Services</p></td></tr>
                 <tr><td><p class="li-item"><i class="fa fa-check-circle-o fa-lg me-2 "></i>Tickets</p></td></tr>
             </tbody>
         </table>
        </div>
   </section>
</div>
</section>
<section class="container my-5">
  <div class="row col-12 mx-auto">
    <h2 class="border-bottom thm-bg text-white h2_stl">Rules</h2>
    <table class="table table-bordered table-hover table-striped">
         <tr>
            <th><p class="li-item"><i class="fa fa-sign-in fa-lg me-2"></i>Check-IN</p></th>
            <td><p class="li-item">01:00 PM</p></td>
         </tr>
         <tr>
            <th><p class="li-item"><i class="fa fa-sign-out fa-lg me-2"></i>Check-OUT</p></th>
            <td><p class="li-item">11:00 AM</p></td>
         </tr>
    </table>




    <div class="card thm-card1 mb-4">

                            <h2 class="mb-2">Cancellation/Amendment <span>Policy:</span></h2>

                            <ul type="none" class="ms-0 ps-0 mb-1">

                               <li><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Cancellations or amendments should be made at least 15 days before arrival date incur no charges.</li>

                               <li><i class="fa fa-arrow-circle-right"></i> AAll reservations must be cancelled or modified there will be no changes after 72 hours, including the day of arrival, to avoid a penalty equal to one night room and tax.</li>

                               <li><i class="fa fa-arrow-circle-right"></i> In case of a no-show, a full room rate and tax will be charged.</li>

                               <li><i class="fa fa-arrow-circle-right"></i> Rates Packages are non-changeable and non-refundable.</li>

                            </ul>

                            <p><strong>Exclusions: </strong> The above policy does not apply during long weekends, festive holidays, Christmas, and New Year.</p>

                    </div>

                    <div class="card thm-card1 mb-4">        

                            <h2 class="mb-2">Late Check-Out <span>Policy:</span></h2>

                            <p>Late check-out shall be on a space-available basis.</p>

                            <ul type="none" class="ms-0 ps-0 mb-1">

                                <li><i class="fa fa-arrow-circle-right"></i> Check-out from 11:00am to 5:00pm is subject to a 50% room rate surcharge.</li>

                                <li><i class="fa fa-arrow-circle-right"></i> Extra 100% room rate surcharge for check-out after 05:00pm.</li>

                            </ul>

                            <h2 class="mb-2">Smoking/Alcohol Consumption <span>Rules:</span></h2>

                            <ul type="none" class="ms-0 ps-0 mb-1">

                               <li><i class="fa fa-arrow-circle-right"></i> Smoking is permitted inside the premises.</li>

                               <li><i class="fa fa-arrow-circle-right"></i> There are no restrictions on consuming alcohol.</li>

                            </ul>

                      </div>
</section>

@endsection