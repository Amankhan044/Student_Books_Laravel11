<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Book;
use App\Models\Admin\Country;
use App\Models\Admin\Author;
use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Book::with(['author', 'category'])->select(['id', 'title', 'author_id', 'category_id', 'book_img', 'status']);
            
            return DataTables::of($data)
                ->addColumn('author', function ($row) {
                    return !empty($row->author) ? $row->author?->title : 'Unknown';
                })
                ->addColumn('category', function ($row) {
                    return !empty($row->category) ? $row->category?->title : 'Uncategorized';
                })
                ->addColumn('book_img', function ($row) {
                    return $row->book_img
                        ? '<img src="' . asset($row->book_img) . '" width="100">'
                        : '<img src="/assets/admin/img/no-image.png" width="100">';
                })
                ->addColumn('status', function ($row) {
                    return $row->status == 1
                        ? '<button class="btn btn-info btn-sm"><i class="fa fa-thumbs-up"></i></button>'
                        : '<button class="btn btn-danger btn-sm"><i class="fa fa-thumbs-down"></i></button>';
                })
                ->addColumn('action', function ($row) {
                    return '
                        <a href="'. route("admin.books.edit", $row->id) .'" class="btn btn-info btn-flat btn-sm">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="'. route("admin.books.destroy", $row->id) .'" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field("DELETE") . '
                            <button type="submit" class="btn btn-danger btn-flat btn-sm" onclick="return confirm(\'Are you sure?\')">
                                <i class="fa fa-trash-o"></i>
                            </button>
                        </form>';
                })
                ->rawColumns(['book_img', 'status', 'action'])
                ->make(true);
        }
        $rows = Book::latest();
        return view("admin.books.index", compact("rows"));
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
        $book = Book::findOrFail($id);
        $countries = Country::all();
        $authors = Author::all();
        $categories = Category::all();
        
        return view("admin.books.form", compact("book", "countries", "authors", "categories"));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'title' => 'required',
        ]);
    
        $book = Book::findOrFail($id);
    
        $book->update([
            'category_id' => $request->category_id,
            'author_id' => $request->author_id,
            'title' => $request->title,
            'slug' => $request->title,
            'availability' => $request->availability,
            'price' => $request->price,
            'rating' => $request->rating,
            'publisher' => $request->publisher,
            'country_of_publisher' => $request->country_of_publisher,
            'isbn' => $request->isbn,
            'isbn_10' => $request->isbn_10,
            'audience' => $request->audience,
            'format' => $request->format,
            'language' => $request->language,
            'total_pages' => $request->total_pages,
            'edition_number' => $request->edition_number,
            'recommended' => $request->recommended,
            'description' => $request->description,
            'book_img' => $request->book_img,
        ]);
    
        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
    
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');
    }
    
}
