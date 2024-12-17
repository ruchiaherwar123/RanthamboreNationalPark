@extends('backend_views.layouts.main')
@section('main-section')
<!-- Main content -->
<section class="content">
   <div class="row">
   @if(session('admin-auth.role') === 'admin')
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
      <a href="{{ route('show_enquiry_details') }}" style="text-decoration: none; color: inherit;">
         <div id="cardbox1">
            <div class="statistic-box">
               <i class="fa fa-users fa-3x"></i>
               <div class="counter-number pull-right">
                  <span class="count-number">{{$totalenquiry}}</span> 
                  <span class="slight"><i class="fa fa-play fa-rotate-270"></i></span>
               </div>
               <h3>Total Enquiry Details</h3>
            </div>
         </div>
      </a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
      <a href="{{ route('show_safari_details') }}" style="text-decoration: none; color: inherit;">
         <div id="cardbox2">
            <div class="statistic-box">
               <i class="fa fa-info-circle fa-3x"></i>
               <div class="counter-number pull-right">
                  <span class="count-number">{{$totalsafaribooking }}</span> 
                  <span class="slight"><i class="fa fa-play fa-rotate-270"></i></span>
               </div>
               <h3>Total Safari Bookings</h3>
            </div>
         </div>
      </a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
      <a href="{{ route('show_hotel_booking_details') }}" style="text-decoration: none; color: inherit;">
         <div id="cardbox3">
            <div class="statistic-box">
               <i class="fa fa-home fa-3x"></i>
               <div class="counter-number pull-right">
                  <span class="count-number">{{$totalresortbooking}}</span> 
                  <span class="slight"><i class="fa fa-play fa-rotate-270"></i></span>
               </div>
               <h3>Total Resort Bookings</h3>
            </div>
         </div>
      </a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
      <a href="{{ route('show_package_booking_details') }}" style="text-decoration: none; color: inherit;">
         <div id="cardbox4">
            <div class="statistic-box">
               <i class="fa fa-home fa-3x"></i>
               <div class="counter-number pull-right">
                  <span class="count-number">{{$totalpackagebooking}}</span> 
                  <span class="slight"><i class="fa fa-play fa-rotate-270"></i></span>
               </div>
               <h3>Total Package Bookings</h3>
            </div>
         </div>
      </a>
      </div>
      @elseif(session('admin-auth.role') === 'superadmin')
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
      <a href="{{ route('show_enquiry_details') }}" style="text-decoration: none; color: inherit;">
         <div id="cardbox1">
            <div class="statistic-box">
               <i class="fa fa-users fa-3x"></i>
               <div class="counter-number pull-right">
                  <span class="count-number">{{$totalenquiry}}</span> 
                  <span class="slight"><i class="fa fa-play fa-rotate-270"></i></span>
               </div>
               <h3>Total Enquiry Details</h3>
            </div>
         </div>
      </a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
      <a href="{{ route('show_safari_details') }}" style="text-decoration: none; color: inherit;">
         <div id="cardbox2">
            <div class="statistic-box">
               <i class="fa fa-info-circle fa-3x"></i>
               <div class="counter-number pull-right">
                  <span class="count-number">{{$totalsafaribooking }}</span> 
                  <span class="slight"><i class="fa fa-play fa-rotate-270"></i></span>
               </div>
               <h3>Total Safari Bookings</h3>
            </div>
         </div>
      </a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
      <a href="{{ route('show_hotel_booking_details') }}" style="text-decoration: none; color: inherit;">
         <div id="cardbox3">
            <div class="statistic-box">
               <i class="fa fa-home fa-3x"></i>
               <div class="counter-number pull-right">
                  <span class="count-number">{{$totalresortbooking}}</span> 
                  <span class="slight"><i class="fa fa-play fa-rotate-270"></i></span>
               </div>
               <h3>Total Resort Bookings</h3>
            </div>
         </div>
      </a>
      </div>
      <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
      <a href="{{ route('show_package_booking_details') }}" style="text-decoration: none; color: inherit;">
         <div id="cardbox4">
            <div class="statistic-box">
               <i class="fa fa-home fa-3x"></i>
               <div class="counter-number pull-right">
                  <span class="count-number">{{$totalpackagebooking}}</span> 
                  <span class="slight"><i class="fa fa-play fa-rotate-270"></i></span>
               </div>
               <h3>Total Package Bookings</h3>
            </div>
         </div>
      </a>
      </div>
   @endif
   </div>
</div>
</section>
@endsection