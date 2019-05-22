<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// medialibraryに必要なもの
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $fillable = [
        'title',
        'body',
        'user_id',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    public function likes()
    {
      return $this->hasMany('App\Like');
    }

    // public function like_by()
    // {
    //   return Like::where('user_id', Auth::user()->id)->first();
    // }
}
