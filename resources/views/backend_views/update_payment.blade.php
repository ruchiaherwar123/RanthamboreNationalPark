@extends('backend_views.layouts.main')
@section('main-section')
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="btn-group" id="buttonlist"> 
                        <a class="btn btn-add "> 
                        <i class="fa fa-plus"></i>Update Payment Details</a>  
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{route('submit_update_payment',['id' => $data->id])}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Payment Id<span class="required">*</span></label>
                                <input class="form-control" type="text" name="razorpay_payment_id" value="{{$data->razorpay_payment_id}}" readonly required>
                                @error('razorpay_payment_id')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Amount<span class="required">*</span></label>
                                <input class="form-control" type="text" name="amount" value="{{$data->amount}}" readonly required>
                                @error('amount')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Name<span class="required">*</span></label>
                                <input class="form-control" type="text" name="name" value="{{$data->name}}" required>
                                @error('name')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Email<span class="required">*</span></label>
                                <input class="form-control" type="email" name="email" value="{{$data->email}}" required>
                                @error('email')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Mobile Number<span class="required">*</span></label>
                                <input class="form-control" type="number" name="mobile" value="{{$data->mobile}}" required>
                                @error('mobile')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Pin Code<span class="required">*</span></label>
                                <input class="form-control" type="number" name="pin_code" value="{{$data->pin_code}}" required>
                                @error('pin_code')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Country<span class="required">*</span></label>
                                <input class="form-control" type="text" name="country" value="{{$data->country}}" required>
                                @error('country')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Pay For<span class="required">*</span></label>
                                <input class="form-control" type="text" name="pay_for" value="{{$data->pay_for}}" required>
                                @error('pay_for')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-12 required">
                                <label class="control-label">Remark</label>
                                <textarea class="form-control" name="remark">{{$data->pay_for}}</textarea>
                                @error('remark')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-add btn-sm">Update</button>
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
@endsection                        