<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<title>Ranthambore National Park</title>

<!-- Favicon and touch icons -->

<link rel="shortcut icon" href="{{asset('public/assets/images/favicon.png')}}" type="image/x-icon">

<meta content="width=device-width, initial-scale=1.0" name="viewport"> 

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

	 </head>

	 <style>

.Invoice-card{

    border:2px solid #a66d1e;

    border-radius:5px;

    margin-bottom:2rem;

}



.invoice-logo{

    height:6rem;

    padding:15px 30px;

    border:none;

}

.invoice-logo img{

    height:100%;

    width:100%;

    filter:drop-shadow(1px 1px 1px grey);

}

.d-center{

    display:flex;

    align-items:center;

    justify-content:center;

}

.invc-text-b{

    font-weight:700;

    font-size:16px;

}

.invc-text-head{

    font-weight:700;

    font-size:18px;

}



.table thead th,.table thead td,.table tbody th,.table tbody td{

    border-left:1px solid #000000;

    border-right:1px solid #000000;

}

.table thead tr, .table tbody tr{

    border-top:1px solid #000000;

    border-bottom:1px solid #000000;

}

.table.border-none td,.table.border-none td,.table.border-none tr{

    border:none;

}

.stamp-img-card{

    height:8rem;

    width:14rem;

    border:none;

}

.stamp-img-card img{

    height:100%;

    width:100%;

}

.phn-view-contact{

    display:none;

}

.tab-view-contact{

    display:block;

}

@media (max-width:1100px){

  .invoice-logo{

    height:4rem;

    padding:10px 15px;

   }

   .stamp-img-card{

    height:5rem;

    width:8.5rem;

   } 

   .invc-text-b{

    font-size:12px;

   }

   .invc-text-head{

       font-size:13px;

   }

   .invc-text{

      font-size:11px;

   }

}

@media (max-width:580px){

    .invoice-logo{

    height:3rem;

    padding:5px;

   }

    .voucher-title{

        font-size:17px;

    }

   

   .phn-view-contact{

       display:block;

   }

   .tab-view-contact{

       display:none;

   }

   .phn-view-contact p{

     font-size:10px;

     font-weight:600;

     margin-bottom:-2px;

   }  

   .invc-text{

      font-size:10px;

   }

}



@media (max-width:500px){

 .invoice-logo{

    height:2rem;

    padding:5px;

   }  

   .phn-view-contact p{

     font-size:8px;

   }  

   .invc-text{

      font-size:8px;

   }

   .invc-text-b{

    font-size:8px;

   }

   .invc-text-head{

       font-size:9px;

   }

   .voucher-title{

        font-size:12px;

    }

}

@media (max-width:420px){

    .phn-view-contact p{

     font-size:7px;

   }  

}

@media print{

    .Invoice-card{

        margin-top:2rem;

    }

     .invoice-logo{

    height:4rem;

    padding:10px 15px;

   }

   .stamp-img-card{

    height:5rem;

    width:8.5rem;

   } 

   .invc-text-b{

    font-size:12px;

   }

   .invc-text-head{

       font-size:13px;

   }

   .invc-text{

      font-size:11px;

   }

}

</style>

<body>





 <div class="col-12 row mx-auto justify-content-center" >

      

      <div class="col-auto my-3">

        <div>

         <button class="btn  text-white" style="background-color:#a66d1e;" onclick="print_this('to_print')"><i class="fa fa-print text-white" aria-hidden="true"></i> Print</button>

        </div>

      </div>

      <div class="col-auto my-3">

        <div>

         <a class="btn text-white" style="background-color:#a66d1e;" href="{{route('show_safari_details')}}" ><i class="fa fa-arrow-left text-white" aria-hidden="true"></i> Back</a>

        </div>

      </div>

  </div>

<p class="text-danger h5 text-center">Print Voucher in Landscape Mode</p>

