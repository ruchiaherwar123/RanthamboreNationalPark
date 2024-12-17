@extends('backend_views.layouts.main')
@section('main-section')
  <section class="content">
               <div class="row">
                  <div class="col-sm-12 col-lg-12">
                     <div class="panel lobidisable panel-bd">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Blog Images</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table class="table table-bordered table-hover" id="dataTableExample1">
                                 <thead>
                                    <tr class="info">
                                       <th>Sr No.</th>
                                       <th>Images</th>
                                       <th>Alt Text</th>
									   <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse($data as $key=> $data)
                                    <tr>
                                       <td>{{ $key+1 }}</td>
                                       <td> 
                                            <img src="{{ asset('public/'.$data->blog_image)}}" style="height:120px; width:200px"/>
                                        </td>
                                       <td> {{ $data->alt_text}}</td>
                                       <td>
                                          <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                          data-target="#editimage{{ $data->id }}"><i
                                          class="fa fa-pencil"></i> </button>
                                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                          data-target="#customerdel{{ $data->id }}"><i
                                          class="fa fa-trash-o"></i> </button>
                                       </td>
                                       <div class="modal fade" id="editimage{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true" >
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-header-primary text-center">
                                                      <button type="button" class="close" data-dismiss="modal" >×</button>
                                                      <h4><i class="fa fa-pencil m-r-5 "></i>Update Image</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="row">
                                                         <div class="col-md-12">
                                                            <form method="POST" action="{{ route('submitimageupdate', ['id' => $data->id]) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                               <fieldset>
                                                                 <!-- Text input-->
                                                                 <div class="col-md-12 form-group">
                                                                    <label class="control-label">Upload Images</label>
                                                                    <input type="file" id="image-upload" class="form-control" name="blog_image" value="{{$data->blog_image}}" accept="image/*">
                                                                    @error('blog_image')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                 </div>
                                                                 <div class="col-md-12 form-group">
                                                                    <label class="control-label">Alt Text</label>
                                                                    <input type="text" id="image-upload" class="form-control" name="alt_text" value="{{$data->alt_text}}" required>
                                                                    @error('alt_text')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                 </div>
                                                                 <div class="col-md-12 form-group user-form-group">
                                                                    <div class="pull-right">
                                                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                                       <button type="submit" class="btn btn-add btn-sm">Update</button>
                                                                    </div>
                                                                 </div>
                                                               </fieldset>
                                                            </form>
                                                         </div>
                                                      </div>
                                                    </div>
                                                </div>
                                               <!-- /.modal-content -->
                                             </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                       {{-- delete model --}}
                                            <!-- /.modal -->
                                            <!-- Modal -->
                                            <!-- document Modal2 -->
                                            <div class="modal fade" id="customerdel{{ $data->id }}"
                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header modal-header-primary">
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h3><i class="fa fa-user m-r-5"></i> Delete Content</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <form class="form-horizontal"
                                                                        action="{{ route('destroy_blog_gallery', ['id' => $data->id]) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <fieldset>
                                                                            <div
                                                                                class="col-md-12 form-group user-form-group">
                                                                                <label class="control-label">Are You Sure You Want to Delete !!</label>
                                                                                <div class="pull-right">
                                                                                    <button type="button"
                                                                                        class="btn btn-danger btn-sm"
                                                                                        data-dismiss="modal">NO</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-add btn-sm">YES</button>
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger pull-left"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                    <!-- /.modal-content -->
                                                </div>
                                                <!-- /.modal-dialog -->
                                            </div>
                                            {{-- delete model --}}
                                    </tr>
                                    @empty
                                    <tr>
                                       <td colspan="5" class="text-center">No Data Found</td>
                                    </tr> 
                                    @endforelse
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
   </section>
   <!-- /.content -->
</div>
@endsection