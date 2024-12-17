@extends('Frontend.Layout.main')

@section('title', 'Ranthambore National Park Insights: Blogs & News ')

@section('keywords', 'Ranthambore National Park Blog, Ranthambore National Park Wildlife, Ranthambore National Park Safari, Ranthambore National Park Tips, Ranthambore National Park Experiences, Ranthambore National Park Tiger Sightings, Ranthambore National Park Accommodation, Ranthambore National Park History, Ranthambore National Park Best Time to Visit')

@section('description', 'Explore the wild side of the Ranthambore through our expert insights featuring the untold stories, experiences, and blogs of the wilds.')

@section('section')



<div class="breadcrumb-area breed18">

<div class="container">

<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12">

<div class="breadcrumb-wrap">

<h2>Latest Blogs</h2>

<ul class="breadcrumb-links">

<li>

<a href="{{url('/')}}">Home</a>

<i class="bx bx-chevron-right"></i>

</li>

<li>Latest Blogs</li>

</ul>

</div>

</div>

</div>

</div>

</div>



<div class="blog-area">

<div class="container">

<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12 mt-5">

<div class="section-head pb-30">

<h1>Latest Blogs</h1>



</div>

</div>

</div>

<div class="row mb-5">

@foreach($news as $item)

    <div class="col-lg-4 col-md-6 col-sm-6 my-4 wow fadeInLeft animated" data-wow-duration="1500ms" data-wow-delay="0ms">

        <div class="blog-card h-100">

            <div class="blog-img">

                <a href="{{route('blog',$item->seo_name)}}"><img src="{{asset('public/'.$item->image)}}" alt="{{$item->alt}}" loading="lazy" class="img-fluid" style="height:35vh;"></a>

                <!-- <h2 class="blog-title my-auto h5_stl lh-lg">Posted on : @if($item->date != ''){{date('d/m/Y', strtotime($item->date))}}@endif</h2> -->

            </div>

            <div class="blog-details">

                

            <a href="{{route('blog',$item->seo_name)}}"><h2 class="blog-title my-auto h5_stl" style="font-size: 18px; font-weight: 600; line-height: 1.5;">{{$item->title}}</h2></a>
            <p class="mb-0" style="font-size: 14px;"><span style="font-weight:600; color:#000;"><i class="fa fa-user" aria-hidden="true"></i> By Admin</span> on @if($item->date != ''){{date('d/m/Y', strtotime($item->date))}}@endif</p>

            <div class="blog-btn mt-2">

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





@endsection