<div class="row col-lg-8 col-md-10 col-12 mx-auto" id="to_print">

    <div class="card Invoice-card">

        

        <!--invoice head -->

         <div class="row col-12 mx-auto px-0">

              <div class="col-md-4 col-sm-4 col-4 d-center">

                   <div class="card invoice-logo">

                        <img src="{{asset('public/assets/images/rantham-textNew.webp')}}" alt="ranthambhar national park" loading="lazy">

                   </div>

              </div>

               <div class="col-md-3 col-sm-4 col-3 d-center">

                  <h2 class="voucher-title my-auto">

                      Voucher

                  </h2>

              </div>

               <div class="col-md-4 col-sm-4 col-5 d-center">

                   <div class="tab-view-contact">

                      <span class="invc-text-b">Ranthamborenationalparkonline.net </span><br>

                      <span class="invc-text-b">A Unit of Seven Safar Tours & Travels </span><br>

                      <span class="invc-text-b">+91-7303062162 </span>

                   </div>

                   <div class="phn-view-contact">

                      <p>Ranthamborenationalparkonline.net </p>

                      <p>A Unit of Seven Safar Tours & Travels </p>

                      <p>+91-7303062162 </p>

                   </div>

              </div>

         </div>

         

         <!--tables for booking details 1 -->

         <table class="table w-100 table-sm">

              <thead>

                    <tr>

                        <th colspan="4" class="invc-text-head">Booking Details</th>

                    </tr>

              </thead>

              <tbody>

                    <tr>

                         <td class="invc-text">Park:</td>

                         <th class="invc-text">Ranthambore National Park</th>

                         <td class="invc-text">Booking ID:</td>

                         <th class="invc-text">{{ $data->booking_id}}</th>

                    </tr>

                    

                    <tr>

                         <td class="invc-text">Traveller Name:</td>

                         <th class="invc-text">{{ $data->name}}</th>

                         <td class="invc-text">Mobile No:</td>

                         <th class="invc-text">{{ $data->mobile}}</th>

                    </tr>

                     

                    <tr>

                        <td class="invc-text">Date of Visit:</td>

                        <th class="invc-text">{{date('d-m-Y', strtotime($data->date))}}</th>

                        <td class="invc-text">Zone/Gate:</td>

                        <th class="invc-text">{{ $data->zone}}</th>

                    </tr>

                    

                    <tr>

                        <td class="invc-text">Vehicle:</td>

                        <th class="invc-text">{{ $data->select_jeep}}</th>

                        <td class="invc-text">Total Booked Seat:</td>

                        <th class="invc-text">{{ $data->seats}}</th>

                    </tr>

                    

                    <tr>

                        <td class="invc-text">Shift & Timings:</td>

                        <th class="invc-text">{{ $data->timing}}</th>

                        <td class="invc-text">Guide Fee:</td>

                        <th class="invc-text">Paid</th>

                    </tr>

              </tbody>

         </table>

         

         <!--tables for booking details 2 -->

         <table class="table border-none table-sm">

              <thead>

                    <tr>

                        <td class="invc-text-head">Note:</td>

                    </tr>

              </thead>

              <tbody>

                    <tr>

                        <td class="invc-text-head">Entry Gate Info</td>

                    </tr>

                    <tr>

                        <td class="text-center invc-text">

                            You have selected gate <strong> {{ $data->zone}} in Ranthambore National Park </strong>

                        </td>

                    </tr>

                    <tr>

                        <td class="invc-text-head">{{ $data->select_jeep}} Info</td>

                    </tr>

                    <tr>

                        <td class="text-center invc-text">

                           <strong> A {{ $data->select_jeep}} with the following details has been booked for your visit.</strong>

                        </td>

                    </tr>

                    <tr>

                        <td class="text-center invc-text">

                           Safari Contact Person: <strong> {{ $data->safari_person}} ({{ $data->safari_phone_no}})</strong>

                        </td>

                    </tr>

                    <tr>

                        <td class="text-center invc-text">

                           <strong> Kindly contact {{ $data->safari_person}} ({{ $data->safari_phone_no}}) one day before your safari date between 6.30 pm and 7.30 pm.</strong>

                        </td>

                    </tr>

              </tbody>

         </table>

         

         <!--table for kindly note-->

         <table class="table border-none table-sm">

             <thead>

                  <tr>

                      <td class="invc-text-head">Kindly Note:</td>

                  </tr>

             </thead>

             <tbody>

                  <tr>

                      <td class="invc-text"> <strong>1. Jeep safari bookings are <b>non-transferable, non-cancellable, and non-refundable</b> once the voucher is issued. </strong></td>

                  </tr>

                  <tr>

                      <td class="invc-text">2. Please arrive at the Ranthambore National Park reception to avail of the Jeep safari.</td>

                  </tr>

                  <tr>

                      <td class="invc-text">3. Visitors must show their original ID card at the time of entry.</td>

                  </tr>

                  <tr>

                      <td class="invc-text">4. Private vehicles are not allowed inside the tourism zone. Only registered green-colored gypsys are permitted.

                  </tr>

                  <tr>

                      <td class="invc-text">5. Bookings for day visits during the rainy season <strong>(July 1 to September 30)</strong> are temporary and may be cancelled at short notice due to weather conditions. No refunds will be given if cancelled due to bad weather.</td>

                  </tr>

             </tbody>

         </table>

         

         <!--table for rules and regulations-->

         <table class="table border-none table-sm mb-1">

             <thead>

                 <tr>

                     <td class="invc-text-head">Rules and Regulation:</td>

                 </tr>

             </thead>

             <tbody>

                  <tr>

                      <td class="invc-text">1. All reservations inside the tiger reserve are provisional and subject to change or cancellation without prior notice.</td>

                  </tr>

                  <tr>

                      <td class="invc-text">2. Firearms are not permitted within the Tiger Reserve.</td>

                  </tr>

                  <tr>

                      <td class="invc-text">3. Pets are not allowed inside the Tiger Reserve.</td>     

                  </tr>

                  <tr>

                      <td class="invc-text">4. Walking or trekking is strictly prohibited.</td>

                  </tr>

                  <tr>

                      <td class="invc-text">5. Driving inside the Tiger Reserve after sunset is prohibited.</td>

                  </tr>

                  <tr>

                      <td class="invc-text">6. Visitors must carry a litter bag and bring back non-biodegradable litter.</td>

                  </tr>

                  <tr>

                      <td class="invc-text">7. An official registered guide is compulsory on all excursions.</td>

                  </tr>

                  <tr>

                      <td class="invc-text">8. Playing music within the Tiger Reserve is strictly prohibited.</td>

                  </tr>

                  <tr>

                      <td class="invc-text">9. Blowing horns and driving above the speed limit is strictly prohibited.</td>     

                  </tr>

                  <tr>

                      <td class="invc-text">10. Shouting, teasing, or chasing animals, or attempts to feed them, are prohibited and will incur severe penalties.</td>

                  </tr>

                  <!--   -->

             </tbody>

         </table>

          

          <!--invoice footer -->

          <div class="row col-12 mx-auto px-0 mb-2">

              <div class="col-auto d-center">

                   <div class="card stamp-img-card">

                        <img src="{{asset('public/assets/images/stamp-seven.png')}}" alt="ranthambhar national park" loading="lazy">

                   </div>

              </div>

             

         </div>

         

    </div>

</div>

	 </body>

	 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   <script>

   window.print_this = function(id) {

    var prtContent = document.getElementById(id).innerHTML;

    var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');



    // Append the existing CSS and media query styles

    WinPrint.document.write('<html><head><title>{{ $data->name }}</title>');



    // Import the page's current CSS including the media query

    var styles = document.querySelectorAll('link[rel="stylesheet"], style');

    styles.forEach(function(style) {

        WinPrint.document.write(style.outerHTML);

    });



    // Close head and begin body

    WinPrint.document.write('</head><body>');

    WinPrint.document.write(prtContent);

    WinPrint.document.write('</body></html>');

    WinPrint.document.close();



    // Wait for the document to load, then trigger print

    WinPrint.focus();

    setTimeout(function() {

        WinPrint.print();

        WinPrint.close();

    }, 1000);

};

    </script>

	 </html>

	

	



