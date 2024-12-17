@extends('Frontend.Layout.main')

@section('title', 'Ranthambore Fort: Chauhan Dynasty to Tiger Reserve')

@section('keywords', 'Ranthambore Fort, Chauhan Dynasty, Colonial Hunting Grounds, Maharajas of Jaipur, Ranthambore Game Sanctuary, Project Tiger, Tiger Reserve, Conservation Efforts, National Park Status, Wildlife Preservation')

@section('description', 'Ranthambore Fort, Chauhan Dynasty & Project Tiger highlight the conservation efforts & wildlife preservation in this historic tiger reserve and national park.')

@section('section')



<div class="breadcrumb-area breed11">

<div class="container">

<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12">

<div class="breadcrumb-wrap">

<h2>History Of Park</h2>

<ul class="breadcrumb-links">

<li>

<a href="{{url('/')}}">Home</a>

<i class="bx bx-chevron-right"></i>

</li>

<li>History Of Park</li>

</ul>

</div>

</div>

</div>

</div>

</div>



<div class="destinations-area mt-5">

<div class="container">

<div class="row">

<div class="col-lg-12 col-md-12 col-sm-12">

<div class="section-head pb-40">

<h1 class="fw-bold">History of Ranthambore National Park, Rajasthan</h1>

</div>

</div>

</div>

<div class="row col-12 mx-auto">

<div class="col-lg-9 ">

<div class="blog-qoute mb-5 mt-3 " >

<i class="bx bxs-quote-left qoute-icon"></i>

 <strong>Named after the famous Ranthambore Fort located at its heart, Ranthambore forest has a long history dating back to the imperial years. Most of the Indian subcontinent was covered by vast stretches of forest before India's independence. However, with the population increase and the start of industrialization, the country required more resources, which led to massive deforestation all over the nation</strong>

<i class="bx bxs-quote-right qoute-icon"></i>

</div>

<h2 class="mb-3">History of Ranthambore National Park</h2>

<p >Reducing forest cover and wildlife forced the government to take severe steps against this situation. Furthermore, the remaining forests and their inhabitants were protected by declaring them reserve forests and national parks.</p><br>

<p >From the time when the imperial era was about to come to an end in Rajasthan, Ranthambore was a private hunting ground for the royals of the Jaipur Kingdom. The Maharajah of Jaipur owned the forest and had an active hunting department to oversee the place. Villagers on the forest‘s boundaries were allowed to collect forest produce after paying a decent annual tax to the kingdom’s treasury. By then, population density was not very high. Thus, there was minimal human interference in the forest. Even though the forest was a destination for hunting by the Jaipur royalties, as an episodic activity, it did not negatively affect the vast wildlife and ecosystem of the forest.</p><br>

<div class="col-md-10 mx-auto my-3">

    <img src="{{asset('public/assets/images/history_park.webp')}}" alt="Historical overview of Ranthambore National Park" class="img-fluid " style="width:100%;">

</div>

<p >However, by the mid-twentieth century, the intensive exploitation of the forested areas called for urgent conservation policies. For this purpose, the Rajasthan Forest Act was passed in 1953, which provides minimum legal protection to forests in the region. Although it did not stop the process altogether, it could still slow down the rate at which it happened. In 1955, Sawai Madhopur Sanctuary was declared over the forest-covered Ranthambore, meaning no commercial activities were allowed within the boundary. Still, the tigers were facing a threat of extinction and were reducing rapidly.</p><br>

<p >To meet this situation, the Indian government set up the Project Tiger scheme in 1973. A portion of the Sawai Madhopur Sanctuary was declared a tiger reserve and covered 60 square miles.</p><br>

<p  class="mb-5">Since the turn of the century, more than 12 villages have been shifted from this sanctuary, and nearly 282.03 square kilometers have been officially declared a national park. With time, the boundaries of the tiger reserve and the national park expanded to the adjacent forest lands. In 1983, 647 km2 of forest in the north of Ranthambore National Park was declared the Kela Devi Sanctuary and was incorporated into the tiger reserve. Similarly, in 1984, 130 km2 of forest in its south was declared the Sawai Mansingh Sanctuary and incorporated into the reserve. Surprisingly, Project Tiger, which was started in 1973, has increased the number of tigers remarkably. The latest census was held in 2014, and there were nearly 64 tigers at the Ranthambore tiger reserve. However, the current population of tigers in Ranthambore National Park is 70+. The safari experience at the Ranthambore National Park is unparalleled as the Ranthambore is among the finest places in the world where one can see wild tigers in their natural home.</p><br>

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