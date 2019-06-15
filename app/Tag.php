<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
    ];

    /**
     * ポストとの多対多のリレーション
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
