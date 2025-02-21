<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $records=Media::latest()->paginate(10);
        return view('admin.media.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.media.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'media_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate a slug from the title
    $slug = Str::slug($request->title);
    
    // Ensure slug is unique
    $count = Media::where('slug', 'LIKE', "{$slug}%")->count();
    $slug = $count ? "{$slug}-" . ($count + 1) : $slug;

    // Handle Image Upload
    $imagePath = null;
    if ($request->hasFile('media_img')) {
        $image = $request->file('media_img');
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Unique filename
        $image->move(public_path('/uploads/medias'), $imageName); // Move image to folder
        $imagePath = '/uploads/medias/' . $imageName; // Save path to DB
    }

        Media::create([
            'title'=> $request->title,
            'slug'=> $slug,
            'media_type'=> $request->media_type,
            'media_img'=> $imagePath,
            'description'=> $request->description,
        ]);

        return redirect()->route('admin.medias.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $row=Media::where('slug', $slug)->firstOrFail();
        return view('admin.media.form', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */

     public function update(Request $request, $slug)
     {
         // Find the existing record by slug
         $medias = Media::where('slug', $slug)->firstOrFail();
     
         // Update title and slug if necessary
         if ($medias->title !== $request->title) {
             $medias->slug = Str::slug($request->title);
         }
     
         $medias->title = $request->title;
         $medias->media_type = $request->media_type;
         $medias->description = $request->description;
     
         // Check if new image is uploaded
         if ($request->hasFile('media_img')) {
             // Delete the old image if it exists
             $oldImagePath = public_path($medias->media_img);
             if (!empty($medias->media_img) && file_exists($oldImagePath)) {
                 unlink($oldImagePath); // Delete file from public folder
             }
     
             // Store the new image and save the path
             $image = $request->file('media_img');
             $imageName = time() . '.' . $image->getClientOriginalExtension();
             $image->move(public_path('/uploads/medias'), $imageName);
             $medias->media_img = '/uploads/medias/' . $imageName; // Store correct path
         }
     
         // Save the updated record
         $medias->save();
     
         return redirect()->route('admin.medias.index');
     }
     

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $record=Media::where('slug', $slug)->firstOrFail();
        $record->delete();
        return redirect()->route('admin.medias.index');
    }
}
