<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\News;
use App\Models\OnlineSafari;
use App\Models\PriceSafari;
use Illuminate\Support\Facades\File;
use App\Models\Traveller;
use Razorpay\Api\Api;
use Session;
use Exception;
use App\Models\HotelRoom;
use App\Models\Hotelbooking;
use App\Models\ModelForm;
use App\Models\TigerStory;
use Carbon\Carbon;
use App\Models\TourPackage;
use App\Models\TourView;
use App\Models\Country;
use Illuminate\Support\Facades\Validator;


class IndexController extends Controller
{
    public function index()
    {
        $news = News::latest()->take(3)->get();
        $tigerstory = TigerStory::all();
        return view('Frontend.index' ,['news'=>$news , 'tigerstory'=>$tigerstory]);
    }

    public function about()
    {
        return view('Frontend.about');
    }

    public function gallary()
    {
        return view('Frontend.gallery');
    }

    public function contact()
    {
        return view('Frontend.contact');
    }

    public function enquiry()
    {
        return view('Frontend.enquiry');
    }

    public function tourist()
    {
        return view('Frontend.tourist_attraction');
    }

    public function geographical()
    {
        return view('Frontend.geographical');
    }

    public function faq()
    {
        return view('Frontend.faq');
    }
    
    public function tiger_territory()
    {
        return view('Frontend.tiger_territory');
    }

    public function floraandfauna()
    {
        return view('Frontend.floraandfauna');
    }

    public function best_time()
    {
        return view('Frontend.best-time');
    }

    public function how_to_plan()
    {
        return view('Frontend.how_to_plan');
    }

    public function ranthambore_fort()
    {
        return view('Frontend.ranthambore_fort');
    }

    public function how_to_reach()
    {
        return view('Frontend.how_to_reach');
    }

    public function places_to_visit()
    {
        return view('Frontend.places_to_visit');
    }

    public function onlinesafari()
    {
        return view('Frontend.onlinesafari');
    }

    public function history()
    {
        return view('Frontend.history');
    }

    public function animals()
    {
        return view('Frontend.animals');
    }

    public function safari_tips()
    {
        return view('Frontend.safari_tips');
    }

    public function birds()
    {
        return view('Frontend.birds');
    }

    public function best_tiger_zone()
    {
        return view('Frontend.best_tiger_zone');
    }

    public function tandc()
    {
        return view('Frontend.tandc');
    }

    public function jungle_safari()
    {
        return view('Frontend.jungle_safari');
    }

    public function hotel()
    {
        $hotel=Hotel::orderBy('sequence','asc')->get();
        return view('Frontend.hotel',['hotel'=>$hotel]);
    }

    public function hotel_view($name){
        $page = Hotel::where('seo_name', $name)->firstOrFail();
    
        $pageTitle = $page->meta_title;
        $pageKeywords = $page->meta_keyword;
        $pageDescription = $page->meta_description;
        $hotel_view=Hotel::where('seo_name', $name)->get();
        return view('Frontend.hotel_view',['hotel'=>$hotel_view,'pageTitle'=>$pageTitle,'pageKeywords'=>$pageKeywords,'pageDescription'=>$pageDescription]);
    }

    public function news()
    {
    $news = News::orderBy('id','desc')->get();
    return view('Frontend.latestnews',['news'=>$news]);
    }

    public function news_detail($name)
    {
    $page = News::where('seo_name', $name)->firstOrFail();
    $pageTitle = $page->meta_title;
    $pageKeywords = $page->meta_keywords;
    $pageDescription = $page->meta_description;
    $news = News::where('seo_name',$name)->get();
    return view('Frontend.newsdetail',['news'=>$news,'pageTitle'=>$pageTitle,'pageKeywords'=>$pageKeywords,'pageDescription'=>$pageDescription]);
    }


