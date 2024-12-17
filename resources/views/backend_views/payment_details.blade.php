@extends('backend_views.layouts.main')

@section('main-section')

<section class="content">

    <div class="row">

        <div class="col-sm-12 col-lg-12">

            <div class="panel lobidisable panel-bd">

                <div class="panel-heading">

                    <div class="panel-title">

                        <h4>Payment Details</h4>

                    </div>

                </div>

                <div class="panel-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-hover" id="dataTableExample1">

                            <thead>

                                <tr class="info">

                                    <th>Sr No.</th>

                                    <th>Payment Id</th>

                                    <th>Amount</th>

                                    <th>Name</th>

                                    <th>Email</th>

                                    <th>Mobile No.</th>

                                    <th>Pin Code</th>

                                    <th>Country</th>

                                    <th>Pay For</th>

                                    <th>Remark</th>

                                    <th>Action</th>

                                </tr>

                            </thead>

                            <tbody>

                                @forelse($data as $key => $payment)

                                <tr>

                                    <td>{{ $data->firstItem() + $key }}</td>

                                    <td>{{ $payment->razorpay_payment_id }}</td>

                                    <td>{{ $payment->amount }}</td>

                                    <td>{{ $payment->name }}</td>

                                    <td>{{ $payment->email }}</td>

                                    <td>{{ $payment->mobile }}</td>

                                    <td>{{ $payment->pin_code }}</td>

                                    <td>{{ $payment->country }}</td>

                                    <td>{{ $payment->pay_for }}</td>

                                    <td>{{ $payment->remark }}</td>

                                    <td>

                                        <a href="{{ route('update_payment', ['id' => $payment->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#customerdel{{ $payment->id }}">
                                            <i class="fa fa-trash-o"></i>
                                        </button>

                                    </td>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="customerdel{{ $payment->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header modal-header-primary">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h3><i class="fa fa-user m-r-5"></i> Delete Content</h3>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <form class="form-horizontal" action="{{ route('destroy_payment', ['payment' => $payment->id]) }}" method="POST">
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
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Delete Modal -->

                                </tr>

                                @empty

                                <tr>

                                    <td colspan="11" class="text-center">No Data Found</td>

                                </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

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

    </div>

</section>

@endsection
