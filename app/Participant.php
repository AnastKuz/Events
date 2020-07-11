<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email'];
    protected $guarded = ['id','created_at','updated_at'];
}
