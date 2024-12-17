@extends('backend_views.layouts.main')

@section('main-section')

<section class="content">

    <div class="row">

        <div class="col-sm-12">

            <div class="panel panel-bd lobidrag">

                <div class="panel-heading">

                    <div class="btn-group" id="buttonlist"> 

                    <a class="btn btn-add " href="#"> 

                    <i class="fa fa-plus"></i> Edit Hotel</a>  

                    </div>

                </div>

                <div class="panel-body">

                <form action="{{route('submit_edit_hotel_form')}}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="row">

                    <div class="form-group col-lg-12 required">

                    <label class="control-label">Hotel Name</label>
                    <input type="hidden" name="id" value="{{ $data['id'] }}">

                    <input type="text" class="form-control"  name="name" placeholder="Write name of hotel" value="{{$data['name']}}" required>

                    @error('name')

                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>

                    @enderror

                    </div>

                    <div class="form-group col-lg-12 required">
                        <label class="control-label">Facilities</label>
                        <input type="text" class="form-control" placeholder="facilities of hotel" value="{{$data['facilities']}}" name="facilities" required>
                        @error('facilities')
                            <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-lg-12 required">

                    <label class="control-label">Location</label>

                    <input type="text" class="form-control" placeholder="Fill Location" name="location" value="{{$data['location']}}" required>

                    @error('location')

                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>

                    @enderror

                    </div>

                    <div class="form-group col-lg-12 required">

                    <label class="control-label">Description</label>

                    <textarea class="form-control" name="description" id="editor" placeholder="Write Description About Hotel" required >{{ $data['description'] }}</textarea>

                    @error('description')

                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>

                    @enderror

                    </div>

                    <div class="form-group col-lg-12 required">

                    <label class="control-label">Price for one night</label>

                    <input type="text" class="form-control" placeholder="Fill Price" name="price" value="{{ $data['price'] }}" required>

                    @error('price')

                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>

                    @enderror

                    </div>

                    <div class="form-group col-lg-12 required">

                    <label class="control-label">Price for two night</label>

                    <input type="text" class="form-control" placeholder="Fill Price" name="price2" value="{{ $data['price2'] }}">

                    @error('price2')

                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>

                    @enderror

                    </div>

                    <div class="form-group col-lg-12 required">

                    <label class="control-label">Price for three night</label>

                    <input type="text" class="form-control" placeholder="Fill Price" name="price3" value="{{ $data['price3'] }}">

                    @error('price3')

                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>

                    @enderror

                    </div>

                    

                    

                    <div class="form-group">

                        <button class="btn btn-add btn-sm" style="float:right">Submit</button>

                    </div>

                </div>

                </form>

                </div>

            </div>

        </div>

    </div>

</section>

</div>

@endsection

<script>

    setTimeout(function() {

        var alertElements = document.querySelectorAll('.text-danger');



        alertElements.forEach(function(element) {

            element.style.display = 'none';

        });

    }, 20000); // Adjust the timeout value (in milliseconds) as needed

</script>