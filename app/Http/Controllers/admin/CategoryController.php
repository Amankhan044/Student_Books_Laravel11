<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $record = Category::latest()->paginate(10);
        return view("admin.categories.index", compact("record"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categories.form");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
    
        // Generate a slug from the title
        $slug = Str::slug($request->title);
    
        // Ensure slug is unique
        $count = Category::where('slug', 'LIKE', "{$slug}%")->count();
        $slug = $count ? "{$slug}-" . ($count + 1) : $slug;
    
        // Create the category
        $category = Category::create([
            'title' => $request->title,
            'slug'  => $slug,
            'description' => trim($request->description),
        ]);
    
        return redirect()->route('admin.categories.index');
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
        $row = Category::where('slug', $slug)->firstOrFail(); // ✅ Corrected
        return view("admin.categories.form", compact("row"));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail(); // ✅ Corrected
    
        $category->title = $request->title;
        
        // Update slug only if title changes
        if ($category->title !== $request->title) {
            $category->slug = Str::slug($request->title);
        }
    
        $category->description = $request->description;
        $category->save();
    
        return redirect()->route('admin.categories.index');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::where('slug', $id)->firstOrFail();
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
