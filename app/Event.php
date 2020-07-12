<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['name', 'date', 'city'];
    protected $guarded = ['id','created_at','updated_at'];

    public function participant()
    {
        return $this->hasMany(Participant::class,'product_id','id');
    }
}
