@extends('Frontend.Layout.main')
@section('section')
<div class="breadcrumb-area breed23">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="breadcrumb-wrap">
                    <h2>Online Safari Booking</h2>
                    <ul class="breadcrumb-links">
                    <li>
                    <a href="{{url('/')}}">Services</a>
                    <i class="bx bx-chevron-right"></i>
                    </li>
                    <li>Online Safari Booking</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-xxl py-3 my-4">
<h1 class="display-6 mb-4 ff"> Traveller's Details </h1>
<form action="{{route('submit_online_safari_booking')}}" method="POST" id="bookingform">
    <input type="hidden" class="form-control mb-3" name="test" value="test">
    <input type="hidden" class="form-control mb-3" name="price1" id="price1" >
<div class="card p-2 card-bg  brd-thm2 pb-3">
@for($i=1; $i<=$seats; $i++)
<section class="mt-2">
 <div class="container-fluid px-0">
     <div class="row col-12 mx-auto">
         <div class="col-lg-1 col-md-1 col-sm-12 ">
           <div class="justify-content-between">
              <div><h2 class="h3_stl" style="white-space:nowrap; color: #000;"><i class="fa fa-user me-2"></i>Adult:</h2></div>
           </div>
         </div>
         <div class="col-lg-2 col-md-5 col-sm-6 col-12">
            <input type="text" class="form-control mb-3" name="name[]" placeholder="Enter Name" required>
          </div>
         <div class="col-lg-2 col-md-6 col-sm-6 col-12">
            <input type="text" class="form-control mb-3" name="fname[]" placeholder="Father /Husband Name" required>
         </div>
         <div class="col-lg-1 col-md-4 col-sm-5 col-6"> 
            <select name="gender[]"  class="form-select mb-3" id="" required>
                <option value="">Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
         </div>
         <div class="col-lg-1 col-md-4 col-sm-3 col-6">
            <input type="number" class="form-control mb-3" name="age[]" placeholder="Age" required>
         </div>
         <div class="col-lg-1 col-md-4 col-sm-4 col-6">
            <select class="form-select mb-3" id="nationality" name="nationality[]" required>
                <option value="" disabled selected>Nationality</option>    
                <option value="indian">Indian</option>
                <option value="foreigner">Foreigner</option>
            </select>
         </div>
         <div class="col-lg-2 col-md-4 col-sm-3 col-12">
            <select name="id_type[]"  class="form-select mb-3" id="" required>
                <option value="">ID Type</option>
                <option value="Adhar Card">Adhar Card</option>
                <option value="PAN Card">PAN Card</option>
                <option value="Driving Licence">Driving Licence</option>
                <option value="Voter ID">Voter ID</option>
                <option value="Passport">Passport</option>
                <option value="Other ID">Other ID</option>
            </select>
         </div>
        <div class="col-lg-2 col-md-8 col-sm-9 col-12">
            <input type="text" class="form-control mb-3" name="id_no[]" placeholder="Id Number" required>
        </div>
        @if($formFields['select_jeep']=='jeep')
        <input type="hidden" class="form-control mb-3" name="select_jeep" id="jeeptype" value="jeep" >
        @else
        <input type="hidden" class="form-control mb-3" name="select_jeep" id="jeeptype" value="canter" >
        @endif 
        <input type="hidden" class="form-control mb-3" name="seats" id="seats" value="{{$formFields['seats']}}" >
        <!-- <input type="text" id="tprice"> -->
     </div>
</div>
</section>
@endfor
    <div class="col-12 row ">
       <div class="col-auto ms-auto px-0"> 
       <div class="card card-bg  brd-thm2" style="background-color:#d1e1ba;">
        <div class="card-body table-responsive">
        <table  id="priceBreakdown" class="table  my-auto table-bordered w-100">
            <tr>
                 <th class="px-3">Base Price: </th>
                 <td style="min-width:4rem;" class="px-3 text-end"><span id="baseAmount">--</span></td>
            </tr>
            <tr>
                 <th class="px-3">GST (5%):</th>
                 <td class="px-3 text-end"><span id="gstAmount">--</span></td>
            </tr>
            <tr>
                 <th class="px-3">Gateway Charge (3%):</th>
                 <td class="px-3 text-end"><span id="gatewayCharge">--</span></td>
            </tr>
            <tr>
                 <th class="px-3">Total Amount:</th>
                 <td class="px-3 text-end"><span id="totalAmount">--</span></td>
            </tr>
            <tr>
                <td colspan="2" class="px-3">
                <button class="btn thm-btn2  w-100" id="priceDisplay" >Payable Amount</button>
                </td>
            </tr>
         </table>
       
        
        </div>
       </div>
       </div>
    </div>
