<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogGallery;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BlogGalleryController extends Controller

{
    public function add_blog_gallery(){
	return view('backend_views.add_blog_gallery');
	}
	
	public function submitBlogGallery(Request $request)
{
    try {
        // Validate input
        $request->validate([
            'blog_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,avif,webp',
            'alt_text.*' => 'required|string',
        ]);

        // Get uploaded images and alt texts
        $images = $request->file('blog_image');
        $altTexts = $request->input('alt_text');

        foreach ($images as $key => $image) {
            // Handle file upload
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/blog_images'), $imageName);

            // Save image and its respective alt text in the database
            BlogGallery::create([
                'blog_image' => 'uploads/blog_images/' . $imageName,
                'alt_text' => isset($altTexts[$key]) ? trim($altTexts[$key]) : null,
            ]);
        }

        return redirect()->back()->with('successMessage', 'Blog gallery images uploaded successfully!');
    } catch (\Exception $e) {
        \Log::error('Error uploading blog gallery: ' . $e->getMessage());

        return redirect()->back()->with('dangerMessage', 'An error occurred while uploading the blog gallery. Please try again.');
    }
}

	
	public function blog_gallery_details()
	{
		$bloggallery= BlogGallery::all();
        return view('backend_views.blog_gallery_details',['data'=>$bloggallery]);
	}
	
	public function submitimageupdate(Request $request, $id)
    {
    $formFields = $request->validate([
        'blog_image' => 'image|mimes:jpeg,png,jpg,gif,svg,avif,webp',
        'alt_text' => 'required',
    ]);
    try {
    $blog = BlogGallery::findOrFail($id);
    if ($request->hasFile('blog_image')) {
        $oldImage = $blog->blog_image;
        $image = $request->file('blog_image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $imagePath = 'uploads/blog_images/' . $imageName;
        $image->move(public_path('uploads/blog_images'), $imageName);
        $formFields['blog_image'] = $imagePath;
        if ($oldImage && file_exists(public_path($oldImage))) {
            unlink(public_path($oldImage));
        }
    }
    $blog->update($formFields);
    return back()->with('successMessage', 'Image updated successfully');
    }
     catch (\Exception $e) {
        \Log::error('Image update failed: ' . $e->getMessage());
        return back()->with('dangerMessage', 'Something went wrong while updating the image. Please try again.');
    }
    }

	
	public function delete_blog_gallery(Request $request, $id)  
    {  
        $gallery = BlogGallery::findOrFail($id); 
        $destination = public_path($gallery->blog_image);
        if (File::exists($destination)) {
            File::delete($destination);
        }
        $gallery->delete(); 
        return redirect()->back()->with('successMessage', 'Image Deleted successfully');
    } 
	
}
