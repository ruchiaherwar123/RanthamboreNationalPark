<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use Carbon\Carbon;

class EnquiryController extends Controller
{
  public function submitenquiry(Request $request)
  {
    try {
      $formFields = $request->validate([
        'name' => 'required',
        'mobile' => 'required',
        'email' => 'required|email',
        'country' => 'required',
      ]);
      $formFields['message'] = $request->message;
      $formFields['query_at'] = Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
      Enquiry::create($formFields);
      return redirect()->back()->with(['contactmsg' => 'Thank you for contacting us. We will get back to you shortly.']);
    } 
    catch (\Exception $e) {
      return redirect()->back()
        ->withErrors(['errormsg' => 'An error occurred. Please try again later.']);
    }
  }

  public function show_enquiry_details()
  {
    $enquiry = Enquiry::orderBy('id', 'desc')->paginate(10);
    return view('backend_views.enquiry_details', ['data' => $enquiry]);
  }

  public function delete_enquiry(Request $request, Enquiry $enquiry)
  {
    $enquiry->delete();
    return back()->with('successMessage', 'Content Deleted Successfully');
  }

  public function add_enquiry_remark(Request $request, Enquiry $enquiry){
    $formFields = $request->validate([
      'follow_up_remark' => 'required',
  ]);
  $formFields['remark_date']=Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
  $enquiry->update($formFields);

  return back()->with('successMessage', 'Follow Up Remark added Succesfully');
  }
}
