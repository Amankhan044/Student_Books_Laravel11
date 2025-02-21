<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Models\Admin\Country;
use App\Models\Admin\Author;
use App\Models\Admin\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.books.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries=Country::get();
        $authors=Author::get();
        $categories=Category::get();
        return view("admin.books.form", compact("countries", "authors", "categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
        ]);

        Book::create([
            'category_id'=> $request->category_id,
            'author_id'=> $request->author_id,
            'title'=> $request->title,
            'slug'=> $request->title,
            'availability'=> $request->availability,
            'price'=> $request->price,
            'rating'=> $request->rating,
            'publisher'=> $request->publisher,
            'country_of_publisher'=> $request->country_of_publisher,
            'isbn'=> $request->isbn,
            'isbn_10'=> $request->isbn_10,
            'audience'=> $request->audience,
            'format'=> $request->format,
            'language'=> $request->language,
            'total_pages'=> $request->total_pages,
            'downloaded'=> $request->downloaded,
            'edition_number'=> $request->edition_number,
            'recommended'=> $request->recommended,
            'description'=> $request->description,
            'book_img'=> $request->book_img,
            'book_upload'=> $request->book_upload,

        ]);
        return redirect()->route('admin.books.index');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
