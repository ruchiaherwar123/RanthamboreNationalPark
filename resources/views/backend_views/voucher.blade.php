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
                    <form action="{{route('download_voucher')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input class="form-control" type="hidden" name="id" readonly value="{{$data[0]['id']}}">
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Booking Id<span class="required">*</span></label>
                                <input class="form-control" type="text" readonly value="{{$data[0]['booking_id']}}">
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Traveller's Name<span class="required">*</span></label>
                                <input class="form-control" type="text" name="name" value="{{$data[0]['name']}}" required>
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Mobile Number<span class="required">*</span></label>
                                <input class="form-control" type="text" name="mobile" value="{{$data[0]['mobile']}}" required>
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Zone<span class="required">*</span></label>
                                <input class="form-control" type="text" name="zone" value="{{$data[0]['zone']}}" required>
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Vehicle<span class="required">*</span></label>
                                <input class="form-control" type="text" name="select_jeep" value="{{$data[0]['select_jeep']}}" required>
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Booked Seats<span class="required">*</span></label>
                                <input class="form-control" placeholder="Booked Seats" name="seats" value="{{$data[0]['seats']}}" required>
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Date<span class="required">*</span></label>
                                <input type="date" class="form-control" name="date" value="{{$data[0]['date']}}" required>
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label>Shift<span class="required">*</span></label> 
                                <input class="form-select form-control" name="timing" type="text" value="{{$data[0]['timing']}}" required>
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label >Safari Person Name <span class="required">*</span></label> 
                                <input type="text" placeholder="Name" class="form-control" name="sname" value="{{ $data[0]['safari_person']}}" required>
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label> Safari Person Phone no.<span class="required">*</span></label> 
                                <input type="number" placeholder="Phone no." class="form-control" name="sphone" value="{{ $data[0]['safari_phone_no']}}" required>
                            </div>
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