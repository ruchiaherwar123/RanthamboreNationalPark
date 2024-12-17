<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OnlineSafari;
use App\Models\PriceSafari;
use Illuminate\Support\Facades\File;
use Razorpay\Api\Api;
use Session;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Traveller;
use Carbon\Carbon;

class OnlineSafariController extends Controller
{
    
    public function showsafari_details()
    {
        $onlinesafari= OnlineSafari::where(['booking_type'=>0])->paginate(10);
        return view('backend_views.online_safari_details',['data'=>$onlinesafari]);
    }
    
    public function showsafari_enquiry()
    {
        $onlinesafari= OnlineSafari::where(['booking_type'=>1])->paginate(10);
        return view('backend_views.online_safari_enquiry',['data'=>$onlinesafari]);
    }
    
    public function view_onlinesafari(Request $request, $id)
    {
        $onlinesafari= OnlineSafari::find($id);
        $travellers=Traveller::where('booking_id', $onlinesafari->id)->latest()->get();
        return view('backend_views.view_safari_travellers',['data'=>$travellers]);
    }
      
    public function delete_onlinesafari(Request $request, OnlineSafari $onlinesafari)  
    {  
        $onlinesafari->delete(); 
        return back()->with('successMessage', 'Content Deleted Successfully');
    }  
      
    public function submit_update_name_form(Request $request, OnlineSafari $user)
    {
        $formFields = $request->validate([
            'name' => 'required',
        ]);
        $user->update($formFields);
        return back()->with('successMessage', 'Name updated Succesfully');
    }
      
    public function add_safari_remark(Request $request, OnlineSafari $user)
    {
        $formFields = $request->validate([
        'remark' => 'required',
    ]);
        $formFields['remark_date']=Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
        $user->update($formFields);
        return back()->with('successMessage', 'Remark added Succesfully');
    }

}
