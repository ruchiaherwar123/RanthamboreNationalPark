@extends('Frontend.Layout.main')

@section('title',$pageTitle)

@section('keywords', $pageKeywords)

@section('description', $pageDescription)

@section('section')

<style>

    .discription-div p img{

        width:100% !important;

    }
    .discription-div img{
        width: 100% !important;
    }
    .discription-div ul {
        padding: 0;
        margin: 0;
        list-style: inside !important;
    }
    h3, h4, h5, h6
    {
        padding: 5px 0px 10px 0px;
    }
    h2 {
        padding: 15px 0px;
    }
    p {
        line-height: 22px;
    }

</style>



<div class="breadcrumb-area breed19">

<div class="container">

<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12">

<div class="breadcrumb-wrap">

<h2>{{$news[0]->title}}</h2>

<ul class="breadcrumb-links">

<li>

<a href="{{url('/')}}">Latest Blogs</a>

<i class="bx bx-chevron-right"></i>

</li>

<li>{{$news[0]->title}}</li>

</ul>

</div>

</div>

</div>

</div>

</div>



<div class="destinations-area mt-5 mb-5">

<div class="container">

<div class="row col-12 ">

<div class="col-lg-9 col-md-9 col-sm-9">

    <section>

        

    

    <img src="{{ asset('public/'.$news[0]->image)}}" style="height:450px; width:100%;" class="mb-3" alt="{{$news[0]->alt}}" loading="lazy">

    <h1 class="mb-3" style="font-weight: 800; font-family: auto;">{{$news[0]->title}}</h1>



   <div class="discription-div">

        <p class="text-justify">{!!$news[0]->description!!}</p>

   </div>

    </section>

</div>







<div class="col-lg-3 col-md-3 col-sm-3 ">

<div class="blog-sidebar">

<div class="sidebar-searchbox card shadow">

<div class="input-group search-box">

<div class="contact-form">

<form action="{{route('submit_contact')}}" method="POST">

  @csrf

  <h5 class="contact-d-head mb-3">Contact Us</h5>

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

  <textarea cols="30" rows="7" name="message" placeholder="Write Message" required></textarea>

  @error('message')

  <span class="text-danger" style="position:absolute;">{{ $message }}</span>

  @enderror

  </div>

  <div class="col-lg-12 mb-2">

  <input type="submit" class="btn-common mt-2" value="Contact Us Now" style="background-color:#034a59; floar:right;">

  </div>

  </div>

</form>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-12 col-md-6 ">

<div class="blog-categorie mt-40 card shadow">

<h5 class="categorie-head" style="color:#ff7f47;">Important Links</h5>

<ul>

<li><a href="{{route('faq')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> FAQ</a></li>

<li><a href="{{route('geographical')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Geography About Park</a></li>

<li><a href="{{route('tandc')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Terms & Conditions</a></li>

<li><a href="{{route('safari_tips')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Safari Tips</a></li>

</ul>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-12 col-md-6 ">

<div class="blog-categorie mt-40 card shadow">

<h5 class="categorie-head" style="color:#ff7f47;">About</h5>

<ul>

<li><a href="{{route('floraandfauna')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Flora And Fauna</a></li>

<li><a href="{{route('onlinesafari')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Jeep Safari</a></li>

<li><a href="{{route('best_tiger_zone')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Best Safari Zone</a></li>

<li><a href="{{route('birds')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Birds Lists</a></li>

<li><a href="{{route('jungle_safari')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Jungle Safari</a></li>

</ul>

</div>

</div>

</div>

<div class="row">

<div class="col-lg-12 col-md-6 ">

<div class="blog-categorie mt-40 card shadow mb-5">

<h5 class="categorie-head" style="color:#ff7f47;">Notices</h5>

<ul>

<li><a href="{{route('how_to_reach')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> How to reach</a></li>

<li><a href="{{route('best_time')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Best time to visit</a></li>

<li><a href="{{route('places_to_visit')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Why Is Ranthambore Famous</a></li>

<li><a href="{{route('history')}}" style="color:#034a59;"><i class="bx bxs-chevrons-right"></i> Park History</a></li>

</ul>

</div>

</div>

</div>

</div>

</div>

</div>

</div>

</div>



@endsection