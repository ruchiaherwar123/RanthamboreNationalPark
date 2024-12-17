@extends('backend_views.layouts.main')
@section('main-section')
  <section class="content">
               <div class="row">
                  <div class="col-sm-12 col-lg-12">
                     <div class="panel lobidisable panel-bd">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Travellers Details</h4>
                           </div>
                           <a href="{{route('show_safari_details')}}" class="btn btn-add btn-sm float-right" style="float:right;">Back</a>
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                              <table class="table table-bordered table-hover" id="dataTableExample1">
                                 <thead>
                                    <tr class="info">
                                       <th>Sr No.</th>
                                       <th>Traveller's Name</th>
                                       <th>Father's Name</th>
                                       <th>Gender</th>
                                       <th>Age</th>
                                       <th>Nationality</th>
                                       <th>ID Type</th>
                                       <th>ID Number</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @forelse($data as $key=> $data)
                                    <tr>
                                       <td>{{ $key+1 }}</td>
                                       <td> {{$data->name}}</td>
                                       <td> {{$data->fname}}</td>
                                       <td> {{$data->gender}}</td>
                                       <td> {{$data->age}}</td>
                                       <td> {{$data->nationality}}</td>
                                       <td> {{$data->id_type}}</td>
                                       <td> {{$data->id_no}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                       <td colspan="8" class="text-center">No Data Found</td>
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