<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Author extends Model
{
    use HasFactory;
    protected $table='author';

    protected $fillable=['title','slug','designation','dob','country','email','phone','description','author_feature','facebook_id','twitter_id','youtube_id','pinterest_id','author_img','status'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = Str::slug($category->title);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->title);
        });
    }
}
