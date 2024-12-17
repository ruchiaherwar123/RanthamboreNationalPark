<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Ranthambore National Park</title>
<!-- Favicon and touch icons -->
<link rel="shortcut icon" href="{{asset('public/assets/images/7safarlogo.jpeg')}}" type="image/x-icon">
<meta content="width=device-width, initial-scale=1.0" name="viewport"> 
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	 </head>
	 <style>
   table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
  background-color:white;
  color:black;
  font-size:14px;

}
td {
  border: 2px solid #dddddd;
  text-align: left;
  padding: 7px;
 padding-left:16px;
 
}
</style>
<body onload="window.print()">
<div><a class="btn btn-sm mb-2" style="float:right; background-color:#034a59;" href="{{url('/')}}" ><i class="fa fa-arrow-left text-white" aria-hidden="true"></i></a></div>
<div class="container-xxl ">
<div class="container card pt-4" style="border: 1px solid green;">
<div class="row">
<div class="col-lg-5 col-md-5 col-sm-4 col-4">
<img src="{{asset('public/assets/images/7safarlogo.jpeg')}}" style="height:18vh; width:18vh;">
</div>
<div class="col-lg-3 col-md-3 col-sm-4 col-4">
<p style="font-weight:670;font-size:40px;">Voucher</p>
</div>
<div class="col-lg-4 col-md-4 col-sm-4 col-4">
   <h6 class=" ">Ranthamborenationalparkonline.net </h6>
       <h6 class=" ">A Unit of Seven Safar Tours & Travels </h6>
	    <h6 class="  ">+91-9818054830 | 9818055980
</h6>
</div>
</div>


<div class="row"style="border-top: 2px solid gray; border-bottom: 2px solid gray;">
<div class="col-lg-2 col-md-2 col-sm-2 pt-1">
<h5 style="color:#C5C5C5;">Booking Details</h5>
</div>
 <table>
  @if ($data =='')
  <tr>
    <td colspan="5">No data available.</td>
  </tr>
 @else
  @foreach ($data as $d)
  <tr>
    <td> Park:</td>
    <td style="font-weight:600;">Ranthambore National Park	
 </td>

    <td> Payment ID:</td>
	<td style="font-weight:600;">{{ $d->razorpay_payment_id}}</td>
  </tr>
  
  <tr>
    <td > Traveller Name:</td>
    <td style="font-weight:600;">{{ $d->name}}</td>
    <td> Mobile No:</td>
	<td style="font-weight:600;">{{ $d->mobile}}</td>
  </tr>
  
    <tr>
    <td > Date of Visit:</td>
    <td style="font-weight:600;">{{ $d->date}}</td>
    <td> Total Booked Seat:</td>
	<td style="font-weight:600;">{{ $d->seats}}</td>
  </tr>
   <tr>
    <td > Shift & Timings:</td>
    <td style="font-weight:600;">{{ $d->timing}}</td>
    <td> Guide Fee:</td>
	<td style="font-weight:600;">Paid</td>
  </tr>
</table>
</div>
<div class="container-fluid">
<div class="text-left">
<h6 style="font-weight:800;"class="mt-3">Note:</h6>
<h5 style="color:#C5C5C5" class="mt-3">Entry Gate Info</h5>
</div>
<p class="text-center" style="font-size:15px;color:black;">You have selected Jeep Type {{ $d->select_jeep}} in Ranthambore National Park.</p>

@endforeach
@endif
<div class="text-left">
<h5 style="color:#C5C5C5;">Gypsy Info</h5>
</div>
<p class="text-center" style="font-size:15px;color:black;font-weight:670;">A Gypsy with following details has been booked for your visit</p>
<p class="text-center" style="font-size:15px;color:black;font-weight:500;">Safari Contact Person:<span style="font-weight:700;">Mr.Alan ( 7999620736 )</span> </p>
<p class="text-center" style="font-size:15px;color:black;font-weight:670;">Kindly contact to Mr.Alan ( 7999620736 ) one day prior of your safari date between 6.30pm to 7.30pm
</p>
<div class="text-left">
<h5 style="color:#C5C5C5;">Kindly Note</h5>
</div>


<p style="font-size:15px;color:black;"> ⦁ Jeep safari is not transferable, non cancellable and non refundable once voucher issued.</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ You have to reach Ranthambore national park reception to avail the jeep safari</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ Visitor Will have to compulsory show their original Id card at the time of Enrty. Guidee fee and other discrepancy in payment, due to any reason have to sorted out before entering the park.</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ No private vehicle would be allowed inside the tourism zone. Visitors are allowed to go in registered vehicle only Green color Gypsy.</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ Any booking for day visit to Ranthambore during rainy season (1st June to 14th Nov.) is provisional and can be cancelled at a short notice depending on the weather condition, to ensure visitor`s safety. Hence all such bookings during this period are</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> done at visitor`s risk and no refund can be claimed if it is cancelled due to bad weather conditions.</p>

<div class="text-left pt-2 pb-2">
<h5 style="color:#C5C5C5;">Rules and Regulations</h5>
</div>


<p style="font-size:15px;color:black;">⦁ All reservations inside the tiger reserve are provisional and can be changed or cancelled without prior information</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ Carrying of firearms of any kind is not permitted within the Tiger Reserve.</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ No pets can be taken inside the Tiger Reserve. </p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ Walking or trekking is strictly prohibited.</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ Driving inside the Tiger Reserve after sunset is prohibited.</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ Visitors are required to carry a litter bag while entering the Tiger Reserve and bring back their non-biodegradable litter (tin cans, plastic, glass bottles, metal foils etc.) outside the Reserve. Throwing litter inside the Tiger Reserve other than in garbage bins will invite severe penalties.</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ Official registered guide is compulsory on all excursions.</p>
<p style="font-size:15px;color:black;margin-top:-10px;"> ⦁ Playing of any kind of music within the Tiger Reserve is strictly prohibited. </p>
<p style="font-size:15px;color:black;margin-top:-10px;font-weight:670;"> ⦁	In the package jeep is on sharing basis, if 6 persons in a jeep is not filled up then you have to pay full charges for the vehicle and the guide at the time of entry inside the park. The charges will be equally distributed among the tourist present in the jeep.
</p>
</div>




</div>
</div>

  
	 </body>
	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	
	 </html>
	
	

