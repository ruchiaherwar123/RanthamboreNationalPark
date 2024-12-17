@extends('backend_views.layouts.main')
@section('main-section')
  <section class="content">
               <div class="row">
                  <div class="col-sm-12 col-lg-12">
                     <div class="panel lobidisable panel-bd">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Package Booking Details</h4>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table class="table table-bordered table-hover" id="dataTableExample1">
                                 <thead>
                                    <tr class="info">
                                       <th>Sr No.</th>
                                       <th>Hotel Name</th>
                                       <th>No. of Persons</th>
                                       <th>Check In Date</th>
                                       <th>No. of Rooms</th>
                                       <th>Traveller's Name</th>
                                       <th>Email</th>
                                       <th>Mobile</th>
                                       <th>City</th>
                                       <th>Country</th>
                                       <th>Price</th>
                                       <th>Payment ID</th>
                                       <th>Date & Time of contact</th>
                                       <th>Add Remark</th>
                                       <th>Remark</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse($data as $key=> $data)
                                    <tr>
                                       <td>{{ $key+1 }}</td>
                                       <td> {{ $data->hotel}}</td>
                                       <td> {{ $data->persons}}</td>
                                       <td> {{ $data->checkindate}}</td>
                                       <td> {{ $data->rooms}}</td>
                                      <td> {{ $data->name}}&nbsp;<button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                          data-target="#editname{{ $data->id }}"><i
                                          class="fa fa-pencil"></i> </button>
    <div class="modal fade" id="editname{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary text-center">
                  <button type="button" class="close" data-dismiss="modal" >×</button>
                  <h4><i class="fa fa-pencil m-r-5 "></i>Edit Name</h4>
                </div>
                <div class="modal-body">
                  <div class="row">
                     <div class="col-md-12">
                        <form method="POST" action="{{ route('submiteditusername', ['user' => $data->id]) }}">
                        @csrf
                        @method('PUT')
                           <fieldset>
                             <!-- Text input-->
                             <div class="col-md-12 form-group">
                                <label class="control-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter Your Name" value="{{ $data->name }}" required>
                                @error('name')
                                    <span class="text-danger" style="position:absolute;">{{ $message }}</span>
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
                                        </td>
                                       <td> {{ $data->email}}</td>
                                       <td> {{ $data->mobile}}</td>
                                       <td> {{ $data->city}}</td>
                                       <td> {{ $data->country}}</td>
                                       <td> {{ $data->priceresort}}</td>
                                       <td> {{ $data->payment_id}}</td>
                                       <td> {{ $data->payment_id}}</td>
                                       <td> @if(isset($data->query_at)!=""){{date('d/m/Y H:i:s', strtotime($data->query_at))}}@endif</td>
                                       <td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                          data-target="#addremark{{ $data->id }}"><i
                                          class="fa fa-plus"></i>Add/Edit Remark</button>
                                          <div class="modal fade" id="addremark{{ $data->id }}" tabindex="-1" role="dialog" aria-hidden="true" >
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-header-primary text-center">
                                                      <button type="button" class="close" data-dismiss="modal" >×</button>
                                                      <h4><i class="fa fa-pencil m-r-5 "></i>Add/Edit Remark</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                      <div class="row">
                                                         <div class="col-md-12">
                                                            <form method="POST" action="{{ route('add_package_remark', ['user' => $data->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                                 <div class="col-md-12 form-group">
                                                                    <label class="control-label">Remark</label>
                                                                    <textarea type="text" class="form-control" name="remark" rows="10" required>{{ $data->remark }}</textarea>
                                                                    @error('remark')
                                                                        <span class="text-danger" style="position:absolute;">{{ $message }}</span>
                                                                    @enderror
                                                                 </div>
                                                                 <div class="col-md-12 form-group user-form-group">
                                                                    <div class="pull-right">
                                                                       <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                                       <button type="submit" class="btn btn-add btn-sm">Update</button>
                                                                    </div>
                                                                 </div>
                                                            </form>
                                                         </div>
                                                      </div>
                                                    </div>
                                                </div>
                                               <!-- /.modal-content -->
                                             </div>
                                            <!-- /.modal-dialog -->
                                          </div>
                                        </td>
                                        <td>{{$data->remark}}</td>
                                       <td>
                                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                          data-target="#customerdel{{ $data->id }}"><i
                                          class="fa fa-trash-o"></i> </button>
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
                                                                        action="{{ route('delete_package_booking', ['package' => $data->id]) }}"
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
                                       <td colspan="13" class="text-center">No Data Found</td>
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