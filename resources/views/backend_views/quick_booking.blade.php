@extends('backend_views.layouts.main')

@section('main-section')

<section class="content">
   <div class="row">
      <div class="col-sm-12 col-lg-12">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="panel-title">
                  <h4>Quick Safari Booking Query List</h4>
               </div>
            </div>
            <div class="panel-body">
               <div class="table-responsive">
                  <table class="table table-bordered table-hover" id="dataTableExample1">
                     <thead>
                        <tr class="info">
                           <th>Sr No.</th>
                           <th>Name</th>
                           <th>Date of Safari</th>
                           <th>Mobile No.</th>
                           <th>Remark</th>
                           <th>Time of Contact</th>
                           <th>Date of Contact</th>
                           <th>Add Follow Up Remark</th>
                           <th>Follow Up Remark</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($data as $key => $booking)
                        <tr>
                           <td>{{ $data->firstItem() + $key }}</td>
                           <td>{{ $booking->name }}</td>
                           <td>{{ date('d/m/Y', strtotime($booking->date)) }}</td>
                           <td>{{ $booking->tel }}</td>
                           <td>{{ $booking->remark }}</td>
                           <td>@if(isset($booking->query_at)){{ date('h:i A', strtotime($booking->query_at)) }}@endif</td>
                           <td>@if(isset($booking->query_at)){{ date('d/m/Y', strtotime($booking->query_at)) }}@endif</td>
                           <td>
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addremark{{ $booking->id }}">
                                 <i class="fa fa-plus"></i> Add/Edit Follow Up Remark
                              </button>
                              <!-- Add/Edit Remark Modal -->
                              <div class="modal fade" id="addremark{{ $booking->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header modal-header-primary text-center">
                                          <button type="button" class="close" data-dismiss="modal">×</button>
                                          <h4><i class="fa fa-pencil m-r-5"></i> Add/Edit Follow Up Remark</h4>
                                       </div>
                                       <div class="modal-body">
                                          <div class="row">
                                             <div class="col-md-12">
                                                <form method="POST" action="{{ route('add_follow_up_remark', ['contact' => $booking->id]) }}">
                                                   @csrf
                                                   @method('PUT')
                                                   <div class="form-group">
                                                      <label class="control-label">Follow Up Remark</label>
                                                      <textarea class="form-control" name="follow_up_remark" rows="10" required>{{ $booking->follow_up_remark }}</textarea>
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
                           <td>{{ $booking->follow_up_remark }}</td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="8" class="text-center">No Data Found</td>
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
