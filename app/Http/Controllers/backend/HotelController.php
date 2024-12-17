<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\Hotelbooking;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class HotelController extends Controller
{
    public function add_hotel(){
        return view('backend_views.hotel');
    }

    public function submit_hotel(Request $request)
    {
        
    try 
    { 
        $photo = [];

        if ($request->photo) {
            foreach ($request->photo as $key => $image) {
                $imageName = time() . "." . $image->getClientOriginalName();
                $image->move(public_path('hotelimage'), $imageName);
                $data[] = $imageName;
            }

            $formFields['name'] = $request->name;
            $formFields['facilities'] = $request->facilities;
            $formFields['location'] = $request->location;
            $formFields['description'] = $request->description;
            $formFields['price'] = $request->price;
            $formFields['price2'] = $request->price2;
            $formFields['price3'] = $request->price3;
            $formFields['rating'] = $request->rating;
            $formFields['image'] = json_encode($data);
// dd($formFields);
            $hotel = Hotel::create($formFields);

            return redirect(route('show_hotel_details'))->with('successMessage', 'Content Added Successfully');
        }
    } 
    catch (\Exception $e) 
    {
        return redirect()->back()->withErrors(['dangerMessage' => 'An error occurred. Please try again later.']);
    }
    }


    public function show_hotel_details()
      {
          $hotel= Hotel::all();
          return view('backend_views.hotel_details',['data'=>$hotel]);
      }

      public function delete_hotel(Request $request, Hotel $hotel)  
      {  
          $destination = public_path()."/hotelimage/".$hotel->image;
          if(file::exists($destination))
          {
              file::delete($destination);
          }
          $hotel->delete(); 
          return redirect()->back()->with('successMessage','Content Deleted successfully');
      } 

      public function show_hotel_booking_details()
      {
          $hotelbooking= Hotelbooking::paginate(10);
          return view('backend_views.hotel_booking_details',['data'=>$hotelbooking]);
      }

      public function delete_hotel_booking(Request $request, Hotelbooking $hotelbooking)  
      {  
      $hotelbooking->delete(); 
      return back()->with('successMessage', 'Content Deleted Successfully');
      }  
      
      public function submit_edit_name_form(Request $request, Hotelbooking $user)
      {
          $formFields = $request->validate([
              'name' => 'required',
          ]);
          $user->update($formFields);
  
          return back()->with('successMessage', 'Name updated Succesfully');
      }
      
       public function add_hotel_remark(Request $request, Hotelbooking $user){
      $formFields = $request->validate([
        'remark' => 'required',
    ]);
    $formFields['remark_date']=Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
    $user->update($formFields);

    return back()->with('successMessage', 'Remark added Succesfully');
    }

    public function edit_hotel_detail($id)  
    {  
        
        $hotel_detail=Hotel::find($id);
        return view('backend_views.hotel_edit',['data'=>$hotel_detail]);
    } 

    public function hotel_edit_detail($id)
    {
        $hotel_detail=Hotel::find($id); 
        return view('backend_views.edit_hotel_detail',['data'=>$hotel_detail]);
    }

    public function submit_edit_hotel_form(Request $request)  
    {  
        // Validate the form fields
        $formFields = $request->validate([
            'name' => 'required|string|max:255',
            'facilities' => 'required|string', // Single text field for facilities
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'price2' => 'nullable|numeric',
            'price3' => 'nullable|numeric',
        ]);
        
        // Find the hotel by ID
        $hotel = Hotel::find($request->id);
    
        if (!$hotel) {
            return redirect()->back()->with('errorMessage', 'Hotel not found');
        }
    
        // Update the hotel details
        $hotel->name = $request->name;
        $hotel->facilities = $request->facilities;
        $hotel->location = $request->location;
        $hotel->description = $request->description;
        $hotel->price = $request->price;
        $hotel->price2 = $request->price2;
        $hotel->price3 = $request->price3;
    
        // Save the updated details
        $hotel->save();
    
        // Redirect with a success message
        return redirect(route('show_hotel_details'))->with('successMessage', 'Hotel details updated successfully');
    }


    public function hotel_invoice($id)

      {
          
          // dd($id);
            $data=Hotelbooking::where('payment_id',$id)->get();

            return view('backend_views.hotel_voucher', compact('data'));


      }          

    public function download_hotel_voucher(Request $request)

      {

          $formfield['hotel']=$request->hotel;

          $formfield['persons']=$request->persons;

          $formfield['checkindate']=$request->checkindate;

          $formfield['checkoutdate']=$request->checkoutdate;

          $formfield['rooms']=$request->rooms;

          $formfield['name']=$request->name;

          $formfield['email']=$request->email;

          $formfield['mobile']=$request->mobile;

          $formfield['city']= $request->city;

          $formfield['country']= $request->country;

          $formfield['meal']= $request->meal;

          $formfield['address']= $request->address;

          $formfield['hotelnumber']= $request->hotelnumber;
          
          $formfield['duepayment']= $request->duepayment;


          $id= $request->id;

          Hotelbooking::where('id',$id)->update($formfield);

          $data=Hotelbooking::find($id);

          return view('backend_views.hotel_invoice', compact('data'));

       }










    
}
