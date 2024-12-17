<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TourPackage;
use App\Models\TourView;
use Illuminate\Support\Facades\File;

class TourPackageController extends Controller
{
    public function add_tour_package_form(){
        return view('backend_views.add_tour_package');
    }

    public function submit_tour_package_form(Request $request)
      {
        try {
        $z= sizeof($request->day);
        $daydata= request('day');
        $daytitle= request('day_title');
        $daydescription = request('day_description');
        $daypic=request('photo');
        $y=$z-1;
           for($i=0;$i<=$y;$i++){
                $tourview['day'] = $daydata[$i];
                $tourview['title'] = $daytitle[$i];
                $tourview['description'] = $daydescription[$i];
                $tourview['what_for'] = $request->title; 
                if($daypic[$i]==''){
                $tourview= "No image";
                }
                else{
                    $tourview['image'] = $daypic[$i]->getClientOriginalName();
                }
                $tourdetails = TourView::create($tourview);
            }
            // dd($tourview);
            $photo = [];
            if ($request->photo)
            {
                foreach($request->photo as $key => $image)
                {
                    $imageName = $image->getClientOriginalName();  
                    $image->move(public_path('tourimage'), $imageName);
                    $data[] = $imageName;
                }
                $formFields['image'] =json_encode($data);
                $formFields['title'] =$request->title;
                $formFields['time'] =$request->time;
                $formFields['jeep'] =$request->jeep;
                $formFields['night_stay_time'] =$request->night_stay_time;
                $formFields['description'] =$request->description;
                $tourpackage = TourPackage::create($formFields);
                return redirect()->back()->with('successMessage', 'Content Added successfully');

      }
    }
    catch (\Exception $e) {
        return redirect()->back()
            ->withErrors(['dangerMessage' => 'An error occurred. Please try again later.']);
    }
}
public function update_tour_package_form(Request $request, $id)
{
    try {
        // Find the existing tour package by its ID
        $tourPackage = TourPackage::findOrFail($id);

        // Handle day-wise data for the tour view
        $z = sizeof($request->day);
        $daydata = $request->day;
        $daytitle = $request->day_title;
        $daydescription = $request->day_description;
        $daypic = $request->photo;

        // Update the related TourView for the tour package
        TourView::where('what_for', $tourPackage->title)->delete(); // Delete previous entries

        for ($i = 0; $i < $z; $i++) {
            $tourview['day'] = $daydata[$i];
            $tourview['title'] = $daytitle[$i];
            $tourview['description'] = $daydescription[$i];
            $tourview['what_for'] = $request->title; 

            if (!isset($daypic[$i]) || $daypic[$i] == '') {
                $tourview['image'] = "No image";
            } else {
                $tourview['image'] = $daypic[$i]->getClientOriginalName();
                $daypic[$i]->move(public_path('tourimage'), $tourview['image']);
            }

            // Create new TourView for each day
            TourView::create($tourview);
        }

        // Handle tour package image(s)
        if ($request->hasFile('photo')) {
            $photoData = [];
            foreach ($request->file('photo') as $image) {
                $imageName = $image->getClientOriginalName();
                $image->move(public_path('tourimage'), $imageName);
                $photoData[] = $imageName;
            }
            $tourPackage->image = json_encode($photoData);
        }

        // Update the other fields of the tour package
        $tourPackage->title = $request->title;
        $tourPackage->time = $request->time;
        $tourPackage->jeep = $request->jeep;
        $tourPackage->night_stay_time = $request->night_stay_time;
        $tourPackage->description = $request->description;

        // Save the updated data
        $tourPackage->save();

        return redirect()->back()->with('successMessage', 'Tour Package updated successfully');
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['dangerMessage' => 'An error occurred. Please try again later.']);
    }
}

      public function show_tour_package_details()
      {
          $TourPackage= TourPackage::all();
          return view('backend_views.tour_package_details',['data'=>$TourPackage]);
      }

      public function tour_view_details(TourPackage $tour, TourView $tour_view){
        $tour=TourPackage::where('id', $tour->id)->get();
        // dd($tour->title);
        $tour_view=TourView::where('what_for',$tour[0]->title)->get();
        // dd($tour_view);
        return view('backend_views.tour_view_details', ['tour'=>$tour , 'tour_view'=>$tour_view]);
       }



       public function tour_edit_details(TourPackage $tour ,$id){
        $tour = TourPackage::find($id);
        $tour_view=TourView::where('what_for',$tour->title)->get();
        // dd($tour_view);
        // Check if the tour package exists
        if (!$tour) {
            return redirect()->back()->with('error', 'Tour package not found.');
        }
    
        // Optionally fetch related views if needed
        // $tour_view = TourView::where('what_for', $tour->title)->get();
    
        // Pass the tour package to the view
        return view('backend_views.tour_edit_details', ['tour' => $tour,'tour_view'=>$tour_view]);
       }




      public function delete_tour(Request $request, TourPackage $TourPackage)  
{
    // Find records in tour_views table where what_for column matches TourPackage title
    $viewsToDelete = TourView::where('what_for', $TourPackage->title)->get();

    // Delete matching records from tour_views table
    foreach ($viewsToDelete as $view) {
        $view->delete();
    }

    // Delete image file
    $destination = public_path() . "/tourimage/" . $TourPackage->image;
    if (file_exists($destination)) {
        File::delete($destination);
    }

    // Delete the TourPackage record
    $TourPackage->delete(); 

    return redirect()->back()->with('successMessage', 'Content Deleted successfully');
}

}
