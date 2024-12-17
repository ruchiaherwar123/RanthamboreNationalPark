@extends('Frontend.Layout.main')

@section('title', 'Ranthambore Safari Booking | Best Time, Jeep & Online')

@section('keywords', 'ranthambore tiger reserve safari booking, ranthambore national park best time to visit, jeep safari in ranthambore, online safari booking in ranthambore, safari booking for ranthambore, safari in ranthambore national park, ranthambore national park safari booking, ranthambore national park online safari booking,, delhi to ranthambore national park, distance from delhi to ranthambore national park, national parks near delhi')

@section('description', 'Book Ranthambore Tiger Reserve Safari: Jeep Safari, Online Booking, & Best Time to Visit. Explore Delhi to Ranthambore National Park Distance & Route.')

@section('section')

<style>

    

    

#calendar {

  width: 100%;

  max-width: 600px;

  border: 1px solid #ddd;

  border-radius: 8px;

  background-color: #fff;

  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

  margin: 10px auto;

  overflow:hidden;

}



#header {

  display: flex;

  justify-content: space-between;

  align-items: center;

  padding:2px 10px;

  background-color: #9f6c18;

  color: #fff;

}



#header button {

  /* background: none; */

  border:1px solid #fff;

  /* height: 35px; */

  font-size: 15px;

  display: flex;

  align-items: center;

  justify-content: center;

  line-height: normal;

  cursor: pointer;

  padding:8px 10px;

  background-color: #fff;

   border-radius:5px; 

}

#header button i{

  color: #9f6c18;

  margin-left:0px;

}

/*#header button:hover i{*/

/*  color:#fff;*/

/*}*/

#header button:hover{

  border:1px solid #fff;

  background:#ece3d5;

}

#header h2 {

  margin: 0;

  color:#fff;

  font-size: 18px;

}



#daysOfWeek {

  display: flex;

  background-color: #f0f0f0;

  padding: 5px;

  border-bottom: 1px solid #ddd;

}



#daysOfWeek div {

  width: 14.28%;

  text-align: center;

  font-weight: bold;

}



#days {

  display: flex;

  flex-wrap: wrap;

  padding: 10px;

}



#days div {

  width: 14.28%;

  text-align: center;

  padding: 10px;

  cursor: pointer;

  box-sizing: border-box;

  transition: background-color 0.3s, color 0.3s;

}



#days div:hover {

  background-color: #9f6c18;

  color: #fff;

}



.current-day {

  background-color: #9f6c18;

  color: #fff;

  border-radius: 50%;

}



.disabled {

  color: #ccc;

  cursor: not-allowed;

}

#days div {

    width: 14.28%;

    text-align: center;

    /* padding: 10px; */

    padding: 4px;

    cursor: pointer;

    box-sizing: border-box;

    transition: background-color 0.3s, color 0.3s, border 0.3s;

    border: 1px solid #9f6c18;

}



#days div:hover {

    background-color: #9f6c18;

    color: #fff;

}



.current-day {

    background-color: #9f6c18;

    color: #fff;

    border-radius: 50%;

}



.disabled {

    color: #383838;

    cursor: not-allowed;

    opacity: 0.5;

}



.available {

    background-color:#ece3d5;

    color: #9f6c18;

}



.unavailable {

    color: #ccc;

}



.selected {

    background-color: #9f6c18;

    color: #fff;

    border: 2px solid ;

}



input[type=text], input[type=email], input[type=date], input[type=number], input[type=tel]{

    height:40px;

    padding:5px 10px;

    border:1px solid lightgrey;

}

select{

    height:40px;

}

</style>

@if (session('msg'))

    <div class="alert alert-warning alert-dismissible fade show" role="alert">

  {{ session('msg') }}

  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

  </div>

@endif 



<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

 <meta name='robots' content='index, follow,'/>



