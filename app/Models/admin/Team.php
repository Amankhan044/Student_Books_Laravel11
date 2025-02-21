<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $table="team";
    protected $fillable = ['fullname', 'designation', 'telephone', 'mobile', 'email', 'facebook_id', 'twitter_id', 'pinterest_id', 'profile', 'team_img', 'status'] ;
}
