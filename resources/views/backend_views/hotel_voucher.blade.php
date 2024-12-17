@extends('backend_views.layouts.main')

@section('main-section')

<section class="content">

    <div class="row">

        <div class="col-sm-12">

            <div class="panel panel-bd lobidrag">

                <div class="panel-heading">

                    <div class="btn-group" id="buttonlist"> 

                        <a class="btn btn-add "> 

                        <i class="fa fa-plus"></i>Generate Voucher</a>  

                    </div>

                </div>

                <div class="panel-body">

                    <form action="{{route('download_hotel_voucher')}}" method="POST" enctype="multipart/form-data">

                        @csrf

                        <div class="row">

                            <input class="form-control" type="hidden" name="id" readonly value="{{$data[0]['id']}}">

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Booking Id<span class="required">*</span></label>

                                <input class="form-control" type="text" name="id" readonly value="{{$data[0]['id']}}">

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Hotel Name<span class="required">*</span></label>

                                <input class="form-control" type="text" name="hotel" value="{{$data[0]['hotel']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">No. of Persons<span class="required">*</span></label>

                                <input class="form-control" type="number" name="persons" value="{{$data[0]['persons']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Check-In Date<span class="required">*</span></label>

                                <input class="form-control" type="date" name="checkindate" value="{{$data[0]['checkindate']}}" required>

                            </div>
                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Check-Out Date<span class="required">*</span></label>

                                <input class="form-control" type="date" name="checkoutdate" value="{{$data[0]['checkoutdate']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Rooms<span class="required">*</span></label>

                                <input class="form-control" type="text" name="rooms" value="{{$data[0]['rooms']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Traveller's Name<span class="required">*</span></label>

                                <input class="form-control" type="text" name="name" value="{{$data[0]['name']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Email<span class="required">*</span></label>

                                <input type="email" class="form-control" name="email" value="{{$data[0]['email']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Mobile<span class="required">*</span></label>

                                <input type="number" class="form-control" name="mobile" value="{{$data[0]['mobile']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">City<span class="required">*</span></label> 

                                <input class="form-control" name="city" type="text" value="{{$data[0]['city']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Country<span class="required">*</span></label> 

                                <input type="text" class="form-control" name="country" value="{{ $data[0]['country']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Meal<span class="required">*</span></label> 

                                <input type="text" class="form-control" name="meal" value="{{ $data[0]['meal']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Address<span class="required">*</span></label> 

                                <input type="text" class="form-control" name="address" value="{{ $data[0]['address']}}" required>

                            </div>
                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Hotel Contact Number<span class="required">*</span></label> 

                                <input type="text" class="form-control" name="hotelnumber" value="{{ $data[0]['hotelnumber']}}" required>

                            </div>

                            <div class="form-group col-lg-6 required">

                                <label class="control-label">Due Payment<span class="required">*</span></label> 

                                <input type="text" class="form-control" name="duepayment" value="{{ $data[0]['duepayment']}}" required>

                            </div>


                            <!-- <div class="form-group col-lg-6 required">

                                <label class="control-label">Price<span class="required">*</span></label> 

                                <input type="text" class="form-control" name="price" value="{{ $data[0]['price']}}" required>

                            </div> -->

                            

                        </div>

                        <div class="form-group">

                            <button class="btn btn-add btn-sm">Download</button>

                        </div>

                    </form>

               </div>

            </div>

        </div>

    </div>

</section>

</div>

<script>

    setTimeout(function() {

        var alertElements = document.querySelectorAll('.text-danger');

        alertElements.forEach(function(element) {

            element.style.display = 'none';

        });

    }, 20000); // Adjust the timeout value (in milliseconds) as needed

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>

	$(document).ready(function(){

    var max_fields = 10;

    var add_input_button = $('.add_input_button');

    var field_wrapper = $('.field_wrapper');

    var new_field_html = '<div><br><input type="text" class="form-control col-lg-10 " placeholder="facilities of hotel" name="facilities[]" required><a href="javascript:void(0);" class="remove_input_button btn" title="Remove field"><i class="fa fa-minus" aria-hidden="true"></i></a></div>';

    var input_count = 1; 

	// Add button dynamically

    $(add_input_button).click(function(){

        if(input_count < max_fields){

            input_count++; 

            $(field_wrapper).append(new_field_html); 

        }

    });

	// Remove dynamically added button

    $(field_wrapper).on('click', '.remove_input_button', function(e){

        e.preventDefault();

        $(this).parent('div').remove();

        input_count--;

    });

});

</script>

<script>

    $(document).ready(function() {

        $('.add-rowreg').click(function() {

            var row = '<tr>';

            row += '<td><input type="text" class="form-control" name="room_name[]" placeholder="Room Type"></td>';

            row += '<td><input type="text" class="form-control input" name="laprice[]" placeholder="Lunch Price"></td>';

            row += '<td><input type="text" class="form-control input" name="ldprice[]" placeholder="Lunch Price"></td>';

            row += '<td><input type="text" class="form-control input" name="daprice[]" placeholder="Dinner Price"></td>';

            row += '<td><input type="text" class="form-control input" name="ddprice[]" placeholder="Dinner Price"></td>';

            row += '<td><input type="text" class="form-control input" name="gstprice[]" placeholder="Gst Price"></td>';

            row += '<td><input type="file" class="form-control input" name="room_img[]"></>';

            row += '<td><button type="button" class="remove-row btn btn-danger">-</button></td>';

            row += '</tr>';

            $('#dynamicadd1 tbody').append(row);

        });                                

        $('#dynamicadd1 tbody').on('click', '.remove-row', function() {

            $(this).closest('tr').remove();

        });

    });

    </script>

@endsection                        