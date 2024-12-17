@extends('backend_views.layouts.main')

@section('main-section')

<section class="content">
   <div class="row">
      <div class="col-sm-12 col-lg-12">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="panel-title">
                  <h4>Tour Query List</h4>
               </div>
            </div>
            <div class="panel-body">
               <div class="table-responsive">
                  <table class="table table-bordered table-hover" id="dataTableExample1">
                     <thead>
                        <tr class="info">
                           <th>Sr No.</th>
                           <th>Name</th>
                           <th>Subject</th>
                           <th>Email</th>
                           <th>Mobile No.</th>
                           <th>Message</th>
                           <th>Time of Contact</th>
                           <th>Date of Contact</th>
                           <th>Add Remark</th>
                           <th>Remark</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($data as $key => $enquiry)
                        <tr>
                           <td>{{ $data->firstItem() + $key }}</td>
                           <td>{{ $enquiry->name }}</td>
                           <td>{{ $enquiry->subject }}</td>
                           <td>{{ $enquiry->email }}</td>
                           <td>{{ $enquiry->mobile }}</td>
                           <td>{{ $enquiry->message }}</td>
                           <td>@if(isset($enquiry->query_at)){{ date('h:i A', strtotime($enquiry->query_at)) }}@endif</td>
                           <td>@if(isset($enquiry->query_at)){{ date('d/m/Y', strtotime($enquiry->query_at)) }}@endif</td>
                           <td>
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addremark{{ $enquiry->id }}">
                                 <i class="fa fa-plus"></i> Add/Edit Remark
                              </button>
                              <!-- Add/Edit Remark Modal -->
                              <div class="modal fade" id="addremark{{ $enquiry->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header modal-header-primary text-center">
                                          <button type="button" class="close" data-dismiss="modal">×</button>
                                          <h4><i class="fa fa-pencil m-r-5"></i> Add/Edit Remark</h4>
                                       </div>
                                       <div class="modal-body">
                                          <div class="row">
                                             <div class="col-md-12">
                                                <form method="POST" action="{{ route('add_enquiry_remark', ['enquiry' => $enquiry->id]) }}">
                                                   @csrf
                                                   @method('PUT')
                                                   <div class="form-group">
                                                      <label class="control-label">Remark</label>
                                                      <textarea class="form-control" name="follow_up_remark" rows="10" required>{{ $enquiry->follow_up_remark }}</textarea>
                                                      @error('follow_up_remark')
                                                      <span class="text-danger">{{ $message }}</span>
                                                      @enderror
                                                   </div>
                                                   <div class="form-group text-right">
                                                      <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Cancel</button>
                                                      <button type="submit" class="btn btn-add btn-sm">Update</button>
                                                   </div>
                                                </form>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </td>
                           <td>{{ $enquiry->follow_up_remark }}</td>
                           <td>
                              <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteEnquiry{{ $enquiry->id }}">
                                 <i class="fa fa-trash-o"></i>
                              </button> -->
                              <!-- Delete Confirmation Modal -->
                              <div class="modal fade" id="deleteEnquiry{{ $enquiry->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header modal-header-primary">
                                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          <h4><i class="fa fa-trash m-r-5"></i> Delete Enquiry</h4>
                                       </div>
                                       <div class="modal-body">
                                          <form method="POST" action="{{ route('destroy_enquiry', ['enquiry' => $enquiry->id]) }}">
                                             @csrf
                                             @method('DELETE')
                                             <p>Are you sure you want to delete this enquiry?</p>
                                             <div class="text-right">
                                                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">NO</button>
                                                <button type="submit" class="btn btn-add btn-sm">YES</button>
                                             </div>
                                          </form>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="10" class="text-center">No Data Found</td>
                        </tr>
                        @endforelse
                     </tbody>
                  </table>
               </div>
               @if($data->total()>0)
               <!-- Pagination Links -->
               <div class="pagination-container d-flex justify-content-center">
                  <nav>
                     <ul class="pagination">
                        <!-- Previous Page Link -->
                        <li class="page-item {{ $data->onFirstPage() ? 'disabled' : '' }}">
                           <a class="page-link" href="{{ $data->previousPageUrl() }}" aria-label="Previous">
                              <span aria-hidden="true">&laquo; Previous</span>
                           </a>
                        </li>

                        <!-- Page Number Links -->
                        @for ($i = 1; $i <= $data->lastPage(); $i++)
                           <li class="page-item {{ $data->currentPage() == $i ? 'active' : '' }}">
                              <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                           </li>
                        @endfor

                        <!-- Next Page Link -->
                        <li class="page-item {{ $data->currentPage() == $data->lastPage() ? 'disabled' : '' }}">
                           <a class="page-link" href="{{ $data->nextPageUrl() }}" aria-label="Next">
                              <span aria-hidden="true">Next &raquo;</span>
                           </a>
                        </li>
                     </ul>
                  </nav>
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</section>

@endsection
