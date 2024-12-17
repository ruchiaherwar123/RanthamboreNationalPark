@extends('backend_views.layouts.main')

@section('main-section')

  <section class="content">
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <div class="panel lobidisable panel-bd">
          <div class="panel-heading">
            <div class="panel-title">
              <h4>Online Safari Booking Details</h4>
            </div>
          </div>

          <div class="panel-body">
            <div class="table-responsive">
              <table class="table table-bordered table-hover" id="dataTableExample1">
                <thead>
                  <tr class="info">
                    <th>Sr No.</th>
                    <th>Selected Jeep</th>
                    <th>No of Seats</th>
                    <th>Selected Zone</th>
                    <th>Time</th>
                    <th>Traveller's Name</th>
                    <th>Mobile</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Payment ID</th>
                    <th>Time of contact</th>
                    <th>Date of contact</th>
                    <th>Add Remark</th>
                    <th>Remark</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  @forelse($data as $key => $onlinesafari)
                    <tr>
                      <td>{{ $data->firstItem() + $key }}</td>
                      <td>{{ $onlinesafari->select_jeep }}</td>
                      <td>{{ $onlinesafari->seats }}</td>
                      <td>{{ $onlinesafari->zone }}</td>
                      <td>{{ $onlinesafari->timing }}</td>
                      <td>
                        {{ $onlinesafari->name }}
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#editname{{ $onlinesafari->id }}">
                          <i class="fa fa-pencil"></i>
                        </button>

                        <!-- Modal for editing name -->
                        <div class="modal fade" id="editname{{ $onlinesafari->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header modal-header-primary text-center">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h4><i class="fa fa-pencil m-r-5 "></i>Edit Name</h4>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="{{ route('submiteditname', ['user' => $onlinesafari->id]) }}">
                                  @csrf
                                  @method('PUT')
                                  <div class="col-md-12 form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter Your Name" value="{{ $onlinesafari->name }}" required>
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
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>{{ $onlinesafari->mobile }}</td>
                      <td>{{ $onlinesafari->email }}</td>
                      <td>{{ date('d/m/Y', strtotime($onlinesafari->date)) }}</td>
                      <td>{{ $onlinesafari->razorpay_payment_id }}</td>
                      <td>@if(isset($onlinesafari->query_at)){{ date('h:i:s', strtotime($onlinesafari->query_at)) }}@endif</td>
                      <td>@if(isset($onlinesafari->query_at)){{ date('d/m/Y', strtotime($onlinesafari->query_at)) }}@endif</td>
                      <td>
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addremark{{ $onlinesafari->id }}">
                          <i class="fa fa-plus"></i>Add/Edit Remark
                        </button>

                        <!-- Modal for adding/editing remark -->
                        <div class="modal fade" id="addremark{{ $onlinesafari->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header modal-header-primary text-center">
                                <button type="button" class="close" data-dismiss="modal">×</button>
                                <h4><i class="fa fa-pencil m-r-5 "></i>Add/Edit Remark</h4>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="{{ route('add_safari_remark', ['user' => $onlinesafari->id]) }}">
                                  @csrf
                                  @method('PUT')
                                  <div class="col-md-12 form-group">
                                    <label class="control-label">Remark</label>
                                    <textarea type="text" class="form-control" name="remark" rows="10" required>{{ $onlinesafari->remark }}</textarea>
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
                      </td>
                      <td>{{ $onlinesafari->remark }}</td>
                      <td>
                        <a class="btn btn-add btn-sm" href="{{ url('/invoice/' . $onlinesafari->razorpay_payment_id) }}"><i class="fa fa-download"></i></a>
                        <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customerdel{{ $onlinesafari->id }}">
                          <i class="fa fa-trash-o"></i>
                        </button> -->
                        <a href="{{ route('view_onlinesafari', ['id' => $onlinesafari->id]) }}" class="btn btn-add btn-sm"><i class="fa fa-eye"></i></a>
                      </td>

                      <!-- Modal for delete -->
                      <div class="modal fade" id="customerdel{{ $onlinesafari->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header modal-header-primary">
                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                              <h3><i class="fa fa-user m-r-5"></i> Delete Content</h3>
                            </div>
                            <div class="modal-body">
                              <form class="form-horizontal" action="{{ route('destroy_onlinesafari', ['onlinesafari' => $onlinesafari->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="col-md-12 form-group user-form-group">
                                  <label class="control-label">Are You Sure You Want to Delete?</label>
                                  <div class="pull-right">
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">NO</button>
                                    <button type="submit" class="btn btn-add btn-sm">YES</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>

                    </tr>
                  @empty
                    <tr>
                      <td colspan="14" class="text-center">No Data Found</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>

              <!-- Pagination -->
              <div class="pagination-container d-flex justify-content-center mt-4">
                        <nav>
                            <ul class="pagination">
                                <!-- Previous Page Link -->
                                <li class="page-item {{ $data->onFirstPage() ? 'disabled' : '' }}">
                                    <a class="page-link" href="{{ $data->previousPageUrl() }}" aria-label="Previous">
                                        <span aria-hidden="true">&laquo; Previous</span>
                                    </a>
                                </li>

                                <!-- Page Number Links -->
                                @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
                                    <li class="page-item {{ $data->currentPage() == $page ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

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
