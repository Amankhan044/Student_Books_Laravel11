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
        Schema::create('author', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('designation');
            $table->date('dob');  
            $table->string('country');
            $table->string('email');
            $table->string('phone');
            $table->text('description');
            $table->text('author_feature');
            $table->string('facebook_id');
            $table->string('twitter_id');
            $table->string('youtube_id');
            $table->string('pinterest_id');
            $table->string('author_img');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author');
    }
};
