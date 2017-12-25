<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Like extends Model
{
    //go put this method in any model u want to be liked for example posts
    public function likeable()
    {
      return $this->morphTo();
    }
    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
