<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Enquiry;
use App\Models\OnlineSafari;
use App\Models\Hotelbooking;
use App\Models\Resortbooking;
use App\Models\ModelForm;
use App\Models\TigerStory;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ContactController extends Controller
{
      public function index()
      {

        $totalenquiry = Contact::count();
        $totalsafaribooking = OnlineSafari::count();
        $totalresortbooking = Hotelbooking::count();
        $totalpackagebooking = Resortbooking::count();
        return view(
           'backend_views.index',
            [
                'totalenquiry' => $totalenquiry,
                'totalsafaribooking' => $totalsafaribooking,
                'totalresortbooking' => $totalresortbooking,
                'totalpackagebooking' => $totalpackagebooking,

            ]
        );
      }

      public function submitcontact(Request $request)
      {
          $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[a-zA-Z\s]+$/',  // Only letters and spaces allowed
            'subject' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|regex:/^[0-9]{10}$/',  // 10-digit phone number
            'message' => 'required',
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            // If AJAX request, return JSON response with errors
            if ($request->ajax()) {
                return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
            }
    
            // For non-AJAX request, redirect back with errors
            return redirect()->back()->withErrors($validator)->withInput();
        }
  
          try {
              // Validate form data
             
              $formFields = $validator->validated();
              // Add timestamp and save to the database
              $formFields['query_at'] = Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
              Contact::create($formFields);

              // Redirect back with success message
              return redirect()->back()->with(['contact' => 'Thank you for contacting us. We will get back to you shortly.']);
          } catch (\Exception $e) {
              // Redirect back with error message
              return redirect()->back()->withErrors(['error' => 'An error occurred. Please try again later.']);
          }
      }


      public function showdetails()
      {
          $contact= Contact::orderBy('id', 'desc')->paginate(10);
          return view('backend_views.contact',['data'=>$contact]);
      }

      public function delete_contact(Request $request, Contact $contact)  
    {  
      $contact->delete(); 
      return back()->with('successMessage', 'Content Deleted Successfully');
    }  
    
    public function quick_safari_booking_details()
      {
          $modal= ModelForm::orderBy('id', 'desc')->paginate(10);
          return view('backend_views.quick_booking',['data'=>$modal]);
      }

      public function delete_quick_safari_booking_details(Request $request, ModelForm $modal)  
    {  
      $modal->delete(); 
      return back()->with('successMessage', 'Content Deleted Successfully');
    }  

public function add_tiger_story()
    {
      return view('backend_views.add_tiger_story');
    }

    public function submit_tiger_story(Request $request)
      {
        $formFields = $request->validate([
          'title' => 'required',
          'description' =>'required',
          'image' => 'required|image|mimes:jpg,jpeg,png,svg,webp',
      ]);
      try {
          if ($request->file('image')) {
              $file = $request->file('image');
              $imagename =time(). $file->getClientOriginalName();
              $file->move(public_path('tiger'), $imagename);
              $formFields['image'] = $imagename;
          }
      TigerStory::create($formFields);
      return redirect()->back()->with('successMessage', 'Content Added successfully');
      } 
      catch (\Throwable $th) {
          return redirect()->back()->with('dangerMessage', 'Something Went Wrong');
      }
    }
    
     public function add_remark(Request $request, Contact $contact){
      $formFields = $request->validate([
        'remark' => 'required',
    ]);
    $formFields['remark_date']=Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
    $contact->update($formFields);

    return back()->with('successMessage', 'Remark added Succesfully');
    }
}
