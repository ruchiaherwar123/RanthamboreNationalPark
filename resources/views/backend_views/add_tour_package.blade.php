@extends('backend_views.layouts.main')
@section('main-section')
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="btn-group" id="buttonlist"> 
                <a class="btn btn-add " href="#"> 
                <i class="fa fa-plus"></i> Add Tour Package</a>  
                </div>
            </div>
                <div class="panel-body">
                <form action="{{route('submit_add_tour_package')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-12 required">
                    <label class="control-label">Title</label>
                    <input type="text" class="form-control"  name="title" placeholder="Add a title" value="{{old('title')}}" required>
                    @error('title')
                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group col-lg-12 required">
                    <label class="control-label">Time</label>
                    <input type="text" class="form-control" placeholder="Fill no. of days and night" name="time" value="{{old('time')}}" required>
                    @error('time')
                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group col-lg-12 required">
                    <label class="control-label">No. of Jeeps</label>
                    <input type="text" class="form-control" placeholder="Fill no. of jeeps" name="jeep" value="{{old('jeep')}}" required>
                    @error('jeep')
                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group col-lg-12 required">
                    <label class="control-label">No. of Nights Stay in Wildlife Resort</label>
                    <input type="text" class="form-control" placeholder="Fill No. of Nights Stay in Wildlife Resort" name="night_stay_time" value="{{old('night_stay_time')}}" required>
                    @error('night_stay_time')
                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group col-lg-12 required">
                    <label class="control-label">Description</label>
                    <textarea class="form-control" name="description" placeholder="Write Description About Tour" required >{{old('description')}}</textarea>
                    @error('description')
                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group col-lg-12 required">
                    <label class="control-label">Choose file</label>
                    <input type="file" class="form-control"  name="photo[]" accept="image/x-png,image/jpg,image/jpeg" multiple>
                    @error('image')
                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                    @enderror
                    </div>
                    <table class="table table-bordered table-bordered col-lg-12" id="dynamicadd1">
                        <thead>
                            <tr>
                                <strong><th scope="col">Day</th> </strong>
                                <strong><th scope="col">Title</th> </strong>
                                <strong><th scope="col">Description</th> </strong>
                                <strong><th scope="col"></th> </strong>
                            </tr>
                        </thead>
                        <tbody class="mt-1">
                            <tr class="mt-1">
                                <td><input type="text" class="form-control" name="day[]" id="dose" placeholder="Day" value="{{old('day[]')}}"></td>
                                <td><input type="text" class="form-control input" name="day_title[]" placeholder="Write title" value="{{old('day_title[]')}}"></td>
                                <td><textarea class="form-control input" name="day_description[]" placeholder="Write description" value="{{old('day_description[]')}}"></textarea></td>
                                <td><button type="button" class="add-rowreg btn btn-add">+</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-group">
                    <button class="btn btn-add btn-sm" style="float:right">Submit</button>
                </div>
                </form>
        </div>
    </div>
</div>
</section>
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
    $(document).ready(function() {
        $('.add-rowreg').click(function() {
            var row = '<tr>';
            row += '<td><input type="text" class="form-control" name="day[]" id="dose" placeholder="Day"></td>';
            row += '<td><input type="text" class="form-control input" name="day_title[]" placeholder="Write title"></td>';
            row += '<td><textarea class="form-control input" name="day_description[]" placeholder="Write description"></textarea></td>';
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