    public function submit_safari(Request $request)
      { 
        // dd($request->all());
            $formFields = $request->validate([
                'select_jeep' => 'required',
                'seats' => 'required',
                'zone' => 'required',
                'timing' => 'required',
                'name' => 'required|regex:/^[a-zA-Z\s]+$/',
                'mobile' => 'required|regex:/^[0-9]{10}$/',
                'email' => 'required|email',
                'date' => 'required',
            ],[
                    // Custom error messages
                'select_jeep.required' => 'Please select a jeep.',
                'seats.required' => 'Please specify the number of seats.',
                'zone.required' => 'Please choose a zone.',
                'timing.required' => 'Please select the timing for the safari.',
                'name.required' => 'Name is required.',
                'name.regex' => 'Name must only contain letters and spaces.',
                'mobile.required' => 'Mobile number is required.',
                'mobile.regex' => 'Mobile number must be exactly 10 digits.',
                'email.required' => 'Email address is required.',
                'email.email' => 'Please enter a valid email address.',
                'date.required' => 'Date is required.',
            ]);
            $formFields['query_at']=Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
            $jeep = $formFields['select_jeep'];
            $seats=$formFields['seats'];
             $r= rand('9999','99999');
            $formFields['booking_id']='SAFARI'.$r;
            $formFields['booking_type']=1;
            Session::put('data', $formFields);
            OnlineSafari::create($formFields);
            return view('Frontend.safari_book',['formFields' => $formFields, 'seats'=>$seats ,'select_jeep' =>$jeep ]);
      }

      public function getPrice(Request $request)
     {

        $nationality = $request->nationality;
        $data = Session::get('data');
        $safariType = $request->jeeptype;
        $numSeats = $request->seats;

        $price = null;

        $price = PriceSafari::where('nationality', $nationality)
        ->where('safari_type', $safariType)
        ->first();
         
        return response()->json(['price' => $price->price ]);
    }

        public function safari_payment(Request $request)
        {

          $input= $request->all();
          $data=Session::get('data');
          $data['razorpay_payment_id'] = $request->payment_id;
          $payment=$request->payment_id;
          Session::put('payment', $payment);
         
          $tour_id=OnlineSafari::create($data);
          $z= sizeof($input['name']);
          $name= request('name');
          $fname= request('fname');
          $gender= request('gender');
          $age=request('age');
          $nationality=request('nationality');
          $id_type=request('id_type');
          $id_no=request('id_no');
          $y=$z-1;
          for($i=0;$i<=$y;$i++){
              $traveller['name'] = $name[$i];
              $traveller['fname'] = $fname[$i];
              $traveller['gender'] = $gender[$i];
              $traveller['age'] = $age[$i];
              $traveller['nationality'] = $nationality[$i];
              $traveller['id_type'] = $id_type[$i];
              $traveller['id_no'] = $id_no[$i];
              $traveller['booking_id']= $tour_id->id;
              $travellers = Traveller::create($traveller);
          }
          return redirect()->route('onlinesafari')->with('msg','Booked Successful');
      }

       public function invoice($id)
      {
            $data=OnlineSafari::where('razorpay_payment_id',$id)->get();
            return view('backend_views.voucher', compact('data'));
      }

      public function download_voucher(Request $request)
      {
          $formfield['name']=$request->name;
          $formfield['mobile']=$request->mobile;
          $formfield['zone']=$request->zone;
          $formfield['select_jeep']=$request->select_jeep;
          $formfield['seats']=$request->seats;
          $formfield['date']=$request->date;
          $formfield['timing']=$request->timing;
          $formfield['safari_person']= $request->sname;
          $formfield['safari_phone_no']= $request->sphone;
          $id= $request->id;
          OnlineSafari::where('id',$id)->update($formfield);
          $data=OnlineSafari::find($id);
          return view('backend_views.invoice', compact('data'));

       }

