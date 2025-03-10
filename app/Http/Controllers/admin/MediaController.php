<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;


class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {  
        if ($request->ajax()) {
            $data = Media::select(['id', 'title', 'media_type', 'media_img', 'status', 'slug']);
            
            return DataTables::of($data)
                ->addColumn('media_img', function ($row) {
                    return $row->media_img
                        ? '<img src="' . asset($row->media_img) . '" width="50" height="50">'
                        : 'No Image';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<button class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></button>'
                        : '<button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></button>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="'. route("admin.medias.edit", $row->slug) .'" class="btn btn-info btn-flat btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="'. route("admin.medias.destroy", $row->slug) .'" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger btn-flat btn-sm" onclick="return confirm(\'Are you sure?\')">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>';
                })
                ->rawColumns(['media_img', 'status', 'action'])
                ->make(true);
        }
        $records=Media::latest();
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