</div>
</form>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
   var SITEURL = '{{URL::to('')}}';
   $.ajaxSetup({
     headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
     }
   }); 
   $('#bookingform').on('submit', function(e){
     var totalAmount = $('#price1').val();
     var product_id =  $('#bookingform').serialize();
     var options = {
     "key": "rzp_test_nC5kxY1iKaQcLp",
     "amount": (totalAmount*100),  
     "name": "Ranthambore National Park",
     "description": "Payment",
     "image": "{{asset('assets/img/7safarlogo.jpeg')}}",
       "handler": function (response){  
         window.location.href = SITEURL +'/'+ 'safari_payment?payment_id='+response.razorpay_payment_id+'&formdata='+ product_id;
      },
    "prefill": {
         "contact": '9988665544',
         "email": 'abc@gmail.com',
     },
     "theme": {
         "color": "#528FF0"
     }
   };
   var rzp1 = new Razorpay(options);
   rzp1.open();
   e.preventDefault();
   });
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function(){
        $('#nationality, #jeeptype , #seats').change(function(){
            let nationality = $('#nationality').val();   
            let bookingType = $('#jeeptype').val();
            let seats = $('#seats').val();
           console.log(seats);
            $.ajax({
                url: "{{ url('/get-price') }}",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}",
                    nationality: nationality,
                    jeeptype: bookingType,
                    seats: seats,
                },
                success: function(response){
                    console.log(response);
                    if(response.price && response.price){
                        let totalPrice = response.price * seats;
                        // console.log(totalPrice);

                        $('#priceDisplay').html('Payable Amount: ' + totalPrice);

                        $('#price1').val(totalPrice);

                    } else {

                        $('#priceDisplay').html('Price not available.');

                    }

                },



            });

        });

    });

</script>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        var defaultRazorpayButton = document.querySelector('.razorpay-payment-button');

        if (defaultRazorpayButton) {

            defaultRazorpayButton.style.display = 'none';

        }

    });



    var razorpay = new Razorpay({

    });



    document.getElementById('priceDisplay').addEventListener('click', function () {

        razorpay.open();

    });

</script>



</div>





<div class="container wow fadeInUp" data-wow-delay="0.1s">

    <div class="py-3">

        <div class="row col-12 mx-auto ">

            <div class="col-md-12 wow fadeIn px-0" data-wow-delay="0.3s">

                    <h2 class="display-6 mb-3 ff">Booking Details</h2>

                <div class="card px-3 pt-3 my-3 brd-thm1" >

                    <div style="overflow-x:auto;">

                    <table class="table table-stripped" style="width:100%;">

                        <tbody>

                            <tr class=" text-center thm-bg text-white">

                                <th class="brd-thm1">Safari Date</th>

                                <th class="brd-thm1">Safari Timing</th>

                                <th class="brd-thm1">Safari Type</th>

                                <th class="brd-thm1">Safari Zone</th>

                                <th class="brd-thm1">Contact No.</th>

                                <th class="brd-thm1">Email ID</th>

                            </tr>

                            <tr class="text-center">

                                <td class="brd-thm1">{{$formFields['date']}}</td>

                                <td class="brd-thm1">{{$formFields['timing']}}</td>

                                <td class="brd-thm1">{{$formFields['select_jeep']}}</td>

                                <td class="brd-thm1">{{$formFields['zone']}}</td>

                                <td class="brd-thm1">{{$formFields['mobile']}}</td>

                                <td class="brd-thm1">{{$formFields['email']}}</td>

                            </tr>

                        </tbody>

                    </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection





