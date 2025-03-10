<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Category;
use App\Models\Admin\Author;

class Book extends Model
{
    use HasFactory;
    protected $table = "book";
    protected $fillable = [
        'category_id',
        'author_id',
        'title',
        'slug',
        'availability',
        'price',
        'rating',
        'publisher',
        'country_of_publisher',
        'isbn',
        'isbn_10',
        'audience',
        'format',
        'language',
        'total_pages',
        'downloaded',
        'edition_number',
        'recommended',
        'description',
        'book_img',
        'book_upload',
        'status',
    ];

    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }

    public function author(){
        return $this->belongsTo(Author::class,'author_id');
    }
}
