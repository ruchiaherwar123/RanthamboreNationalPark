@extends('backend_views.layouts.main')
@section('main-section')
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="btn-group" id="buttonlist"> 
                        <a class="btn btn-add"> 
                            <i class="fa fa-plus"></i>Add Blog Gallery Images
                        </a>  
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{url('/submit_blog_gallery')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-12 required">
                                <label class="control-label">Upload Images</label>
                                <input type="file" id="image-upload" class="form-control" name="blog_image[]" accept="image/*" multiple required>
                                @error('blog_image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div id="image-preview-container" class="row"></div>

                        <div class="form-group">
                            <button class="btn btn-add btn-sm">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<script>
    document.getElementById('image-upload').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = ''; // Clear previous previews
        
        Array.from(files).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imagePreview = `
                    <div class="form-group col-lg-4">
                        <img src="${e.target.result}" alt="Image Preview" style="max-width: 100%; height: auto;"/>
                        <input type="text" class="form-control mt-2" name="alt_text[]" placeholder="Alt text for this image" required>
                    </div>
                `;
                previewContainer.insertAdjacentHTML('beforeend', imagePreview);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

@endsection
