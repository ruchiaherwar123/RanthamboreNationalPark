<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<title>Ranthambore National Park</title>

<!-- Favicon and touch icons -->

<link rel="shortcut icon" href="{{asset('public/assets/new-img/fav-icon.png')}}" type="image/x-icon">

<meta content="width=device-width, initial-scale=1.0" name="viewport"> 

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>

	 <style>

.Invoice-card{

    border: 2px solid #9e6d1c;

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

         <button class="btn  text-white" style="background-color:#508a4f;" onclick="print_this('to_print')"><i class="fa fa-print text-white" aria-hidden="true"></i> Print</button>

        </div>

      </div>

      <div class="col-auto my-3">

        <div>

         <a class="btn text-white" style="background-color:#508a4f;" href="{{route('show_hotel_booking_details')}}" ><i class="fa fa-arrow-left text-white" aria-hidden="true"></i> Back</a>

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

                        <img src="{{asset('public/assets/images/rantham-textNew.webp')}}" alt="Ranthambore national park" loading="lazy">

                   </div>

              </div>

               <div class="col-md-3 col-sm-4 col-3 d-center">

                  <h2 class="voucher-title my-auto">

                      Resort Voucher

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

                        <th colspan="4" class="invc-text-head">Resort Booking Details</th>

                    </tr>

              </thead>

              <tbody>

                    <tr>

                         <td class="invc-text">Hotel:</td>

                         <th class="invc-text">{{ $data->hotel}}</th>

                         <td class="invc-text">Booking ID:</td>

                         <th class="invc-text">{{ $data->id}}</th>

                    </tr>

                    

                    <tr>

                         <td class="invc-text">Traveller's Name:</td>

                         <th class="invc-text">{{ $data->name}}</th>

                         <td class="invc-text">No. of Persons:</td>

                         <th class="invc-text">{{ $data->persons}}</th>

                    </tr>

                     

                    <tr>

                        <td class="invc-text">Check-In Date</td>

                        <th class="invc-text">{{date('d-m-Y', strtotime($data->checkindate))}}</th>

                        <td class="invc-text">Rooms:</td>

                        <th class="invc-text">{{ $data->rooms}}</th>

                    </tr>

                    

                    <tr>

                        <td class="invc-text">Check-Out Date</td>

                        <th class="invc-text">{{date('d-m-Y', strtotime($data->checkoutdate))}}</th>

                        <td class="invc-text">Email:</td>

                        <th class="invc-text">{{ $data->email}}</th>

                    </tr>

                    

                    <tr>

                        <td class="invc-text">Mobile:</td>

                        <th class="invc-text">{{ $data->mobile}}</th>

                        <td class="invc-text">Meal:</td>

                        <th class="invc-text">{{ $data->meal}}</th>

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

                        <td class="invc-text-head">Please pay balance amount of INR {{ $data->duepayment}} at Resort during check in</td>

                    </tr>

                    <tr>

                        <td class="invc-text">

                            <strong> Thanks , {{ $data->name}} Your booking is confirmed. </strong>

                        </td>

                    </tr>

                    

                    <tr>

                        <td class="invc-text">

                           <strong>Hotel Address:</strong> {{ $data->address}}

                        </td>

                    </tr>

                    <tr>

                        <td class="invc-text">

                           <strong>Hotel Contact Number:</strong> {{ $data->hotelnumber}}

                        </td>

                    </tr>

                    <tr>

                        <td class="invc-text">

                           Kindly provide a printed copy of hotel confirmation voucher and submitted at hotel reception.<br>
                           All guests are advised to carry a valid Photo ID proof(PAN card is not valid)

                        </td>

                    </tr>

                    <tr>

                        <td class="invc-text">

                           <strong> Note-</strong> Fulfilment of special request made by the traveller. It can be accepted or denied by the hotel.

                        </td>

                    </tr>

              </tbody>

         </table>

         

         <!--table for kindly note-->

         <table class="table border-none table-sm">

             <thead>

                  <tr>

                      <td class="invc-text-head">Cancellation Policy:</td>

                  </tr>

             </thead>

             <tbody>

                  <tr>

                      <td class="invc-text"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i>  In case you have any postpone or cancelling your tour/travel due to any unavoidable reasons, uh must intimate us in writing.</td>

                  </tr>

                  <tr>

                      <td class="invc-text"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Please make it sure that cancellation charges would be effective from the date we receive your mail in writing. Following cancellation policies should be appreciable:</td>

                  </tr>

                  <tr>

                      <td class="invc-text"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 30 days prior to arrival – 10% of tour cost.</td>

                  </tr>

                  <tr>

                      <td class="invc-text"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 15 days to 29 days prior to arrival – 30% of tour cost.

                  </tr>

                  <tr>

                      <td class="invc-text"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 07 days to 14 days prior to arrival – 40% of tour cost.</td>

                  </tr>
                  <tr>

                      <td class="invc-text"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> 02 days to 06 days prior to arrival – 50% of tour cost.</td>

                  </tr>
                  <tr>

                      <td class="invc-text"> <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Less than 48 hours or no show-NO REFUND</td>

                  </tr>

             </tbody>

             <thead>

                  <tr>

                      <td class="invc-text-head">Hotel Policy:</td>

                  </tr>

             </thead>
             <tbody>
                 <tr>

                      <td class="invc-text">N/A</td>

                  </tr>
             </tbody>

         </table>

         

         <!--table for rules and regulations-->

         <table class="table border-none table-sm mb-1">

             <thead>

                 <tr>

                     <td class="invc-text-head">Seven Safar Tour and Travel Policy:</td>

                 </tr>

             </thead>

             <tbody>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> The agency will not be responsible for any check-in denied by the hotel on the above-said cause.</td>

                  </tr>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> The government rule also states that each guest above the age of 18 staying at the hotel is required to carry a valid Photo ID. The identification proofs accepted: Driving License, Aadhar Card, Voter ID Card, and Passport. If any guest fails to carry a valid ID, he/she will not be allowed to check in to the hotel.</td>

                  </tr>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> PAN cards are not acceptable as an ID proof.</td>     

                  </tr>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Additional charges for adding extra adult child, child food, and other terms not specified in the booking will depend on the hotel.</td>

                  </tr>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> If an extra bed is included with the booking, the folding cot or mattress is provided by the hotel as an additional bed (depending on the hotel choice).</td>

                  </tr>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> All taxes are included in the room tariff. The amount paid for a room doesn't include any optional services and facilities (like service charge, room service, mini bar, snacks, or telephone calls). These will be charged at check-out time by the hotel authority.</td>

                  </tr>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> The hotel reserves its right of admission. The accommodation can be denied to the guest appearing as a couple if proper identification proof is not provided at the time of check-in. The agency will not be responsible for any check-in barred or rejected by the hotel on the previous grounds.</td>

                  </tr>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> The agency cannot process a refund for any such amount.</td>

                  </tr>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> The hotel has the right to deny stay to city locals/city residents. The agency will not be responsible for any check-in denied by the hotel or cancellations on account of the reasons stated above.</td>     

                  </tr>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> For any clarification or query please reach us at info@sevensafar.com</td>

                  </tr>

                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> On Christmas and New Year's Eve compulsory gala dinner charges need to be paid directly at the hotel.</td>

                  </tr>



                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> If any hotel has a mandatory 25th Brunch or 1st January Brunch that has to be paid at the hotel directly.</td>

                  </tr>
                  <tr>

                      <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> If there are any applicable city taxes, they will be payable directly at the hotel. Note that for more information, you must get in touch with the hotel's authorities.</td>

                  </tr>
                    <tr>

                        <td class="invc-text"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Bed Type Option preference only and it is not guaranteed. It is completely based on the availability of the hotel.</td>

                    </tr>

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

	

	



