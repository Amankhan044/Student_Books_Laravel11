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
        Schema::create('team', function (Blueprint $table) {
            $table->id();                        
            $table->string('fullname');          
            $table->string('designation');       
            $table->string('telephone');         
            $table->string('mobile');           
            $table->string('email');             
            $table->string('facebook_id');       
            $table->string('twitter_id');       
            $table->string('pinterest_id');      
            $table->text('profile');            
            $table->string('team_img');          
            $table->string('status');            
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team');
    }
};
