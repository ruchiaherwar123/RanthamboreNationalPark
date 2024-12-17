@extends('Frontend.Layout.main')
@section('title', 'Best Hotels & Resorts in ranthambore |Luxury Hotels')
@section('keywords', 'ranthambore national park hotels, hotels in Ranthambore, hotels ranthambore national park, ranthambore hotels, ranthambore national park resort, ranthambore national park resort, best hotels in ranthambore, best hotels in ranthambore national park')
@section('description', 'Discover the best hotels and resorts in Ranthambore National Park. Stay at top Ranthambore hotels and enjoy luxury accommodations near the wildlife sanctuary.')
@section('section')

<div class="package-area mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="section-head pb-2">
                    <h1 class="fw-bold">Ranthambore National Park Hotels</h1>
                </div>
            </div>
        </div>
        <div>
            <p style="text-align:justify;" class="mb-3">Our handpicked selection of Ranthambore National Park hotels combines comfort with the wild beauty of nature. Located right in the very heart of Rajasthan, these are places where luxury and adventure bond together, the perfect way to set up a base for your exploration of Ranthambore National Park. 
                From an exciting tiger safari to emotive scenic landscapes, you will experience everything from super-luxurious resorts to reasonably priced budget stays right at the doorstep of the entrance to the park. Each of these hotels in Ranthambore will make you live close to nature with breathtaking views of the surroundings, ultra-modern facilities,
                 and warm hospitality that showcases the rich culture of Rajasthan. After a day of wildlife adventure, cozy up in your retreat of choice at the end of the day; remember that the best from Ranthambore is right outside the door. </p>
            <p style="text-align:justify;" class="mb-2"> Book today- Hotels, Ranthambore National Park- to get the best that is in store.</p>
        </div>
        <div class="row mb-5">
            @foreach($hotel as $item)
            <div class="col-lg-4 col-md-6 col-sm-6 mt-4">
                <div class="package-card h-100 brd-thm1 ">
                    <div class="package-thumb">
                        @php 
                        $image=json_decode($item->image);
                        $alt=json_decode($item->alt);
                        @endphp
                        <a href="{{url('hotels/'. $item->seo_name)}}">
                            <img src="{{ asset('public/hotelimage/'.$image[0])}}" style="height:18rem" alt="@if($alt){{$alt[0]}}@endif" loading="lazy">
                        </a>
                    </div>
                    <div class="package-details">
                        <div class="package-info">
                            <h2 class="h4_stl" style="color:#63743d;"><span>₹ {{$item->price}}</span>/Per Night</h2>
                        </div>
                            <h2 class="h3_stl"><i class="flaticon-arrival"></i>
                            <a style="color:#A46C21;" href="{{url('hotels/'. $item->seo_name)}}">{{$item->name}}</a>
                            </h2>
                        <div class="package-rating">
                        @for($i=1;$i<=$item->rating;$i++)
                            <span> <i class="fa fa-star text-primaryy fa-sm"></i></span>
                        @endfor
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Check for session flash messages
    @if (session('success'))
        Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then(() => {
            {{ Session::forget('success') }}  // Clear the message
        });
    
    @endif
</script>
@endsection