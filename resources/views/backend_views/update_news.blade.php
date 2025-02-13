@extends('backend_views.layouts.main')
@section('main-section')
<section class="content">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-bd lobidrag">
                <div class="panel-heading">
                    <div class="btn-group" id="buttonlist"> 
                        <a class="btn btn-add"> 
                        <i class="fa fa-plus"></i>Update News</a>  
                    </div>
                </div>
                <div class="panel-body">
                    <form action="{{url('/submit_update_news',['id' => $data->id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Date</label>
                                <input type="date" class="form-control"  name="date" value="{{$data->date}}" placeholder="mm/dd/yyyy" required>
                                @error('date')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{$data->title}}" placeholder="Title" required>
                                @error('title')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Upload Image</label>
                                <input type="file" class="form-control" name="image" accept="image/*" value="{{$data->image}}" capture="environment">
                                @error('image')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Alt Text</label>
                                <input type="text" class="form-control" name="alt" value="{{$data->alt}}" placeholder="Alt Text" required>
                                @error('alt')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-12 required">
                                <label class="control-label">Description</label>
                                <textarea class="form-control" name="description" id="productDescription" placeholder="Description" required>{{$data->description}}</textarea>
                                @error('description')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Seo Url</label>
                                <input type="text" class="form-control" name="seo_name" value="{{$data->seo_name}}" placeholder="Seo Url" required>
                                @error('seo_name')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Meta Title</label>
                                <input type="text" class="form-control" name="meta_title" value="{{$data->meta_title}}" placeholder="Meta Title" required>
                                @error('meta_title')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Meta Keywords</label>
                                <input type="text" class="form-control" name="meta_keywords" value="{{$data->meta_keywords}}" placeholder="Meta Keywords" required>
                                @error('meta_keywords')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-lg-6 required">
                                <label class="control-label">Meta Description</label>
                                <textarea class="form-control" name="meta_description" placeholder="Meta Description" required>{{$data->meta_description}}</textarea>
                                @error('meta_description')
                                <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
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
    setTimeout(function() {
        var alertElements = document.querySelectorAll('.text-danger');
        alertElements.forEach(function(element) {
            element.style.display = 'none';
        });
    }, 20000);
</script>

@endsection

