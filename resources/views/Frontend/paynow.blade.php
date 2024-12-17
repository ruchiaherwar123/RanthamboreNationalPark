@extends('Frontend.Layout.main')
@section('section')
<style>
    .error-message {
            font-size: 0.875em;
            color: red;
        }
    </style>
<div class="breadcrumb-area breed-pay">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="breadcrumb-wrap">
                    <h2>Payment Information</h2>
                    <ul class="breadcrumb-links">
                        <li>
                            <a href="{{url('/')}}">Home</a>
                            <i class="bx bx-chevron-right"></i>
                        </li>
                        <li>Payment Information</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="my-5">
    <div class="container  thm-card1 card ">
        <div class="section-head">
            <h2 class="text-center mb-0">Payment Information</h2>
        </div>
        
        <form action="{{ route('payment_success') }}" method="POST" id="payment-form">
    @csrf
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group my-4">
                <label for="amount" class="text-dark">Enter Amount <span class="text-danger">*</span></label>
                <input type="number" class="form-control mt-2 border-dark rounded" id="amount" name="amount" placeholder="Amount">
                <div class="error-message" id="amountError"></div>
            </div>

            <div class="form-group my-4">
                <label for="email" class="text-dark">Enter Email Address <span class="text-danger">*</span></label>
                <input type="email" class="form-control mt-2 border-dark rounded" id="email" name="email" placeholder="email@domain.com">
                <div class="error-message" id="emailError"></div>
            </div>

            <div class="form-group my-4">
                <label for="pin_code">Enter Postal Code <span class="text-danger">*</span></label>
                <input type="number" class="form-control mt-2 rounded border-dark" id="pin_code" name="pin_code" placeholder="Pincode">
                <div class="error-message" id="pinCodeError"></div>
            </div>

            <div class="form-group my-4">
                <label for="pay_for" class="text-dark">Payment For<span class="text-danger">*</span></label>
                <select class="form-select mt-2 border-dark rounded" name="pay_for" id="pay_for">
                    <option value="Safari">Safari</option>
                    <option value="Hotel">Hotel</option>
                    <option value="Tour package">Tour package</option>
                    <option value="Car">Car</option>
                </select>
                <div class="error-message" id="payForError"></div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="form-group my-4">
                <label for="pay" class="text-dark">Enter Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control mt-2 border-dark rounded" id="pay" name="name" placeholder="Name">
                <div class="error-message" id="nameError"></div>
            </div>

            <div class="form-group my-4">
                <label for="countrySelect" class="text-dark">Select Country <span class="text-danger">*</span></label>
                <select class="form-select mt-2 border-dark rounded" name="country" id="countrySelect">
                    <option value="" disabled selected>--Select Country--</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->name }}" data-mobile-code="{{ $country->mobile_code }}" data-mobile-length="{{ $country->mobile_length }}">
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
                <div class="error-message" id="countryError"></div>
            </div>

            <div class="form-group my-4">
                <label for="mobile" class="text-dark">Enter Mobile Number <span class="text-danger">*</span></label>
                <input type="number" class="form-control mt-2 border-dark rounded" id="mobile" name="mobile" placeholder="Contact Number">
                <div class="mobile-error text-danger"></div>
            </div>

            <div class="form-group my-4">
                <label for="remark" class="text-dark">Package Details <span class="text-danger">*</span></label>
                <textarea class="form-control mt-2 border-dark rounded" id="remark" name="remark" rows="2" placeholder="Remarks if any"></textarea>
                <div class="error-message" id="remarkError"></div>
            </div>

            <div class="text-end">
                <button class="btn mt-4 fs-5 px-3 py-2 thm-bg text-white" id="custom-razorpay-button">Continue To Payment</button>
            </div>
        </div>
    </div>
