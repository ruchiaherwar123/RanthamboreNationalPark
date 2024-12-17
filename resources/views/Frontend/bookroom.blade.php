@extends('Frontend.Layout.main')
@section('section')
<div class="breadcrumb-area breed6">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="breadcrumb-wrap">
          <h2>Resort Booking</h2>
          <ul class="breadcrumb-links">
            <li>
              <a href="{{url('/')}}">Home / Our Services</a>
              <i class="bx bx-chevron-right"></i>
            </li>
            <li>Resort Booking</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row col-12 mx-auto mt-5">
    <div class="card p-3 shadow-lg card-bg brd-thm2 text-dark" style="border-radius: 10px;">
      <div class="row col-lg-12 col-md-12 col-sm-12 mx-auto">
        <h2 class="border-bottom lh-lg h3_stl"><strong>HOTEL BOOKING INFORMATION</strong></h2>
        <h2 class="h4_stl"><strong>{{$hotel}}</strong></h2>
      </div>
    </div>
  </div>
  <div class="card p-3 shadow-lg my-3 card-bg" style="border-radius: 10px;">
    <h2 class="border-bottom lh-lg h4_stl"><strong>TRAVELLER'S DETAILS</strong></h2>
    <form class="direct-pay-form" id="bookingform">
      <div class="row col-lg-12 col-md-12 col-sm-12 mx-auto">
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="row col-12 mx-auto">
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group my-3">
                <label>Hotel Name</label>
                <input type="text" class="form-control mt-2 rounded" value="{{ $hotel }}" name="hotel" readonly>
                <input type="hidden" class="form-control" value="{{ $hotel }}" name="hotel" readonly>
              </div>
              <div class="form-group my-3">
                <label>No. of Persons <span class="text-danger">*</span></label>
                <input type="number" class="form-control mt-2 rounded bg-white" id="persons" name="persons" placeholder="No. Of Persons" min="1" required>
              </div>
              <div class="form-group my-3">
                <label>Enter Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control mt-2 rounded bg-white" name="name" placeholder="Your Name" required>
              </div>
              <div class="form-group my-3">
                <label>Country <span class="text-danger">*</span></label>
                <select class="form-select mt-2 border-dark rounded" name="country" id="countrySelect">
                    <option value="" disabled selected>--Select Country--</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->name }}" data-mobile-code="{{ $country->mobile_code }}" data-mobile-length="{{ $country->mobile_length }}">
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
              </div>
              <div class="form-group my-3">
                <label>City <span class="text-danger">*</span></label>
                <input type="text" class="form-control mt-2 rounded bg-white" name="city" placeholder="Your City" required>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
              <div class="form-group my-3">
                <label>Check-In Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control mt-2 rounded bg-white" id="dateInput" onchange="setCheckoutMinDate()" name="checkindate" required>
              </div>
              <div class="form-group mb-2">
                <label class="text-dark">Check-Out Date <span class="text-danger">*</span></label>
                <input type="date" class="form-control mt-1 rounded" id="dateoutput" name="checkoutdate" required>
              </div>
              <div class="form-group my-3">
                <label>Rooms <span class="text-danger">*</span></label>
                <input type="number" class="form-control mt-2 rounded bg-white" id="rooms" name="rooms" placeholder="No. Of Rooms" min="1" required>
              </div>
              <div class="form-group my-3">
                <label>Enter Email Address <span class="text-danger">*</span></label>
                <input type="email" class="form-control mt-2 rounded bg-white" name="email" placeholder="email@domain.com" required>
              </div>
              <div class="form-group my-3">
                <label>Enter Mobile Number <span class="text-danger">*</span></label>
                <input type="tel" class="form-control mt-2 rounded bg-white" name="mobile" id="mobile" placeholder="Contact Number" required>
                <div class="mobile-error text-danger"></div>
              </div>
              <div class="form-group my-4">
                <label>Price For 1 room</label>
                <input type="text" class="form-control bg-white" value="{{ $room_price }}" name="price" id="price" readonly required>
                <input type="hidden" class="form-control bg-white" name="price" value="{{ $room_price }}" id="totalPrice2">
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 d-flex align-items-center">
          <div>
            <div class="card shadow-lg table-row-clr mt-3" style="border-radius: 10px;">
              <div class="card-body">
                <h2 class="border-bottom lh-lg text-white h4_stl"><strong>PRICE DETAILS</strong></h2>
                <p class="text-justify mb-3 text-white">The total cost includes the base price, GST, and gateway charges.</p>
                <table class="table">
                  <tr class="border-bottom">
                    <th class="text-white">Base Price</th>
                    <td class="text-end text-white"><span class="basePrice">{{ $room_price }}</span></td>
                  </tr>
                  <tr class="border-bottom">
                    <th class="text-white">Gateway Charge (3%)</th>
                    <td class="text-end text-white"><span class="gatewayCharge">0.00</span></td>
                  </tr>
                  <tr class="border-bottom">
                    <th class="text-white">Grand Total</th>
                    <td class="text-end text-white"><span class="totalPrice">{{ $room_price }}</span></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="card-footer shadow-lg p-3 table-row-clr mt-2" style="border-radius: 10px;">
              <div class="d-flex">
                <input type="checkbox" class="me-2" required>
                <span class="text-white">I have read and accept the <span class="ms-1">terms and conditions</span></span>
              </div>
              <button class="btn btn--md btn--base text-uppercase shadow text-white" type="submit">Continue To Payment</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="card my-3 brd-thm1">
    <div class="card-header thm-bg">
      <h4 class="text-white"><strong>Price Includes</strong></h4>
    </div>
    <div class="card-body">
      <ul class="lh-lg ms-3" type="disc" style="list-style:disc !important;">
        <li class="text-dark">Accommodation in Pre-Booked Resort.</li>
        <li class="text-dark">Meals (Breakfast & dinner) at Resort.</li>
        <li class="text-dark">Complimentary use of swimming pool (if available)</li>
        <li class="text-dark">Complimentary recreational activities in Resort.</li>
      </ul>
    </div>
  </div>
