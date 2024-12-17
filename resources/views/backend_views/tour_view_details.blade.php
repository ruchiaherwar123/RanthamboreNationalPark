@extends('backend_views.layouts.main')
@section('main-section')
  <section class="content">
               <div class="row">
                  <div class="col-sm-12 col-lg-12">
                     <div class="panel lobidisable panel-bd">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Day Wise Details</h4>
                           </div>
                           <a href="{{route('show_tour_package_details')}}" class="btn btn-add " style="float:right">Back</a>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table class="table table-bordered table-hover" id="dataTableExample1">
                                 <thead>
                                    <tr class="info">
                                       <th>Sr No.</th>
                                       <th>Day</th>
                                       <th>Title</th>
                                       <th>Description</th>
                                       <th>Image</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse($tour_view as $key=> $tour_view)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td> {{ $tour_view->day}}</td>
                                        <td> {{ $tour_view->title}}</td>
                                        <td> {{ $tour_view->description}}</td>
                                      <td> 
                                        <img src="{{ asset('public/tourimage/'.$tour_view->image)}}" class="img-circle" alt="User Image" width="50" height="50">
                                        </td>
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