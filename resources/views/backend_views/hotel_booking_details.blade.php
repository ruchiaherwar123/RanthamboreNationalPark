@extends('backend_views.layouts.main')

@section('main-section')

<section class="content">
    <div class="row">
        <div class="col-sm-12 col-lg-12">
            <div class="panel lobidisable panel-bd">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>Resort Booking Details</h4>
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
                                    <th>Time of contact</th>
                                    <th>Date of contact</th>
                                    <th>Add Remark</th>
                                    <th>Remark</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $key => $hotel)
                                <tr>
                                    <td>{{ $data->firstItem() + $key }}</td>
                                    <td>{{ $hotel->hotel }}</td>
                                    <td>{{ $hotel->persons }}</td>
                                    <td>{{ date('d/m/Y', strtotime($hotel->checkindate)) }}</td>
                                    <td>{{ $hotel->rooms }}</td>
                                    <td>{{ $hotel->name }}
                                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal"
                                                data-target="#editusername{{ $hotel->id }}"><i
                                                class="fa fa-pencil"></i></button>
                                        <div class="modal fade" id="editusername{{ $hotel->id }}" tabindex="-1"
                                             role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-header-primary text-center">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4><i class="fa fa-pencil m-r-5 "></i>Edit Name</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('submitusereditname', ['user' => $hotel->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-md-12 form-group">
                                                                <label class="control-label">Name</label>
                                                                <input type="text" class="form-control" name="name" placeholder="Enter Your Name" value="{{ $hotel->name }}" required>
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
                                    <td>{{ $hotel->email }}</td>
                                    <td>{{ $hotel->mobile }}</td>
                                    <td>{{ $hotel->city }}</td>
                                    <td>{{ $hotel->country }}</td>
                                    <td>{{ $hotel->price }}</td>
                                    <td>{{ $hotel->payment_id }}</td>
                                    <td>@if(isset($hotel->query_at)){{ date('h:i A', strtotime($hotel->query_at)) }}@endif</td>

                                    <td>@if(isset($hotel->query_at)){{ date('d/m/Y', strtotime($hotel->query_at)) }}@endif</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                                data-target="#addremark{{ $hotel->id }}"><i class="fa fa-plus"></i>Add/Edit Remark</button>
                                        <div class="modal fade" id="addremark{{ $hotel->id }}" tabindex="-1"
                                             role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header modal-header-primary text-center">
                                                        <button type="button" class="close" data-dismiss="modal">×</button>
                                                        <h4><i class="fa fa-pencil m-r-5 "></i>Add/Edit Remark</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('add_hotel_remark', ['user' => $hotel->id]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-md-12 form-group">
                                                                <label class="control-label">Remark</label>
                                                                <textarea type="text" class="form-control" name="remark" rows="10" required>{{ $hotel->remark }}</textarea>
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
                                    <td>{{ $hotel->remark }}</td>
                                    <td>
                                        <a class="btn btn-add btn-sm" href="{{ url('/hotel_invoice/'.$hotel->payment_id) }}"><i class="fa fa-download"></i></a>
                                        <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#customerdel{{ $hotel->id }}"><i class="fa fa-trash-o"></i></button> -->
                                    </td>

                                    <!-- Delete modal -->
                                    <div class="modal fade" id="customerdel{{ $hotel->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header modal-header-primary">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h3><i class="fa fa-user m-r-5"></i> Delete Content</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="form-horizontal" action="{{ route('delete_hotel_booking', ['hotelbooking' => $hotel->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <fieldset>
                                                            <div class="col-md-12 form-group user-form-group">
                                                                <label class="control-label">Are You Sure You Want to Delete!!</label>
                                                                <div class="pull-right">
                                                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">NO</button>
                                                                    <button type="submit" class="btn btn-add btn-sm">YES</button>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </tr>
                                @empty
                                <tr>
                                    <td colspan="16" class="text-center">No Data Found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                     @if($data->total()>0)
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
                  @endif
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
