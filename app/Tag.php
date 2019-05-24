<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
    ];

    /**
     * userに所属する役目を取得
     */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
}
