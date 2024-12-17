<?php

namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class NewsController extends Controller
{
    
    public function news()
    {
      return view('backend_views.news');
    }
    
     public function submit_news(Request $request)
    {
        $formFields = $request->validate([
            'date' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg,avif,webp',
            'alt' => 'required',
            'seo_name' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);

        try {
            if ($request->file('image')) {
                $file = $request->file('image');
                $imagename = time() . '_' .$file->getClientOriginalName();
                $imagePath = 'news/' . $imagename;
                $file->move(public_path('news'), $imagename);
                $formFields['image'] = $imagePath;
            }

            News::create($formFields);
            return redirect(route('news'))->with('successMessage', 'Content Added successfully');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect(route('news'))->with('dangerMessage', 'Something Went Wrong');
        }
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/news_images'), $fileName);
            $url = asset('uploads/news_images/' . $fileName);

            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'File not uploaded'], 400);
    }

      public function show_news_details()
      {
          $news= News::all();
          return view('backend_views.news_detail',['data'=>$news]);
      }

      public function delete_news(Request $request, News $news)  
      {  
          $destination = public_path()."/news/".$news->image;
          if(file::exists($destination))
          {
              file::delete($destination);
          }
          $news->delete(); 
          return redirect()->back()->with('successMessage','Content Deleted successfully');
      } 
      
      public function update_news(Request $request, $id)  
      {  
        $news = News::findOrFail($id); 
        return view('backend_views.update_news',['data'=>$news]);
      }
      
      public function submit_update_news(Request $request, $id)
    {
        $formFields = $request->validate([
            'date' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg,avif,webp',
            'alt' => 'required',
            'seo_name' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);

        try {
            $blog = News::findOrFail($id);
            if ($request->hasFile('image')) {
                $oldImage = $blog->image;
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $imagePath = 'news/' . $imageName;
                $image->move(public_path('news'), $imageName);
                $formFields['image'] = $imagePath;
                if ($oldImage && file_exists(public_path($oldImage))) {
                    unlink(public_path($oldImage));
                }
            }
            $blog->update($formFields);
            return redirect(route('show_news_details'))->with('successMessage', 'Content Update successfully');
        } 
        catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect(route('show_news_details'))->with('dangerMessage', 'Something Went Wrong');
        }
    }
       
}