</div>
<script>
let countrySelected = false;
function validateMobileNumber() {
    const selectedOption = document.getElementById('countrySelect').options[document.getElementById('countrySelect').selectedIndex];
    const mobileLength = parseInt(selectedOption.getAttribute('data-mobile-length'));
    const mobileNumber = document.getElementById('mobile').value.trim();
    const errorMessage = document.querySelector('.mobile-error');
    errorMessage.textContent = '';
    if (countrySelected && mobileNumber.length > 0 && mobileNumber.length !== mobileLength) {
        errorMessage.textContent = `Mobile number must be ${mobileLength} digits long for ${selectedOption.textContent}.`;
    }
}
document.getElementById('countrySelect').addEventListener('change', function() {
    countrySelected = true;
    validateMobileNumber();
});

document.getElementById('mobile').addEventListener('input', function() {
    if (countrySelected) {
        validateMobileNumber();
    }
});
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>

  // Get today's date for the check-in date field
  function getCurrentDate() {
        const today = new Date();
        const year = today.getFullYear();
        let month = today.getMonth() + 1;
        let day = today.getDate();
        month = month < 10 ? `0${month}` : month;
        day = day < 10 ? `0${day}` : day;
        return `${year}-${month}-${day}`;
    }

    // Set the minimum check-in date
    document.getElementById('dateInput').min = getCurrentDate();
    function setCheckoutMinDate() {
    const checkinDate = document.getElementById('dateInput').value;
    const checkoutInput = document.getElementById('dateoutput');
    if (checkinDate) {
        // Set checkout's min date to the day after check-in
        const checkoutMinDate = new Date(checkinDate);
        checkoutMinDate.setDate(checkoutMinDate.getDate() + 1); // Add 1 day
        // Format it to 'YYYY-MM-DD'
        const year = checkoutMinDate.getFullYear();
        const month = ('0' + (checkoutMinDate.getMonth() + 1)).slice(-2);
        const day = ('0' + checkoutMinDate.getDate()).slice(-2);
        const formattedCheckoutMinDate = `${year}-${month}-${day}`;       
        // Set the checkout input min value
        checkoutInput.min = formattedCheckoutMinDate;
    }
}

  function updateTotalPrice() {
    const roomPrice = parseFloat($('#price').val());
    const numberOfRooms = parseInt($('#rooms').val()) || 1;
    const basePrice = roomPrice * numberOfRooms;
    const gatewayCharge = basePrice * 0.03;
    const totalAmount = basePrice + gatewayCharge;
    $('.basePrice').text(basePrice.toFixed(2));
    $('.gatewayCharge').text(gatewayCharge.toFixed(2));
    $('.totalPrice').text(totalAmount.toFixed(2));
    $('#totalPrice2').val(totalAmount.toFixed(2));
  }
  function updateRoomsBasedOnPersons() {
    const persons = parseInt($('#persons').val()) || 1;
    const requiredRooms = Math.ceil(persons / 2); // Assuming 2 persons per room
    $('#rooms').val(requiredRooms);
    updateTotalPrice();
  }
  $('#persons').on('input', updateRoomsBasedOnPersons);
  $('#rooms').on('input', updateTotalPrice);
  document.getElementById('dateInput').min = getCurrentDate();
  $('#bookingform').on('submit', function(e) {
    e.preventDefault();
    const totalAmount = $('#totalPrice2').val();
    const options = {
      "key": "rzp_test_nC5kxY1iKaQcLp",
      "amount": (totalAmount * 100),
      "name": "Ranthambore National Park",
      "description": "Payment",
      "image": "{{ asset('public/assets/img/logo/7safarlogo.jpeg') }}",
      "handler": function(response) {
        window.location.href = SITEURL + '/submithotelbooking?payment_id=' + response.razorpay_payment_id + '&formdata=' + $('#bookingform').serialize();
      },
      "prefill": {
        "contact": '9988665544',
        "email": 'abc@gmail.com',
      },
      "theme": {
        "color": "#528FF0"
      }
    };
    const rzp1 = new Razorpay(options);
    rzp1.open();
  });
  $(document).ready(updateTotalPrice);
</script>
@endsection