<div class="package-details-wrapper ">

    <div class="container">

        <div class="row">

            <div class="col-lg-7 mt-5">

            <div class="package-d-sidebar h-100">

                <div class="card rounded rate-card h-100 p-3  mb-4 brd-thm2" style="background-image: url('public/assets/images/destination/th-2.jpeg');background-size:cover;">

                    <table class="table mb-auto">

                        <thead>

                            <h2 class="text-center h3_stl">Jeep Safari Price & Safari Zones</h2>

                        </thead>

                        <tbody>

                            <tr>

                               <th class="brd-thm2">Price (Indian)</th>

                               <th colspan="3" class="brd-thm2">INR 2000 /- Seat ( Maximum 6 Persons & 2 children (b/w - 1 to 5 years) are allowed in ONE Jeep)</th>

                            </tr>

                            <tr class="">

                              <th class="brd-thm2">Price (Foreigner)</th>

                              <th class="brd-thm2" colspan="3">INR 3700 /- Seat ( Maximum 6 Persons & 2 children (b/w - 0 to 5 years) are allowed in ONE Jeep )</th>

                            </tr>

                            <tr>

                              <th class="brd-thm2">Zones</th>

                              <th class="brd-thm2" colspan="3">1/2/3/4/5/6/7/8/9/10</th>

                            </tr>

                            <tr class="">

                              <th class="brd-thm2">Timings</th>

                              <th class="brd-thm2" colspan="3">Morning 7:00 AM - 10.30 AM | Evening 2:00 PM - 5:30 PM (Safari Timing Varies as Season Changes)</th>

                            </tr>

                            <tr >

                              <th class="brd-thm2">Inclusions</th>

                              <th class="brd-thm2" colspan="3">Permission of Ranthambore, Jeep, Driver, Permit, and Guide Fee & Taxes.* Pick & drop is not included from hotels.</th>

                            </tr>

                        </tbody>

                    </table>

                    <table class="table">

                        <thead>

                            <h2 class="text-center h3_stl">Canter Safari Price & Zone</h2>

                        </thead>

                        <tbody>

                            <tr>

                               <th class="brd-thm2">Price (Indian)</th>

                               <th  class="brd-thm2" colspan="3">INR 1400 / Person ( ONE Canter has 20 Seats )</th>

                            </tr>

                            <tr class="">

                              <th class="brd-thm2">Price (Foreigner)</th>

                              <th class="brd-thm2" colspan="3">INR 2800 / Person ( ONE Canter has 20 Seats )</th>

                            </tr>

                            <tr>

                              <th class="brd-thm2">Zones</th>

                              <th class="brd-thm2" colspan="3">1/2/3/4/5/6/7/8/9/10</th>

                            </tr>

                            <tr class="">

                              <th class="brd-thm2">Timings</th>

                              <th class="brd-thm2"  colspan="3">Morning 7:00 AM to 10.30 AM | Evening 2:00 PM to 5:30 PM</th>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            </div>

            <div class="col-lg-5 d-flex align-items-center mt-5">

                <div class="card  thm-brd" style="background:#f5f3ef;">

                    <form class="form-floating" action="{{route('submit_online_safari_booking')}}" method="POST" id="bookingForm">

                        @csrf

                        <div class="row col-12 mx-auto">

                            <div class="col-md-12">

                                <!-- Calendar at the top of the form -->

                                <div id="calendar">

                                    <div id="header">

                                        <button id="prevYear" type="button"><i class="fa fa-angle-double-left"></i></button>

                                        <button id="prevMonth" type="button"><i class="fa fa-arrow-left"></i></button>

                                        <h2 id="monthYear"></h2>

                                        <button id="nextMonth" type="button"><i class="fa fa-arrow-right"></i></button>

                                        <button id="nextYear" type="button"><i class="fa fa-angle-double-right"></i></button>

                                    </div>

                                    <div id="daysOfWeek">

                                      <div>Sun</div>

                                      <div>Mon</div>

                                      <div>Tue</div>

                                      <div>Wed</div>

                                      <div>Thu</div>

                                      <div>Fri</div>

                                      <div>Sat</div>

                                    </div>

                                    <div id="days"></div>

                                </div>

                            </div>

                            <div class="col-md-6 mt-1">

                                <div class="form-group">

                                    <select class="form-select" name="select_jeep" onchange="updateSeatsOptions()">

                                        <option value="" disabled selected>Select Vehicle</option>

                                        <option value="jeep">Jeep</option>

                                        <option value="canter">Canter</option>

                                    </select>

                                    @error('select_jeep')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror


                                </div>

                            </div>

                            <div class=" col-md-6 mt-1">

                                <div class="form-group">

                                    <select class="form-select"  name="seats">

                                        <option value="" disabled selected>Select Number of Seats</option>

                                    </select>
                                    @error('seats')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-md-6  mt-1">

                                <div class="form-group">

                                    <select class="form-select " name="timing">

                                        <option value="" disabled selected>Select Timing</option>

                                        <option>Morning</option>

                                        <option>Evening</option>

                                    </select>

                                    @error('timing')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                            </div>

                            <input type="hidden" class="form-control" id="dateInput" name="date" placeholder="">

                            <div class="col-lg-6 col-md-6 mt-1">

                                <div class="form-group">

                                    <select class="form-select" name="zone">

                                        <option value="" disabled selected>Select Zone</option>

                                        <option value="1/2/3/4/5/6/7/8/9/10">1/2/3/4/5/6/7/8/9/10</option>

                                    </select>
                                    @error('zone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror

                                </div>

                            </div>

                            <div class=" col-xl-6 mt-2">

                                <div class="form-group">

                                    <input type="number" class="form-control px-3" name="mobile" placeholder="Mobile">

                                </div>
                                @error('mobile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="col-xl-6 mt-2">

                                <div class="form-group">

                                    <input type="text" class="form-control px-3" placeholder="Traveller Name" name="name">

                                </div>

                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="col-xl-12 mt-3">

                                <div class="form-group">

                                    <input type="email" class="form-control px-3" style="background-color:#fff !important;" name="email" placeholder="Email">

                                </div>
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror

                            </div>

                            <div class="col-lg-12 mt-3 mb-3">

                                <button class="btn btn-lg w-100  text-white thm-bg py-1" type="submit">Book Now</button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    function updateSeatsOptions() {

        var selectJeep = document.getElementById("bookingForm").elements["select_jeep"];

        var selectSeats = document.getElementById("bookingForm").elements["seats"];

        selectSeats.innerHTML = "";

        var defaultOption = document.createElement("option");

        defaultOption.value = "";

        defaultOption.text = "Select Number of Seats";

        defaultOption.disabled = true;

        defaultOption.selected = true;

        selectSeats.appendChild(defaultOption);

        if (selectJeep.value === "jeep") {

            for (var i = 1; i <= 6; i++) {

                var option = document.createElement("option");

                option.value = i;

                option.text = i;

                selectSeats.add(option);

            }

        } else if (selectJeep.value === "canter") {

            for (var i = 1; i <= 20; i++) {

                var option = document.createElement("option");

                option.value = i;

                option.text = i;

                selectSeats.add(option);

            }

        }

    }

    updateSeatsOptions();

</script>



<div class="about-wrapper mt-5 mb-4">

    <div class="container">

        <div class="card px-4 py-4 shadow p-3 bg-white brd-thm1 rounded">

        <div class="row">

            <div class="col-lg-12">

              <div class="pb-30">

                <div class="section-head ">

                  <h1 class="mb-3">About Ranthambore Safari</h1>

                </div>

                <p style="text-align:justify;" class="mb-3">Ranthambore National Park is renowned for its majestic Bengal tigers and its rich variety of flora and fauna. Seeing such amazing creatures in their natural habitat at Ranthambore National Park excites the experience of the safari. The Department of Forest handles the safari experience in Ranthambore well to ensure that the visitor has a safe and memorable experience. </p>

                <p style="text-align:justify;" class="">The entire park has been divided into ten safari zones, and each of these zones has individualistic experiences with landscape, flora, and fauna. Your online safari booking in Ranthambore increases the chances of spotting a tiger, especially in zones 1 to 5, which have the highest frequency of tiger sightings. So, make your Ranthambore Tiger Reserve Safari Booking today and get ready to explore one of the most treasured wildlife sanities of India. </p>

              </div>

              

              <div class="pb-30">

                  <div class="section-head ">

                     <h2 class="mb-3">Safaris In Ranthambore National Park</h2>

                   </div>

                   <p style="text-align:justify;" class="mb-3">

                     The most preferred way to tour this park is by Jeep Safari in Ranthambore. On the other hand, the jeep safari is perfect for those who are looking for a more private yet flexible wildlife experience. Jeeps can easily accommodate up to six guests perfectly, which is nice for photographers and wildlife lovers. The small size of the Jeep helps it to drive on small tracks and get you closer to the action with a more personalized safari experience.

                   </p>

                   <ul type="circle">

                    <li class="mb-3" style="text-align:justify; font-weight:500;"><p><i class="fa fa-arrow-right me-2 thm-clr"></i><b>Canter Safari: </b>The canter safari offers good value if you are travelling in a bigger group. The centres are open-air vehicles that have a capacity of 20 passengers. Of course, canter safaris are less private than jeep safaris, but they provide a fine way to roam in the wilderness with friends and family. Canter safaris traverse the same zones as the jeeps, so the chances of spotting wildlife, including tigers, are equally good.</p></li>

                    <li class="mb-3" style="text-align:justify; font-weight:500;"><p><i class="fa fa-arrow-right me-2 thm-clr"></i><b>Jeep Safari: </b>Take an electrifying walk through Ranthambore National Park in an open Jeep. This 6-seater road vehicle is especially suited for wildlife safaris. It is the most popular and enjoyable sit-in Jeep Safari Tours in Ranthambore because here you will travel in an open-roofed vehicle with a comfortable position for better viewing of the surroundings with a professional driver as well as a guide. Ride deep inside the jungles and grasslands in search of big cats like tigers, leopards, and sloth bears, as well as many species of birds and reptiles.</p></li>

                   </ul>

              </div>

            </div>

        </div>

        </div>

    </div>

</div>



<div class="about-wrapper mt-5 mb-4">

   <div class="container">

      <div class="card px-4 py-4 bg-white brd-thm1 rounded">

          <div class="row px-0">

              <div class="col-lg-12">

                 <div class="section-head">

                    <h2 class="mb-3">Online Safari Booking In Ranthambore</h2>

                 </div>

                 <p style="text-align:justify;" class="mb-3">

                    Planning your Ranthambore Tiger Reserve Safari Booking was never easy, with the online safari booking facility in Ranthambore. This service assists you in booking your safari in advance so that you can confirm a seat in your desired zone. You would find the online booking facility quite user-friendly, and it displays complete information related to the kind of safaris available, their times, and the zones. It is recommended that the safari booking for Ranthambore is made at the earliest instance, depending on the season, because in peak season, the spots fill up quite quickly.
                 </p>

                 

                 <p>Safari in Ranthambore National Park is of two kinds, namely morning and afternoon. The time for the same can vary from season to season.</p>

                 

                <div class="section-head mt-3">

                  <h2 class="mb-3">Important Tips for Safari</h2>

                </div>

                    <ul type="circle" class="ms-0 ps-0">

                      <li class="mb-3" style="text-align:justify; font-weight:500;"><p><i class="fa fa-arrow-right me-2 thm-clr"></i><span class="fs-5"><strong>Advanced booking : </strong></span> Booking Ranthambore National Park Safari in advance is recommended since the park is visited by many, particularly during the peak season, and the safaris become booked up in no time. The safari booking in Ranthambore is now much more convenient and hassle-free.</p></li>

                      <li class="mb-3" style="text-align:justify; font-weight:500;"><p><i class="fa fa-arrow-right me-2 thm-clr"></i><span class="fs-5"><strong>Best Time to Visit : </strong></span>The months from October to June are the best time to visit Ranthambore National Park. During these seasons, the weather becomes more pleasant and friendly, with a higher possibility of glimpsing tigers and other wilds. Make sure not to plan during the rainy season. The park remains closed from July to September.</p></li>

                      <li class="mb-3" style="text-align:justify; font-weight:500;"><p><i class="fa fa-arrow-right me-2 thm-clr"></i><span class="fs-5"><strong>Follow the Directives : </strong></span> The Forest Department has laid down certain rules and principles for wildlife conservation in the park and safe viewing of it by visitors. The directives from them must be maintained while on safari. For example, never get out of the vehicle during the safari, avoid loud noises, and never feed the animals.</p></li>

                      <li class="mb-3" style="text-align:justify; font-weight:500;"><p><i class="fa fa-arrow-right me-2 thm-clr"></i><span class="fs-5"><strong>Respect the Wildlife : </strong></span> After all, Ranthambore is a home for wild animals, and they have to be treated in a dignified manner. The vehicles are not supposed to go too close to the animals, and none of the activities would disturb them. After all, it's their country, and you are just a guest, so be a responsible one.</p></li>

                    </ul>

              </div>

          </div>

      </div>

   </div>

</div>





<div class="about-wrapper mt-5 mb-5">

  <div class="container">

    

    <div class="row">

      <div class="col-xl-8 mt-3 ">

       

        <div class="card py-4 p-3   brd-thm1 rounded">

          <h2 class="mb-3" style="color:#A46C21;">Ranthambore Safari Timings :</h2>

          <table class="table">

            <thead>

              <tr style="background-color:#A46C21;">

                <th class="text-white">Safari Months</th>

                <th class="text-white">Ranthambore Safari Timings</th>

              </tr>

            </thead>

            <tbody>

              <tr>

                 <td class="brd-thm1">From 1st Oct to 31st Oct</td>

                 <td class="brd-thm1">06.30 AM- 10.00 AM & 02.30 PM- 06.00 PM</td>

              </tr>

              <tr>

                <td class="brd-thm1">From 1st Nov to 31st Jan</td>

                <td class="brd-thm1">07.00 AM- 10.30 AM & 02.00 PMto 05.30 PM</td>

              </tr>

              <tr>

                <td class="brd-thm1">From 1st Feb to 31st march</td>

                <td class="brd-thm1">06.30 AM- 10.00 AM & 02.30 PMto 06.00 PM</td>

              </tr>

              <tr>

                <td class="brd-thm1">From 1st April to 15th May</td>

                <td class="brd-thm1">06.00 AM- 09.30 AM & 03.00 PMto 06.30 PM</td>

              </tr>

              <tr>

                <td class="brd-thm1">From 16th May to 30th June</td>

                <td class="brd-thm1">06.00 AM- 09.30 AM & 03.30 PMto 07.00 PM</td>

              </tr>

            </tbody>

          </table>

        </div>



        <div class="card brd-thm1 mt-4 ">

          <div class="card-body">

              <div class="section-head">

                 <h2 class="mb-3">Delhi to Ranthambore National Park</h2>

              </div>

               <div class="">

                 <p style="text-align:justify;">

                 Those coming from the capital, separate from Delhi and Ranthambore National Park, are around 371.5 kilometers away. It is just one of the prominent National parks near Delhi. You can reach this place by train, car, or flight. First, reach Jaipur airport, which is 175.4 km away from the park and the nearest. Several car rentals are in Jaipur, and we are willing to take you to the nearest town, Sawai Madhopur.


                 </p>

               </div>

          </div>

        </div>

      </div>

      <div class="col-xl-4 d-flex align-items-center mt-3">

      <div class="card   shadow p-3 mb-2 card-bg brd-thm1 rounded">

        <img src="{{asset('public/assets/images/destination/img-2.webp')}}" alt="Mountain deer " loading="lazy" class="img-fluid" > 

      </div>

      </div>



    </div>

  </div>

</div>







<div class="about-wrapper mt-2 mb-5">

    <div class="container">

        <div class="card px-4 py-4  p-3 bg-white brd-thm1 rounded">

        <div class="row">

            <div class="col-lg-12">

                <h2 class="mb-3 text-center" style="color:#A46C21;">Essential Guidelines for Ranthambore Online Safari Booking</h2>

                <p style="text-align:justify;" class="mb-3">Tourists can book their Ranthambore Safari online in advance without any hassle. You must fill out the form on our site, and all the details must be to proceed with Ranthambore Online Safari Booking.</p>

                <ul type="circle">

                    <li class="mb-2" style="text-align:justify;"><p><i class="fa fa-arrow-right thm-clr me-1"></i>  Send all the essential details carefully. You must provide the details of your valid PHOTO ID (PAN card, Voter ID, Aadhar Card, School ID, driving license) and any other government-approved ID for online Safari booking.</p></li>

                    <li class="mb-2" style="text-align:justify;"><p><i class="fa fa-arrow-right thm-clr me-1"></i> You must carry the ID details at entry to the park, as forest officials will check your original Photo identity card, which you mentioned at the time of booking.</p></li>

                    <li class="mb-2" style="text-align:justify;"><p><i class="fa fa-arrow-right thm-clr me-1"></i>  If you are a foreign national, you must mention your valid passport details for Gypsy and Canter Safari booking in Ranthambore National Park.</p></li>

                    <li class="mb-2" style="text-align:justify;"><p><i class="fa fa-arrow-right thm-clr me-1"></i>  You have to mention your Safari date and time carefully. Safaris in Ranthambore are conducted in two shifts – Morning and Evening.</p></li>

                </ul>

            </div>

        </div>

        </div>

    </div>

</div>

<script>

   function getCurrentDate() {

      const today = new Date();

      const year = today.getFullYear();

      let month = today.getMonth() + 1;

      let day = today.getDate();

      month = month < 10 ? `0${month}` : month;

      day = day < 10 ? `0${day}` : day;

      return `${year}-${month}-${day}`;

   }



   document.addEventListener('DOMContentLoaded', function() {

      document.getElementById('dateInput').min = getCurrentDate();

   });

</script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const calendarEl = document.getElementById('calendar');

    const monthYearEl = document.getElementById('monthYear');

    const daysEl = document.getElementById('days');

    const prevMonthBtn = document.getElementById('prevMonth');

    const nextMonthBtn = document.getElementById('nextMonth');

    const prevYearBtn = document.getElementById('prevYear');

    const nextYearBtn = document.getElementById('nextYear');

    const dateInput = document.getElementById('dateInput');



    let currentDate = new Date();



    function renderCalendar() {

        const year = currentDate.getFullYear();

        const month = currentDate.getMonth();



        // Set month and year in header

        monthYearEl.textContent = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;



        // Get the first and last day of the month

        const firstDay = new Date(year, month, 1).getDay();

        const lastDate = new Date(year, month + 1, 0).getDate();



        // Clear previous days

        daysEl.innerHTML = '';



        // Add empty divs for days before the first day of the month

        for (let i = 0; i < firstDay; i++) {

            daysEl.innerHTML += '<div></div>';

        }



        // Add days of the month

        for (let i = 1; i <= lastDate; i++) {

            const dayEl = document.createElement('div');

            const paddedMonth = String(month + 1).padStart(2, '0');

            const paddedDay = String(i).padStart(2, '0');

            const dateValue = `${year}-${paddedMonth}-${paddedDay}`;



            dayEl.textContent = i;

            dayEl.dataset.date = dateValue;



            // Disable past dates and make all future dates available

            if (new Date(dateValue) < new Date().setHours(0, 0, 0, 0)) {

                dayEl.classList.add('disabled');

            } else {

                dayEl.classList.add('available');

                dayEl.addEventListener('click', function () {

                    document.querySelectorAll('#days div').forEach(d => d.classList.remove('selected'));

                    dayEl.classList.add('selected');

                    dateInput.value = dayEl.dataset.date;

                });

            }



            daysEl.appendChild(dayEl);

        }

    }



    prevMonthBtn.addEventListener('click', function () {

        currentDate.setMonth(currentDate.getMonth() - 1);

        renderCalendar();

    });



    nextMonthBtn.addEventListener('click', function () {

        currentDate.setMonth(currentDate.getMonth() + 1);

        renderCalendar();

    });



    prevYearBtn.addEventListener('click', function () {

        currentDate.setFullYear(currentDate.getFullYear() - 1);

        renderCalendar();

    });



    nextYearBtn.addEventListener('click', function () {

        currentDate.setFullYear(currentDate.getFullYear() + 1);

        renderCalendar();

    });



    renderCalendar();

});

</script>

@endsection