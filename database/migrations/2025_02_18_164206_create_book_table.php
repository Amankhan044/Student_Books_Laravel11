<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id'); // Foreign key for category
            $table->foreignId('author_id');   
            $table->string('title');
            $table->string('slug');
            $table->string('availability');
            $table->string('price');
            $table->string('rating');
            $table->string('publisher');
            $table->string('country_of_publisher');
            $table->string('isbn');
            $table->string('isbn_10');
            $table->string('audience');
            $table->string('format');
            $table->string('language');
            $table->string('total_pages');
            $table->string('downloaded');
            $table->string('edition_number');
            $table->string('recommended');
            $table->text('description');
            $table->string('book_img');
            $table->string('book_upload');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
