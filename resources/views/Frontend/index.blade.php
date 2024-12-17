
@extends('Frontend.Layout.main')

@section('title', 'Ranthambore National Park, Sawai Madhopur, Rajasthan')

@section('keywords', 'ranthambore national park, ranthambore park, ranthambore national park india, hotels in ranthambore, ranthambore nature camp resort, ranthambore national park rajasthan, ranthambore tiger reserve, ranthambore national park hotels, ranthambore national park rajasthan india, ranthambore national park rajasthan')

@section('description', 'Discover Ranthambore National Park, Rajasthan top tiger reserve. Explore national parks in India, including Ranthambore famous tiger safaris with family.')

@section('section')

@if (session('message'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">

  {{ session('message') }}

  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

  </div>

@endif

@if (session('error'))

    <div class="alert alert-danger alert-dismissible fade show" role="alert">

  {{ session('error') }}

  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

  </div>

@endif

<!-- Modal For Booking-->

<div class="modal slide-in fade" id="ModalForBooking" tabindex="-1" aria-labelledby="BookingModalLabel" aria-hidden="true">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header table-row-clr text-white">

        <h2 class="modal-title ff h3_stl text-white" id="BookingModalLabel">Quick Booking</h2>

        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

      <form id="modalForm" action="{{ route('submit_modal_form') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label mb-2" for="name">Name: <span class="text-danger">*</span></label>
                <input class="form-control" id="name" name="name" type="text">
                <span id="nameError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label class="form-label mb-2" for="dateInput">Date Of Travel: <span class="text-danger">*</span></label>
                <input class="form-control" id="dateInput" name="date" type="date">
                <span id="dateError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label class="form-label mb-2" for="tel">Mobile Number: <span class="text-danger">*</span></label>
                <input class="form-control" id="tel" name="tel" type="number">
                <span id="telError" class="text-danger error-message"></span>
            </div>
            <div class="mb-3">
                <label class="form-label mb-2" for="remark">Remark: <span class="text-danger">*</span></label>
                <input class="form-control" id="remark" name="remark" type="text">
                <span id="remarkError" class="text-danger error-message"></span>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn table-row-shd text-white">Enquiry</button>
            </div>
        </form>


      </div>

    </div>

  </div>

</div>



<!-- end of hero slider -->

<section class="conatiner-fluid">

   <div class="hero-banner">

     <img src="{{asset('public/assets/images/banners/hero2.webp')}}"  alt="Majestic tiger" loading="lazy">

   </div>

</section>



<div class="about-wrapper">

    <div class="container mt-3">

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="section-head">

                    <h1 class="ff mb-2">Welcome to Ranthambore National Park</h1>

                    <!-- <h2>A Complete Guide to the Jewel of Rajasthan</h2> -->

                </div>

            </div>

        </div>



<!-- 1st card design  -->

        <div class="row col-12 mx-auto  d-flex align-items-center wow fadeInUp animated  " data-wow-duration="1000ms" data-wow-delay="0ms">

           

           <div class="col-lg-8 mt-4 mt-lg-1">

               <div class="card abt-cnt-card ">

                    <div class="card-body">

                      <p style="text-align:justify;">Ranthambore National Park is one of India's most famous national parks, and it is located in the Sawai Madhopur district of Rajasthan, India. Furthermore, Ranthambore covers an area of 392 sq km, blending the fineness of natural beauty with cultural heritage. Ranthambore has always appealed to several wildlife enthusiasts and nature lovers due to its rich history, anthropological significance, variety of flora and fauna, and being home to the majestic Bengal tigers.</p>

                      <p style="text-align:justify;">This beautiful sanctuary park was established in 1955 as a Sawai Madhopur Diversion Haven and was announced as one of the Extend Tiger saves in 1973. It officially became Ranthambore National Park in 1980. This park is a perfect destination for wildlife photographers and nature lovers. The wild is an unparalleled experience.</p>

                    </div>

               </div>

           </div>


           <div class="col-lg-4 mt-2 mt-lg-1">

               <div class="card abt-card wow fadeInUp animated"  data-wow-delay="0ms" data-wow-duration="1000ms">

                 <img src="{{asset('public/assets/images/about1.webp')}}" alt="Fearless Tiger " class="img-fluid " loading="lazy">

                 <div class="abt-brd-overlay"></div>

               </div>

           </div>

        </div>

    </div>

</div>







<div class="blog-area py-5">

  <div class="container">

     <div class="row col-12 mx-auto">

       <div class="col-lg-12 col-md-12 col-sm-12">

         <div class="section-head pb-30">

         <h2 class="ff">Ranthambore National Park</h2>

         </div>

       </div>

     </div>

     

     <div style="margin-bottom:5vh;">

        <p style="text-align:justify;">Ranthambore National Park Rajasthan holds a significant status in India's tourism sector with its distinct class and charm. However, it is not one of the biggest national parks in India, but it is indeed the most famous one. It is situated in the surrounding area of the Aravali hills and Vindhya plateau. The Ranthambore forest spreads over an area of 1334 sq km, with 392 sq km of the area as a national park. Highly revered for the natural habitat of the significant number of Royal Bengal tigers, the Ranthambore tiger reserve in India is very popular among wildlife lovers for its diurnal tigers, which means tourists can easily spot a tiger during their day safari visit. It is among the prominent national parks in India.</p>

     </div>

     

     

<div class="row col-12 mx-auto">

    <!--1st card -->

<div class="col-lg-3 col-md-4   wow fadeInLeft animated mt-3 " data-wow-duration="1500ms" data-wow-delay="0ms">

  <a href="{{route('onlinesafari')}}">

    <div class="achievement-card mt-30 h-100 shrt-icon">

      

      <div class="portal-card mx-auto" style="background-image: url('{{asset('public/assets/images/tiger-2.webp')}}'); background-size:100% 100%; background-position:center; aria-label="white Tiger" ">

          <!--background-image apply-->

      </div>

      <div class="mt-4">

      <h2 class="ff h2_stl text-white">Safari Booking</h2>

      <h2 class="li-item h3_stl text-white">Book Now <i class="fa fa-arrow-right"></i></h2>

      </div>

    </div>

  </a>

</div>

<!--2nd card-->

<div class="col-lg-3 col-md-4  wow fadeInLeft animated mt-3 cir-card" data-wow-duration="1500ms" data-wow-delay="200ms">

  <a href="{{route('onlinesafari')}}">

    <div class="achievement-card mt-30 h-100">

      <div class="portal-card mx-auto" style="background-image: url('{{asset('public/assets/images/canter.webp')}}'); background-size:100% 100%; background-position:center;">

          <!--background-image apply-->

      </div>

      <div class="mt-4">

      <h2 class="ff h2_stl text-white">Canter Booking</h2>

      <h2 class="li-item h3_stl text-white">Book Now <i class="fa fa-arrow-right"></i></h2>

      </div>

    </div>

  </a>

</div>

<!--3rd card-->

<div class="col-lg-3 col-md-4   wow fadeInLeft animated mt-3 cir-card" data-wow-duration="1500ms" data-wow-delay="600ms">

    <a href="{{route('hotel')}}">

      <div class="achievement-card mt-30 h-100">

        <div class="portal-card mx-auto" style="background-image: url('{{asset('public/assets/images/hotel.webp')}}'); background-size:100% 100%; background-position:center;">

          <!--background-image apply-->

      </div>

      <div class="mt-4">

      <h2 class="ff h2_stl text-white">Hotel Booking</h2>

      <h2 class="li-item h3_stl text-white">Book Now <i class="fa fa-arrow-right"></i></h2>

      </div>

      </div>

    </a>

</div>

<!--4th Card-->

<div class="col-lg-3 col-md-12  wow fadeInLeft  shadow-none animated mt-3 cir-card" data-wow-duration="1500ms" data-wow-delay="600ms">

  <a href="{{url('ranthambore-tour-packages')}}">

      <div class="achievement-card mt-30 h-100">

        <div class="portal-card mx-auto" style="background-image: url('{{asset('public/assets/images/tour_book.webp')}}'); background-size:100% 100%; background-position:center;">

          <!--background-image apply-->

      </div>

      <div class="mt-4">

      <h2 class="ff h2_stl text-white">Tour Booking</h2>

      <h2 class="li-item h3_stl text-white">Book Now <i class="fa fa-arrow-right"></i></h2>

      </div>

      </div>

    </a>

</div>

</div>

     

     

  </div>

</div>





<div class="achievement-area  mt-5 pb-3">

<div class="container ">

<div class="row col-12 mx-auto pt-4">

<div class="col-lg-12 col-md-12 col-sm-12">

<div class="section-head pb-1">

<h2 class="ff">Things to do in Ranthambore National Park</h2>

</div>

</div>

</div>

<div class="row col-12 mx-auto ">

    <!--1st card -->

<div class="col-lg-3 col-md-6 col-sm-6  wow fadeInLeft animated mt-3" data-wow-duration="1500ms" data-wow-delay="0ms">

  <a href="{{route('floraandfauna')}}">

    <div class="achievement-card  h-100 shrt-icon">

      <div class="achievement-icon ">

      <i class="fa fa-tree flip-icon "></i>

      </div>

      <h2 class="h3_stl text-white">Flora & Fauna</h2>

    </div>

  </a>

</div>

<!--2nd card-->

<div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft animated mt-3" data-wow-duration="1500ms" data-wow-delay="200ms">

  <a href="{{route('ranthambore_fort')}}">

    <div class="achievement-card h-100">

      <div class="achievement-icon ">

      <i class="fa fa-fort-awesome flip-icon"></i>

      </div>

      <h2 class="h3_stl text-white">Fort</h2>

    </div>

  </a>

</div>

<!--3rd card-->

<div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft animated mt-3" data-wow-duration="1500ms" data-wow-delay="600ms">

    <a href="{{route('jungle_safari')}}">

      <div class="achievement-card  h-100">

        <div class="achievement-icon ">

        <i class="fa fa-car flip-icon"></i>

        </div>

        <h2 class="h3_stl text-white">Tiger Safari</h2>

      </div>

    </a>

</div>

<!--4th Card-->

<div class="col-lg-3 col-md-6 col-sm-6 wow fadeInLeft animated mt-3" data-wow-duration="1500ms" data-wow-delay="600ms">

  <a href="{{route('tourist')}}">

    <div class="achievement-card h-100">

      <div class="achievement-icon ">

      <i class="fa fa-map-pin flip-icon"></i>

      </div>

      <h2 class="h3_stl text-white">Local Attractions</h2>

    </div>

  </a>

</div>

</div>

</div>

</div>





<div class="about-wrapper mt-50 mb-5">

    <div class="container">

        <div class="card px-4 py-4 shadow  brd-thm1 p-3 mb-5 bg-white rounded">

        <div class="row col-12 mx-auto">

            <div class="col-lg-4 order-lg-2 mb-lg-0  mb-3 d-flex align-items-center">

               <img src="{{asset('public/assets/images/tiger-2.webp')}}" alt="Tiger in Ranthambore National Park" class="img-fluid " loading="lazy">

            </div>

            <div class="col-lg-8 order-lg-1">

               <!-- histroy div -->

                <div class="mb-4">

                    <div class="row col-12 mx-auto px-0">

                        <div class="col-lg-12 col-md-12 col-sm-12 px-0">

                            <div class="section-head">

                                

                                <h2 class="mb-3 ff">History of Ranthambore National Park, Rajasthan</h2>

                            </div>

                        </div>

                    </div>

                    <p style="text-align:justify;">History of Ranthambore National Park, Rajasthan Arranged in the wealthy legacy of the illustrious past, Ranthambore National Stop has been the cynosure of consideration. The place, designed as a hunting ground for the Maharajas of Jaipur, was announced as a wildlife sanctuary in 1955 and later turned into a national park in 1980. Stories of tigers moving through generations are intermingled in the history of this park.
                    </p>

                </div>    

                 <!-- conservation div    -->

                <div>

                     <div class="row col-12 mx-auto px-0">

                         <div class="col-lg-12 col-md-12 col-sm-12 px-0">

                             <div class="section-head">

                                 <h2 class="mb-3 ff">Conservation Efforts Save the Tiger!</h2>

                             </div>

                         </div>

                     </div>

                     <p style="text-align:justify;">Ranthambore Tiger Reserve has been one of the most punctual activities in India for tiger preservation. It is part of Project Tiger, a national undertaking for conserving the Bengal tiger population. Various steps have been taken at different times to safeguard the park's environment and wildlife, making Ranthambore a successful conservation case.</p>

                </div>

                <!-- <p style="text-align:justify;">Ranthambore Tiger Reserves in India is one of the renowned and well-known tiger lands. It is the only one and the biggest national park in the India, not only in India its world’s biggest National Park with numerous types of species, flora, and fauna. The Ranthambore Tiger Reserve Rajasthan got its name from the Ranthambore fort which is in the middle of the jungle. This fort witnessed the major history and changes of this park. Before independence, there was extensive forest cover on the Indian subcontinent. But with the increasing population and industrialization, the forest was badly exploited. And with the shrinking forest, the wildlife of the country also started shortening. This became a source of concern for the nation resulting in strict rules and policies for Ranthambore Park. Ranthambore Tiger Reserve Rajasthan was previously privately owned by the Maharajas of Jaipur. -->

                <!-- </p><br> -->

                <!-- <p style="text-align:justify;">Until the year 1955, it was an exclusive and popular hunting ground of Jaipur’s Royal family. And after that, it was declared the “Sawai Madhopur Sanctuary,” a wildlife sanctuary and national park in India. But due to a constant fall in the numbers of tigers, in the year 1973, the sanctuary was declared under the Project Tiger to protect the tigers. More strict policies and rules were formulated to make Project Tiger a success. And then the major rule came in the year 1980 when 282.03 sq. Km of this sanctuary was declared a national park, known as Ranthambore National Park, Rajasthan. After this, the collection of forest produce by the government was reduced. And then in 1983, an adjacent north side of the land was named Kela Devi Sanctuary. Similarly, 130 sq km in 1984 was declared Sawai Mansingh Sanctuary.</p> -->

            </div>



        </div>

        </div>

    </div>

</div>



<div class="guide-wrapper mt-50">

<div class="container">

<div class="row">

    <div class="col-lg-12 col-md-12 col-sm-12">

        <div class="section-head">

            <!--<h2 class="mb-2 h5_stl">The Tigers of Ranthambore</h2>-->

            <!--<h2 class="mb-3">Stories of the Wild</h2>-->

            <h2 class="mb-3">The Tigers of Ranthambore: Stories of the Wild</h2>

        </div>

    </div>

</div>

<div class="row col-12 mx-auto">



<div class="blog-qoute mb-3">

<p class="">

 

    Each tiger in Ranthambore Park, India, comes with a story and a legacy that forms the mystery of this park. We shall go through some of the most famous tigers of Ranthambore:   

</p>

</div>

@foreach($tigerstory as $tiger)

<div class="col-lg-3 col-md-6 col-sm-6">

<div class="guide-card brd-thm1">

<div class="guide-thumb">

<img src="{{asset('public/tiger/'.$tiger->image)}}" alt="{{$tiger->alt}}" class="img-fluid tiger-story-img" loading="lazy" >

<div class="guide-info" style="height:200px;">

<span style="font-weight:600;">{{$tiger->title}}</span>

<ul class="guide-links">

<li>

<a href="{{url('tiger-story',['seo_name' => $tiger->seo_name])}}">Read More</a>

</li>

</ul>

</div>

</div>

</div>

</div>

@endforeach

</div>

</div>

</div>








<div class="blog-area pt-5">

<div class="container">

<div class="row col-12 mx-auto">

<div class="col-lg-12 col-md-12 col-sm-12">

<div class="section-head pb-30">

<h2 class="ff">Birds of Ranthambore National Park</h2>

</div>

</div>

</div>

<div class="row col-12 mx-auto">

   <p style="text-align:justify;"><sup><i class="fa fa-quote-left me-1"></i></sup>

   Ranthambore National Park is not only about tigers. It is a land of paradise for bird watchers. More than 300 bird species are in the park, including migratory and resident birds. It is also home to the endangered species of Indian vulture, which is rarely seen and should be on every bird lover's bucket list.

   <sup><i class="fa fa-quote-right ms-1"></i></sup></p>

      

   <p class="my-2"  style="text-align:justify;">

      <strong>Migratory Birds:</strong> During the winters, the Ranthambore National Park becomes a haven for migratory birds. Other species that migrate to the park, along with the Siberian crane and the painted stork, increase its avian population manifold.

  </p>

<p class="my-2" style="text-align:justify;">

     <strong>Resident Birds: </strong> Ranthambore National Park is home to various resident birds, such as the Indian peafowl, parakeets, and kingfishers. These birds are found throughout the year, providing colors and chirping to the park's life.

</p>

<p class="my-2"  style="text-align:justify;">

     <strong>Endangered Species:</strong> This is also a site for the conservation of various endangered species of birds, including that of the Indian vulture. Protecting such species improves the park's biodiversity and makes it an excellent conservation site.

</p>



<!--<div class="row mx-auto col-12 h-100">-->

<!--     <div class="col-lg-3 col-md-4 col-sm-6 col-6 h-100">-->

<!--         <a href="{{route('hotel')}}">-->

<!--           <div class="achievement-card mt-30 h-100">-->

<!--             <div class="portal-card mx-auto" style="background-image: url('{{asset('public/assets/images/hotel.jpg')}}'); background-size:100% 100%; background-position:center;">-->

               <!--background-image apply-->

<!--           </div>-->

<!--           <div class="mt-4">-->

<!--           <h2 class="ff h4_stl">Hotel Booking</h2>-->



<!--           </div>-->

<!--           </div>-->

<!--         </a>-->

<!--     </div>-->

<!--     <div class="col-lg-3 col-md-4 col-sm-6 col-6">-->

         

<!--     </div>-->

<!--     <div class="col-lg-3 col-md-4 col-sm-6 col-6">-->

         

<!--     </div>-->

<!--     <div class="col-lg-3 col-md-4 col-sm-6 col-6">-->

         

<!--     </div>-->

<!--</div>-->



<div class="blog-btn mt-4">

  <a href="{{route('birds')}}" style="float:right;" class="btn-common-sm">Read More</a>

</div>

</div>



</div>

</div>

</div>











<div class="feature-area-2 p-5 mt-120">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="section-head feature-head-2 pb-40">

                    <h2 class="ff">Top Ten Bird Species in Ranthambore</h2>

                </div>

            </div>

        </div>

        <div class="feature-slider-2 owl-carousel">

            <div class="feature-card-2">

                <div class="feature-thumb birds-slider-thumb">

                    <img src="{{asset('public/assets/images/birds/b-1.webp')}}" alt="grey pratridge " class="img-fluid"  loading="lazy">

                </div>

                <div class="feature-details birds-slider-detail">

                    <h2 style="text-align:center;" class="mb-2 ff h3_stl">Grey Partridge</h2>

                    <p class="tour-duration">The Grey Partridge can be found in open grassland areas and is easily identifiable by its red-brown head and neck.</p>

                </div>

            </div>

            <div class="feature-card-2">

                <div class="feature-thumb birds-slider-thumb">

                    <img src="{{asset('public/assets/images/birds/b-2.webp')}}" alt="indian peafowl" class="img-fluid"  loading="lazy">

                </div>

                <div class="feature-details birds-slider-detail" >

                <h2 style="text-align:center;" class="mb-2 ff h3_stl">Indian Peafowl</h2>

                    <p class="tour-duration">This vibrant species is the most recognizable bird in the park. The males have distinctive crests on their heads and fan-shaped tails, while the females are duller brown.</p>

                </div>

            </div>

            <div class="feature-card-2">

                <div class="feature-thumb birds-slider-thumb">

                    <img src="{{asset('public/assets/images/birds/b-3.webp')}}" alt="painted stork" class="img-fluid" loading="lazy">

                </div>

                <div class="feature-details birds-slider-detail" >

                <h2 style="text-align:center;" class="mb-2 ff h3_stl">Painted Stork</h2>

                    <p class="tour-duration">Painted Stork can be seen in wetlands and near water bodies. It has an orange-red bill, a black neck and chest, and white and gray feathers.</p>

                </div>

            </div>

            <div class="feature-card-2">

                <div class="feature-thumb birds-slider-thumb">

                    <img src="{{asset('public/assets/images/birds/b-4.webp')}}" alt="great egret" class="img-fluid" loading="lazy">

                </div>

                <div class="feature-details birds-slider-detail" >

                <h2 style="text-align:center;" class="mb-2 ff h3_stl">Great Egret</h2>

                    <p class="tour-duration">This large white bird is easily identifiable by its size and can be found in wetlands and near water bodies.</p>

                </div>

            </div>

            <div class="feature-card-2">

                <div class="feature-thumb birds-slider-thumb">

                    <img src="{{asset('public/assets/images/birds/b-5.webp')}}" alt="red wattled bird" class="img-fluid" loading="lazy">

                </div>  

                <div class="feature-details birds-slider-detail">

                <h2 style="text-align:center;" class="mb-2 ff h3_stl">Red Wattled Lapwing</h2>

                    <p class="tour-duration">This species has a bright red face and head and a loud call. It can be found in grasslands, scrublands, and near water bodies.</p>

                </div>

            </div>

            <div class="feature-card-2">

                <div class="feature-thumb birds-slider-thumb">

                    <img src="{{asset('public/assets/images/birds/b-6.webp')}}" alt="yellow footed green peigo" class="img-fluid"  loading="lazy">

                </div>

                <div class="feature-details birds-slider-detail">

                <h2 style="text-align:center;" class="mb-2 ff h3_stl">Yellow-Footed Green Pigeon</h2>

                    <p class="tour-duration">This medium-sized bird has a green body and yellow feet. It can be found in open woodlands and gardens.</p>

                </div>

            </div>

            <div class="feature-card-2">

                <div class="feature-thumb birds-slider-thumb">

                    <img src="{{asset('public/assets/images/birds/b-7.webp')}}" alt="indian roller" class="img-fluid" loading="lazy">

                </div>

                <div class="feature-details birds-slider-detail" >

                <h2 style="text-align:center;" class="mb-2 ff h3_stl">Indian Roller</h2>

                    <p class="tour-duration">This species is easily identifiable by its blue and white plumage. It can be seen in open grasslands and near water bodies.</p>

                </div>

            </div>

            <div class="feature-card-2">

                <div class="feature-thumb birds-slider-thumb">

                    <img src="{{asset('public/assets/images/birds/b-8.webp')}}" alt="white browed fantail" class="img-fluid" loading="lazy">

                </div>

                <div class="feature-details birds-slider-detail" >

                <h2 style="text-align:center;" class="mb-2 ff h3_stl">White-Browed Fantail</h2>

                    <p class="tour-duration">This species has distinctive white eyebrows and a long tail. It can be found in open woodlands and gardens.</p>

                </div>

            </div>

            <div class="feature-card-2">

                <div class="feature-thumb birds-slider-thumb">

                    <img src="{{asset('public/assets/images/birds/b-9.webp')}}" alt="indian grey hornbill" class="img-fluid"  loading="lazy">

                </div>

                <div class="feature-details birds-slider-detail" >

                <h2 style="text-align:center;" class="mb-2 ff h3_stl">Indian Grey Hornbill</h2>

                    <p class="tour-duration">This species has a large bill and is easily recognizable by its black and grey plumage. It can be found in open woodlands and gardens.</p>

                </div>

            </div>

            <div class="feature-card-2">

                <div class="feature-thumb birds-slider-thumb">

                    <img src="{{asset('public/assets/images/birds/b-10.webp')}}" alt="asian palm swift" class="img-fluid"  loading="lazy">

                </div>

                <div class="feature-details birds-slider-detail">

                <h2 style="text-align:center;" class="mb-2 ff h3_stl">Asian Palm Swift</h2>

                    <p class="tour-duration">This small bird has a distinctive black face and white throat. It can be found in open woodlands and gardens. Ranthambore is a beautiful place to watch birds in their natural habitat. These are just some of the species found in the park.</p>

                </div>

            </div>

        </div>

    </div>

</div>



@if(count($news) > 0)

<div class="blog-area pt-5">

<div class="container">

<div class="row col-12 mx-auto">

<div class="col-lg-12 col-md-12 col-sm-12">

<div class="section-head pb-30">

<!--<h2 class="h5_stl"></h2>-->

<h2 class="ff">Latest Blogs</h2>

</div>

</div>

</div>

<div class="row col-12 mx-auto">

@foreach($news as $item)

    <div class="col-lg-4 col-md-6 col-sm-6 mt-2 wow fadeInLeft animated" data-wow-duration="1500ms" data-wow-delay="0ms">

        <div class="blog-card card border-0 h-100 mt-0">

            <div class="card-body px-3 pb-0">

            <div class="blog-img">

                <a href="{{route('blog',$item->seo_name)}}"><img src="{{asset('public/'.$item->image)}}" alt="{{$item->alt}}" class="img-fluid" style="height:15rem;" loading="lazy"></a>
                
            </div>

            <div class="blog-details p-0 py-3">

                <a href="{{route('blog',$item->seo_name)}}"><h2 class="blog-title my-auto h5_stl" style="font-size: 18px; font-weight: 600; line-height: 1.5;">{{$item->title}}</h2></a>
                <!-- <h2 class="blog-title my-auto h5_stl lh-lg">Posted on : @if($item->date != ''){{date('d/m/Y', strtotime($item->date))}}@endif</h2> -->
                <p class="mb-0" style="font-size: 14px;"><span style="font-weight:600; color:#000;"><i class="fa fa-user" aria-hidden="true"></i> By Admin</span> on @if($item->date != ''){{date('d/m/Y', strtotime($item->date))}}@endif</p>

            </div>

            </div>

            <div class="card-footer bg-white">

                <div class="blog-btn">

                    <a href="{{route('blog',$item->seo_name)}}" class="btn-common-sm">Read More</a>

                </div>

            </div>

        </div>

    </div>

@endforeach

</div>

</div>

</div>

</div>

@endif



<div class="about-wrapper mt-50 mb-5">

    <div class="container">

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="section-head">

                    <!--<h2 class="mb-2 h5_stl">FAQs About Ranthambore National Park</h2>-->

                    <h2 class="mb-5">FAQs About Ranthambore National Park</h2>

                </div>

            </div>

        </div>

        <div class="accordion" id="accordionExample">

        <div class="row   col-12 mx-auto mb-2 wow fadeInUp" data-wow-delay="0.1s">

        <div class="col-lg-6 col-md-6 col-sm-12 ">

            <div class="accordion-item">

                <h2 class="accordion-header" id="headingOne">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">

                    Q. What should I prefer for transportation in Ranthambore?

                </button>

                </h2>

                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">

                    <div class="accordion-body">

                    The best mode of transport within Ranthambore National Park is either a canter or a gypsy. While the former is a big vehicle that can fit more people, the latter is much smaller and offers a more intimate feel.

                    </div>

                </div>

            </div>

  

            <div class="accordion-item">

                <h2 class="accordion-header" id="headingseven">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">

                    Q. How much does a safari in Ranthambore National Park cost?

                </button>

                </h2>

                <div id="collapseseven" class="accordion-collapse collapse" aria-labelledby="headingseven" data-bs-parent="#accordionExample">

                    <div class="accordion-body">

                     Tiger Safari Ranthambore costs about INR 1,400-3,700 per person. However, it again depends upon the choice of vehicle and zone. Hence, booking your safaris well in advance is always advisable, especially in peak seasons.

                    </div>

                </div>

            </div>

            <div class="accordion-item">

                <h2 class="accordion-header" id="headingeight">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight">

                    Q. Can we cancel our ride once the safari is booked?

                </button>

                </h2>

                <div id="collapseeight" class="accordion-collapse collapse" aria-labelledby="headingeight" data-bs-parent="#accordionExample">

                    <div class="accordion-body">

                    Canceling the Ranthambore National Park safari is possible, but policies differ. You must check it when booking because cancellation charges could be levied on you.

                    </div>

                </div>

            </div>

            <div class="accordion-item">

                <h2 class="accordion-header" id="headingfive">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">

                    Q. What documents and details are required for booking?

                </button>

                </h2>

                <div id="collapsefive" class="accordion-collapse collapse" aria-labelledby="headingfive" data-bs-parent="#accordionExample">

                    <div class="accordion-body">

                    Booking a safari in Ranthambore National Park requires valid proof of identity, such as an Aadhaar card, passport, driving license, etc. Also, mention the details of all travelers correctly at the time of booking.

                    </div>

                </div>

            </div>

      

        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">

        <div class="accordion" id="accordionExample">

            <div class="accordion-item">

                <h2 class="accordion-header" id="headingsix">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix" aria-expanded="false" aria-controls="collapsesix">

                    Q. Do people spot tigers in Ranthambore National Park?

                </button>

                </h2>

                <div id="collapsesix" class="accordion-collapse collapse" aria-labelledby="headingsix" data-bs-parent="#accordionExample">

                    <div class="accordion-body">

                       While Ranthambore National Park is famous for its tigers, the spotting is not assured. The density of tigers in the park is very high, enhancing the chances of seeing them during the morning and evening safaris.

                    </div>

                </div>

            </div>

            

            <div class="accordion-item">

                <h2 class="accordion-header" id="headingnine">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsenine" aria-expanded="false" aria-controls="collapsenine">

                    Q. Which is the best zone in Ranthambore for safari?

                </button>

                </h2>

                <div id="collapsenine" class="accordion-collapse collapse" aria-labelledby="headingnine" data-bs-parent="#accordionExample">

                    <div class="accordion-body">

                      It is further divided into zones within the Ranthambore National Park, which all offer different views. Among them, zones 1-5 offer maximum chances of tiger spotting. Zone 3, in particular, is an eye-catcher with plenty of picturesque lakes and tiger sightings.

                    </div>

                </div>

            </div>

            <div class="accordion-item mb-5">

                <h2 class="accordion-header" id="headingten">

                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseten" aria-expanded="false" aria-controls="collapseten">

                    Q. Can we use private vehicles inside Ranthambore?

                </button>

                </h2>

                <div id="collapseten" class="accordion-collapse collapse" aria-labelledby="headingten" data-bs-parent="#accordionExample">

                    <div class="accordion-body">

                      No, private vehicles are not allowed to move inside Ranthambore National Park. Every tourist must have a certified safari vehicle to drive around the park. The rule serves the dual purpose of preserving the park's wildlife and natural surroundings.

                    </div>

                </div>

            </div>

        </div>

        </div>

    </div>

</div>

</div>



<div class="container py-5">

        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12">

                <div class="section-head feature-head-2 pb-30">

                    <h2 class="ff">Frequently Used Links</h2>

                </div>

            </div>

        </div>

  <div class="col-12 mx-auto row">

    <div class="col-md-6 mt-3">

        <div class="card h-100 impLinkcard">

            <div class="card-header text-center fs-4 fw-bold ff text-white" style="background-color:#A46C21;">ABOUT RANTHAMBHORE</div>

                <div class="card-body">

                    <ul>

                    <li><a href="{{route('tiger_territory')}}" ><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right" ></i>  Territory Of Tigers Of Ranthambore</h2></a></li>

                    <li><a href="{{route('blogs')}}" ><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  Blogs</h2></a></li>

                    <li><a href="{{route('floraandfauna')}}" ><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right" ></i>  Flora and Fauna</h2></a></li>

                    <li><a href="{{route('how_to_plan')}}"><h2 class="shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  How To Plan Ranthambore Tour</h2></a></li>

                    <li><a href="{{route('ranthambore_fort')}}"><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right" ></i>  Ranthambore Fort</h2></a></li>

                    <li><a href="{{route('how_to_reach')}}" ><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  How to reach</h2></a></li>

                    <li><a href="{{route('best_time')}}" ><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  Best time to visit</h2></a></li>

                    <li><a href="{{route('places_to_visit')}}"><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  Why Is Ranthambore Famous</h2></a></li>

                    </ul>

                </div>

            </div>

        </div>

    

    <div class="col-md-6 mt-3">

        <div class="card h-100 impLinkcard " >

            <div class="card-header text-center fs-4 fw-bold ff text-white" style="background-color:#A46C21;">IMPORTANT LINKS</div>

                <div class="card-body">

                   <ul> 

                    <li><a href="{{route('history')}}"><h2 class="shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right" ></i>  Park History</h2></a></li>

                    <li><a href="{{route('animals')}}" ><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  Animals In Ranthambore</h2></a></li>

                    <li><a href="{{route('safari_tips')}}"><h2 class="shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  Safari Tips</h2></a></li>

                    <li><a href="{{route('jungle_safari')}}" ><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  Jungle Safari</h2></a></li>

                    <li><a href="{{route('birds')}}"><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  A Heaven for Birdwatchers</h2></a></li>

                    <li><a href="{{route('best_tiger_zone')}}"><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  Best Safari Zone</h2></a></li>

                    <li><a href="{{route('geographical')}}"><h2 class="shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  Geography About Park</h2></a></li>

                    <li><a href="{{route('tandc')}}"><h2 class=" shadow-sm li-item h4_stl"><i class="bx bxs-chevrons-right"></i>  Terms & Conditions</h2></a></li>

                   </ul>

                </div>

            </div>

        </div>

    </div>

 </div>

 </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- jQuery (required for Toastr) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>

 $(document).ready(function() {

  // Show modal after 5 seconds

  setTimeout(function() {

    $('#ModalForBooking').modal('show');

  }, 8000); // 5000 milliseconds = 5 seconds



  // Append blur background when modal is shown

  $('#ModalForBooking').on('show.bs.modal', function (e) {

    $('body').append('<div class="blur-background"></div>');

  });



  // Remove blur background when modal is hidden

  $('#ModalForBooking').on('hide.bs.modal', function (e) {

    $('.blur-background').remove();

  });



  // Close modal when clicking outside of it

  $(document).on('click', function (e) {

    if (!$(e.target).closest('.modal-content').length && !$(e.target).closest('.btn-primary').length) {

      $('#ModalForBooking').modal('hide');

    }

  });

});

</script>
<script>
$(document).ready(function() {
    $('#modalForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Display success message and reset the form
                toastr.success(response.message);

                setTimeout(function() {
                    location.reload();
                }, 3000); // Adjust the delay as needed (3000 milliseconds = 3 seconds)
                $('.error-message').html(''); // Clear any existing error messages
            },
            error: function(xhr) {
                // Clear existing error messages
                $('.error-message').html('');

                if (xhr.status === 422) {
                    // Display validation errors
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        $('#' + key + 'Error').html(value[0]); // Show error message below the input
                    });
                } else {
                    // Display a general error message
                    alert('An error occurred. Please try again later.');
                }
            }
        });
    });
});
</script>



@endsection