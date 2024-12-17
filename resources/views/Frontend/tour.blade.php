@extends('Frontend.Layout.main')

@section('title', 'Best Ranthambore & Rajasthan Tour Packages | Holiday Deals ')

@section('keywords','Ranthambore national park tour packages , Ranthambore tour, tour packages Ranthambore, best holiday packages, rajasthan tour packages, ranthambore safari booking, Ranthambore tour packages, Ranthambore national park tours, Ranthambore jungle safari, Ranthambore online booking')

@section('description', 'Explore Ranthambore tour packages & Rajasthan holiday deals. Best tour packages for Ranthambore National Park adventures | Explore Rajasthan Tour Packages')

@section('section')

<style>

    .fixed-form {

        position: -webkit-sticky; /* For Safari */

        position: sticky;

        top: 82px; /* Adjust as needed */

        align-self: start; /* Keeps it aligned at the top */

    }

    h2{

        line-height:normal;

    }

    /*.img-fluid {
                max-width: 100%;
                height: 200px;
                object-fit: cover;
            }*/
</style>

    <div class="package-area mt-2">

        <div class="container-fluid py-5 my-3 text-center breed28">

             <div class="container">

                  <h1 class="text-white mb-4 fw-bold">

                    Ranthambore Tour and Packages

                  </h1>

                  <p class="text-white">

                      If you are looking for a memorable Ranthambore trip, our holiday packages are the right choice for you. We offer the widest range of customizable Ranthambore tour to suit every kind of traveller Explore tour packages to Ranthambore with unbeatable deals and discounts.

                  </p>

             </div>

        </div>

        <div class="container">

            <div>

            </div>

            <div class="row py-4">

                <div class="container-xxl my-3  wow fadeInUp" data-wow-delay="0.1s">

                    <div class="row col-12 mx-auto">

                         <div class="col-lg-9">

                              @foreach ($tour as $item)

                                  <div class="container p-3">

                       <div class="card rounded shadow-lg brd-thm1 h-100 ">

                            <div class="row col-12  mx-auto my-3  wow fadeInUp" data-wow-delay="0.1s">

                                    <div class="row col-12 mx-auto px-0">

                                        <div class="col-lg-3 col-md-4 col-sm-12 d-flex align-items-center">

                                            <div class="card" style="overflow:hidden;">

                                                @php 

                                                $image=json_decode($item->image);

                                                @endphp

                                                <a href="{{ route('Home.tour_view', ['name' => $item->seo_name]) }}"><img src="{{asset('public/tourimage/'.$image[0])}}" style="height:100%; width:100%;" alt="{{$item->alt}}" class="img-scale" loading="lazy"></a>

                                            </div>

                                        </div>

                                        <div class="col-lg-9 col-md-8 col-sm-12">

                                            <div class="container p-1">

                                                <div>

                                                   <a href="{{ route('Home.tour_view', ['name' => $item->seo_name]) }}"><h2 class="mb-0 pb-0 text-dark h2_stl text-dark">{{$item->title}}</h2></a>

                                                   <p style="font-size:16px;font-weight:600;" class="py-0 my-0">{{$item->time}} | {{$item->jeep}}</p>

                                                   <i class="fa fa-star fa-sm thm-clr"></i>

                                                   <i class="fa fa-star fa-sm thm-clr"></i>

                                                   <i class="fa fa-star fa-sm thm-clr"></i>

                                                   <i class="fa fa-star fa-sm thm-clr"></i>

                                                   <i class="fa fa-star fa-sm thm-clr"></i>

                                                   <p class="text-justify">

                                                       {{ Str::limit($item->description, 200, '...') }}</p>

                                                </div> 

                                            </div>

                                         </div>

                                    </div>

                            

                                

                            </div><!--Close div for row-->

                        </div><!--Close Div for card-->

                    </div><!--close div for container-->

                                @endforeach

                         </div>

                         <div class="col-lg-3 col-md-6 col-sm-10 mx-auto py-3 fixed-form">

                            <div class="sidebar-searchbox card brd-thm1 shadow">

                                <div class=" card-body input-group search-box">

                                    <div class="contact-form">

                                        <form action="{{route('submit_enquiry')}}" method="POST">

                                        @csrf

                                          <h2 class="categorie-head thm-clr text-center mb-3 h2_stl">ENQUIRY</h2>

                                          <div class="row">

                                          <div class="col-lg-12 mb-2">

                                          <input type="text" name="name" placeholder="Name" required>

                                            </div>

                                          <div class="col-lg-12 mb-2">

                                          <input type="tel" name="mobile" placeholder="Mobile" required>

                                            </div>

                                          <div class="col-lg-12 mb-2">

                                          <input type="email" name="email" class="form-control text-dark" style="color:#000000 !important;" placeholder="Email" required>

                                            </div>

                                          <div class="col-lg-12 mb-2">

                                          <input type="text" name="country" placeholder="Country" required>

                                            </div>

                                          <div class="col-lg-12 mb-2">

                                          <textarea cols="30" rows="5" name="message" class="form-control shadow-none" style="color:#000000 !important;" placeholder="Write Message"></textarea>

                                          </div>

                                          <div class="col-lg-12 mb-3">

                                          <input type="submit" class="btn-common py-2 px-3 mt-2 thm-bg" value="Submit" >

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

        </div>

    </div>

<!-- Include SweetAlert2 JS -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    // Check for session flash messages

    @if (session('contactmsg'))

        Swal.fire({

            title: 'Success!',

            text: '{{ session('contactmsg') }}',

            icon: 'success',

            confirmButtonText: 'OK'

        });

    @elseif (session('errormsg'))

        Swal.fire({

            title: 'Error!',

            text: '{{ session('errormsg') }}',

            icon: 'error',

            confirmButtonText: 'OK'

        });

    @endif

</script>

@endsection

