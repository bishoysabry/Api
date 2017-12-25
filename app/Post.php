<?php

namespace App;
use App\Like;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Orderable;

class Post extends Model
{
  use Orderable;
  protected $fillable=['title','body'];
    //
    public function topic()
    {
    return  $this->belongsTo(Topic::class);
    }
    public function user()
    {
    return  $this->belongsTo(User::class);
    }
// here to make post likeable
    public function likes()
    {
      return $this->morphMany(Like::class,'likeable');
    }
}
