@extends('backend_views.layouts.main')
@section('main-section')
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="btn-group" id="buttonlist"> 
                    <a class="btn btn-add " href="#"> 
                    <i class="fa fa-plus"></i> Add Tiger Story</a>  
                    </div>
                </div>
                <div class="panel-body">
                <form action="{{route('submit_tiger_story')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-12 required">
                    <label class="control-label">Title</label>
                    <input type="text" class="form-control"  name="title" placeholder="Write Title" required>
                    @error('title')
                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group col-lg-12 required">
                    <label class="control-label">Upload Image</label>
                    <input type="file" class="form-control"
                        name="image" accept="image/*" capture="environment">
                    @error('image')
                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group col-lg-12 required">
                    <label class="control-label">Description</label>
                    <textarea class="form-control" name="description" id="editor" placeholder="Write Description About Hotel" required ></textarea>
                    @error('description')
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