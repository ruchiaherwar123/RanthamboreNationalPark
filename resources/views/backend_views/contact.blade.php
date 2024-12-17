@extends('backend_views.layouts.main')

<style>
   .pagination-container nav ul.pagination {
      display: flex;
      justify-content: space-between;
      width: 100%;
   }

   .pagination-container nav ul.pagination li.page-item:first-child {
      margin-left: auto;
   }

   .pagination-container nav ul.pagination li.page-item:last-child {
      margin-right: auto;
   }
</style>

@section('main-section')

<section class="content">
   <div class="row">
      <div class="col-sm-12 col-lg-12">
         <div class="panel lobidisable panel-bd">
            <div class="panel-heading">
               <div class="panel-title">
                  <h4>Contact Query List</h4>
               </div>
            </div>
            <div class="panel-body">
               <div class="table-responsive">
                  <table class="table table-bordered table-hover" id="dataTableExample1">
                     <thead>
                        <tr class="info">
                           <th>Sr No.</th>
                           <th>Name</th>
                           <th>Email</th>
                           <th>Message</th>
                           <th>Subject</th>
                           <th>Time of contact</th>
                           <th>Date of contact</th>
                           <th>Add Remark</th>
                           <th>Remark</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($data as $key => $contact)
                        <tr>
                           <td>{{ $data->firstItem() + $key }}</td>
                           <td>{{ $contact->name }}</td>
                           <td>{{ $contact->email }}</td>
                           <td>{{ $contact->message }}</td>
                           <td>{{ $contact->subject }}</td>
                           <td>@if($contact->query_at) {{ date('h:i A', strtotime($contact->query_at)) }} @endif</td>
                           <td>@if($contact->query_at) {{ date('d/m/Y', strtotime($contact->query_at)) }} @endif</td>
                           <td>
                              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addremark{{ $contact->id }}">
                                 <i class="fa fa-plus"></i> Add/Edit Remark
                              </button>
                              <div class="modal fade" id="addremark{{ $contact->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                 <div class="modal-dialog">
                                    <div class="modal-content">
                                       <div class="modal-header modal-header-primary text-center">
                                          <button type="button" class="close" data-dismiss="modal">×</button>
                                          <h4><i class="fa fa-pencil m-r-5"></i> Add/Edit Remark</h4>
                                       </div>
                                       <div class="modal-body">
                                          <div class="row">
                                             <div class="col-md-12">
                                                <form method="POST" action="{{ route('add_remark', ['contact' => $contact->id]) }}">
                                                   @csrf
                                                   @method('PUT')
                                                   <div class="col-md-12 form-group">
                                                      <label class="control-label">Remark</label>
                                                      <textarea type="text" class="form-control" name="remark" rows="10" required>{{ $contact->remark }}</textarea>
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
                                 </div>
                              </div>
                           </td>
                           <td>{{ $contact->remark }}</td>
                        </tr>
                        @empty
                        <tr>
                           <td colspan="7" class="text-center">No Data Found</td>
                        </tr>
                        @endforelse
                     </tbody>
                  </table>
                  
                  <!-- Custom Pagination Links -->
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
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

@endsection
