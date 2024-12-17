<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resortbooking;
use Carbon\Carbon;

class SafariResortController extends Controller
{
    public function show_package_booking_details()
      {
          $package = Resortbooking::all();
          return view('backend_views.package_details',['data'=>$package]);
      }

      public function delete_package_booking(Request $request, Resortbooking $package)  
      {  
      $package->delete(); 
      return back()->with('successMessage', 'Content Deleted Successfully');
      }  
      
      public function submit_edit_package_name_form(Request $request, Resortbooking $user)
      {
          $formFields = $request->validate([
              'name' => 'required',
          ]);
          $user->update($formFields);
  
          return back()->with('successMessage', 'Name updated Succesfully');
      }
      
       public function add_package_remark(Request $request, Resortbooking $user){
      $formFields = $request->validate([
        'remark' => 'required',
    ]);
    $formFields['remark_date']=Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
    $user->update($formFields);

    return back()->with('successMessage', 'Remark added Succesfully');
    }
}