    public function book_room(Request $request)
    {  
    $room_price=$request->room_price;
    $hotel= $request->hotel;
    $countries = Country::all();
    return view('Frontend.bookroom',['room_price'=>$room_price,'hotel'=>$hotel,'countries'=>$countries]);
    }

public function submithotelbooking(Request $request)
{
   $data=[
        'persons' => $request->persons,
        'hotel' => $request->hotel,
        'checkindate' => $request->checkindate,
        'rooms' => $request->rooms,
        'name' => $request->name,
        'email' => $request->email,
        'mobile' => $request->mobile,
        'city' => $request->city,
        'country' => $request->country,
        'price' => $request->price,
        'payment_id' => $request->payment_id,
      ];
    
     $formFields['query_at']=Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
     Hotelbooking::create($data);
    return redirect()->route('hotel')->with('success', 'Hotel Booked Successfully');
}

public function submit_modal_form(Request $request)
{
    try {
        // Validate the form fields
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'date' => 'required|date',
            'tel' => ['required', 'regex:/^[0-9]{10}$/'],
            'remark' => 'required|string',
        ],[
            'name.required' => 'The name field is mandatory.',
            'name.string' => 'The name must be a valid string.',
            'name.max' => 'The name cannot exceed 255 characters.',
            'name.regex' => 'The name can only contain alphabets and spaces.',
            'date.required' => 'The date of travel is required.',
            'date.date' => 'Please provide a valid date for travel.',
            'tel.required' => 'The mobile number is required.',
            'tel.regex' => 'Please enter a valid 10-digit mobile number.',
            'remark.required' => 'The remark field is required.',
            'remark.string' => 'The remark must be a valid string.',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        // Prepare data for insertion
        $formFields['name'] = $request->name;
        $formFields['date'] = $request->date;
        $formFields['tel'] = $request->tel;
        $formFields['remark'] = $request->remark;
        $formFields['query_at'] = Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');

        // Save the data
        ModelForm::create($formFields);
        return response()->json([
            'message' => 'Thank you for contacting us. We will get back to you shortly.'
        ], 200);
        // return redirect()->back()->with(['message' => 'Thank you for contacting us. We will get back to you shortly.']);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'An error occurred. Please try again later.'
        ], 500);
    }
}
    
     public function add_follow_up_remark(Request $request, ModelForm $contact){
     $formFields = $request->validate([
        'follow_up_remark' => 'required',
    ]);
    $formFields['follow_up_remark_date']=Carbon::now()->setTimezone('Asia/Kolkata')->format('Y-m-d H:i:s');
    $contact->update($formFields);

    return back()->with('successMessage', 'Remark added Succesfully');
    }
    
    
    public function tiger_story_view($name){
        
        $page = TigerStory::where('seo_name', $name)->firstOrFail();
        $pageTitle = $page->meta_title;
        $pageKeywords = $page->meta_keyword;
        $pageDescription = $page->meta_description;
        $tigerstory=TigerStory::where('seo_name', $name)->get();
        return view('Frontend.tigerstory_view',['tigerstory'=>$tigerstory,'pageTitle'=>$pageTitle,'pageKeywords'=>$pageKeywords,'pageDescription'=>$pageDescription]);
    }

  public function tourpackages()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        $tour = TourPackage::all();
        return view('Frontend.tour', ['tour' => $tour]);
    }

    public function tour_view($name)
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        $page = TourPackage::where('seo_name', $name)->firstOrFail();
        $pageTitle = $page->meta_title;
        $pageKeywords = $page->meta_keyword;
        $pageDescription = $page->meta_description;
        $tour = TourPackage::where('seo_name', $name)->get();
        $tour_view = TourView::where('what_for', $tour[0]->title)->get();
        return view('Frontend.tour_view', ['tour' => $tour, 'tour_view' => $tour_view,'pageTitle'=>$pageTitle,'pageKeywords'=>$pageKeywords,'pageDescription'=>$pageDescription]);
    }
    
     public function payment(){
        $countries = Country::all();
        return view('Frontend.paynow', compact('countries'));
    }

}
