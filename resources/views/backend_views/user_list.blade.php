@extends('backend_views.layouts.main')

@section('main-section')

  <section class="content">

               <div class="row">

                  <div class="col-sm-12 col-lg-12">

                     <div class="panel lobidisable panel-bd">

                        <div class="panel-heading">

                           <div class="panel-title">

                              <h4>User Details</h4>

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
                                       <th>Phone</th>
                                       <th>Role</th>
                                       <th>Action</th>

                                    </tr>

                                 </thead>

                                 <tbody>
                                    @if($users)
                                    @foreach($users as $key=> $user)
                                    <tr>

                                       <td>{{ $key+1 }}</td>
                                       <td>{{ $user->name }}</td>
                                       <td>{{ $user->email }}</td>
                                       <td>{{ $user->number }}</td>
                                       <td>{{ $user->role }}</td>
                                       <td>

                                        <!-- Edit Button -->

                                        <a href="{{ route('change.password', $user->id) }}" class="btn edit-button" title="Edit">

                                        <i class="fas fa-edit"></i>

                                        </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                  

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