</form>

        <script>
 
    </script>

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
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
        // Validate on input field change
        document.getElementById('amount').addEventListener('input', validateAmount);
        document.getElementById('email').addEventListener('input', validateEmail);
        document.getElementById('pay').addEventListener('input', validateName);
        document.getElementById('pin_code').addEventListener('input', validatePinCode);
        document.getElementById('countrySelect').addEventListener('change', validateCountry);
        document.getElementById('remark').addEventListener('input', validateRemark);

        // Handle Razorpay Button Click
        document.getElementById('custom-razorpay-button').addEventListener('click', function(e) {
            e.preventDefault();

            // Clear previous error messages
            document.querySelectorAll('.error-message').forEach(function(error) {
                error.textContent = '';
            });

            // Validation variables
            let isValid = true;

            // Get form values
            const amount = document.getElementById('amount').value;
            const email = document.getElementById('email').value;
            const name = document.getElementById('pay').value;
            const pinCode = document.getElementById('pin_code').value;
            const country = document.getElementById('countrySelect').value;
            const remark = document.getElementById('remark').value;

            // Validate all fields
            if (!validateAmount() || !validateEmail() || !validateName() || !validatePinCode() || !validateCountry() || !validateRemark()) {
                isValid = false;
            }

            // If valid, open Razorpay
            if (isValid) {
                var options = {
                    "key": "{{ env('RAZORPAY_KEY') }}",
                    "amount": amount * 100,
                    "name": "Ranthambore National Park",
                    "description": "Payment",
                    "image": "https://www.itsolutionstuff.com/frontTheme/images/logo.png",
                    "handler": function(response) {
                        var form = document.getElementById('payment-form');
                        form.action = "{{ route('payment_success') }}";
                        form.appendChild(createHiddenInput("razorpay_payment_id", response.razorpay_payment_id));
                        form.submit();
                    },
                    "prefill": {
                        "name": name,
                        "email": email,
                        "contact": document.getElementById('mobile').value
                    },
                    "theme": {
                        "color": "#ff7529"
                    }
                };
                var rzp = new Razorpay(options);
                rzp.open();
            }
        });

        // Helper to create hidden input
        function createHiddenInput(name, value) {
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = name;
            input.value = value;
            return input;
        }

        // Validation functions
        function validateAmount() {
            const amount = document.getElementById('amount').value;
            if (!amount || amount <= 0) {
                document.getElementById('amountError').textContent = "Please enter a valid amount.";
                return false;
            }
            document.getElementById('amountError').textContent = '';
            return true;
        }

        function validateEmail() {
            const email = document.getElementById('email').value;
            const regex = /^\S+@\S+\.\S+$/;
            if (!email || !regex.test(email)) {
                document.getElementById('emailError').textContent = "Please enter a valid email address.";
                return false;
            }
            document.getElementById('emailError').textContent = '';
            return true;
        }

        function validateName() {
            const name = document.getElementById('pay').value;
            const regex = /^[A-Za-z\s]+$/;
            if (!name || !regex.test(name)) {
                document.getElementById('nameError').textContent = "Please enter a valid name (letters only).";
                return false;
            }
            document.getElementById('nameError').textContent = '';
            return true;
        }

        function validatePinCode() {
            const pinCode = document.getElementById('pin_code').value;
            if (!pinCode || pinCode.length !== 6) {
                document.getElementById('pinCodeError').textContent = "Please enter a valid 6-digit postal code.";
                return false;
            }
            document.getElementById('pinCodeError').textContent = '';
            return true;
        }

        function validateCountry() {
            const country = document.getElementById('countrySelect').value;
            if (!country) {
                document.getElementById('countryError').textContent = "Please select a country.";
                return false;
            }
            document.getElementById('countryError').textContent = '';
            return true;
        }

        function validateRemark() {
            const remark = document.getElementById('remark').value;
            if (!remark) {
                document.getElementById('remarkError').textContent = "Please provide package details.";
                return false;
            }
            document.getElementById('remarkError').textContent = '';
            return true;
        }
    });

</script>
<!-- Include SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Check for session flash messages
    @if(session('confirmMsg'))
    Swal.fire({
        title: 'Success!',
        text: '{{ session('
        confirmMsg ') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then(() => {
        {
            {
                Session::forget('confirmMsg')
            }
        } // Clear the message
    });
    @elseif(session('errMsg'))
    Swal.fire({
        title: 'Error!',
        text: '{{ session('
        errMsg ') }}',
        icon: 'error',
        confirmButtonText: 'OK'
    }).then(() => {
        {
            {
                Session::forget('errMsg')
            }
        } // Clear the message
    });
    @endif
</script>
@endsection