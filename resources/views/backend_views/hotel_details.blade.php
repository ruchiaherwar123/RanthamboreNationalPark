@extends('backend_views.layouts.main')

@section('main-section')

  <section class="content">

               <div class="row">

                  <div class="col-sm-12 col-lg-12">

                     <div class="panel lobidisable panel-bd">

                        <div class="panel-heading">

                           <div class="panel-title">

                              <h4>Hotel Details</h4>

                           </div>

                        </div>

                        <div class="panel-body">

                           <div class="table-responsive">

                              <table class="table table-bordered table-hover" id="dataTableExample1">

                                 <thead>

                                    <tr class="info">

                                       <th>Sr No.</th>

                                       <th>Images</th>

                                       <th>Hotel Name</th>

                                       <th>Facilities</th>

                                       <th>Location</th>

                                       <th>Description</th>

                                       <th>Price</th>

                                       <th>Rating</th>

                                       <th>Action</th>

                                    </tr>

                                 </thead>

                                 <tbody>

                                    @forelse($data as $key=> $data)

                                    <tr>

                                       <td>{{ $key+1 }}</td>

                                       <td> 

                                            @php 

                                          $image=json_decode($data->image);

                                            @endphp

                                           <?php foreach ($image as $picture) { ?>

                                        

                                            <img src="{{asset('public/hotelimage/'.$picture)}}" style="height:120px; width:200px"/>

                                           <?php } ?>

                                        </td>

                                       <td> {{ $data->name}}</td>

                                       <td> {{ $data->facilities}}</td>

                                       <td> {{ $data->location}}</td>

                                        <td> 

                                       <a href="{{url('edit_hotel_detail/'.$data->id)}}"><i class="fa fa-edit"></i></a>

                                       {!! $data->description !!}</td>

                                       <td> {{$data->price}} </td>

                                       <td>@for($i=1;$i<=$data->rating;$i++)<i class="fa fa-star text-primaryy fa-sm"></i>@endfor</td>

                                       <td>

                                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"

                                          data-target="#customerdel{{ $data->id }}"><i

                                          class="fa fa-trash-o"></i> </button>
                                          <a href="{{route('hotel_edit_details',['id' => $data->id])}}" class="btn btn-primary btn-sm"><i

class="fa fa-pencil"></i></a>

                                       </td>

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

                                                                        action="{{ route('destroy_hotel', ['hotel' => $data->id]) }}"

                                                                        method="POST">

                                                                        @csrf

                                                                        @method('DELETE')

                                                                        <fieldset>

                                                                            <div

                                                                                class="col-md-12 form-group user-form-group">

                                                                                <label class="control-label">Are You Sure You Want to Delete!!</label>

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

                                       <td colspan="9" class="text-center">No Data Found</td>

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