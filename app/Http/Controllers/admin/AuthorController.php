<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Author;
use App\Models\Admin\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */


public function index(Request $request)
{
    if ($request->ajax()) {
        $data = Author::latest()->select(['id', 'title', 'designation', 'author_img', 'status']);
        return DataTables::eloquent($data)
            ->addColumn('author_img', function ($row) {
                return $row->author_img 
                    ? '<img src="' . asset($row->author_img) . '" width="50" height="50">'
                    : 'No Image';
            })
            ->addColumn('status', function ($row) {
                return $row->status == 1 
                    ? '<button class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></button>'
                    : '<button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></button>';
            })
            ->addColumn('action', function ($row) {
                return '
                    <a href="'. route("admin.authors.edit", $row->id) .'" class="btn btn-info btn-flat btn-sm">
                        <i class="fa fa-edit"></i>
                    </a>
                    <form action="'. route("admin.authors.destroy", $row->id) .'" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field("DELETE") . '
                        <button type="submit" class="btn btn-danger btn-flat btn-sm" onclick="return confirm(\'Are you sure?\')">
                            <i class="fa fa-trash-o"></i>
                        </button>
                    </form>';
            })
            ->rawColumns(['author_img', 'status', 'action'])
            ->make(true);
    }

    $records=Author::latest();
    return view("admin.author.index", compact("records"));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries=Country::get();
        return view("admin.author.form" ,compact("countries"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
             $this->validate($request, [
        'title' => 'required',
        'author_img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
    ]);

    // Generate a slug from the title
    $slug = Str::slug($request->title);
    
    // Ensure slug is unique
    $count = Author::where('slug', 'LIKE', "{$slug}%")->count();
    $slug = $count ? "{$slug}-" . ($count + 1) : $slug;

    // Handle Image Upload
    $imagePath = null;
    if ($request->hasFile('author_img')) {
        $image = $request->file('author_img');
        $imageName = time() . '.' . $image->getClientOriginalExtension(); // Unique filename
        $image->move(public_path('/uploads/authors'), $imageName); // Move image to folder
        $imagePath = '/uploads/authors/' . $imageName; // Save path to DB
    }

    Author::create([
        'title' => $request->title,
        'slug'  => $slug,
        'designation' => $request->designation,
        'dob' => $request->dob,
        'country' => $request->country,
        'email' => $request->email,
        'phone' => $request->phone,
        'description' => trim($request->description),
        'author_feature' => $request->author_feature,
        'facebook_id' => $request->facebook_id,
        'twitter_id' => $request->twitter_id,
        'youtube_id' => $request->youtube_id,
        'pinterest_id' => $request->pinterest_id,
        'author_img' => $imagePath, // Store the image path in DB
    ]);

    return redirect()->route('admin.authors.index')->with('success', 'Author created successfully!');

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
        $row=Author::where('slug',$slug)->firstOrFail();
        return view('admin.author.form',compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $author=new Author();
        $author->title = $request->title;
        // Update slug only if title changes
        if ($author->title !== $request->title) {
            $author->slug = Str::slug($request->title);
        }
        $author->designation = $request->designation;
        $author->dob = $request->dob;
        $author->country = $request->country;
        $author->email = $request->email;
        $author->phone = $request->phone;
        $author->description = trim($request->description);
        $author->author_feature = $request->author_feature;
        $author->facebook_id = $request->facebook_id;
        $author->twitter_id = $request->twitter_id;
        $author->youtube_id = $request->youtube_id;
        $author->pinterest_id = $request->pinterest_id;
        if ($request->hasFile('author_img')) {
            // Delete the old image if it exists
            if ($author->author_img && Storage::exists($author->author_img)) {
                Storage::delete($author->author_img);
            }
    
            // Store the new image and save the path
            $path = $request->file('author_img')->store('authors'); // 'authors' is the folder in storage/app/public
            $author->author_img = $path;
        }        $author->save();
        return redirect()->route('admin.authors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        $category=Author::where('slug', $slug)->firstOrFail();
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
