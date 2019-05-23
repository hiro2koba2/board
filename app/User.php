<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// medialibraryに必要なもの
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

// Fileの調整で必要
use Spatie\MediaLibrary\File;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * ユーザーに関連する投稿を取得
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * ユーザーに関連するコメントを取得
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function likes()
    {
      return $this->hasMany(Like::class);
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
            ->acceptsFile(function (File $file) {
                return $file->mimeType === 'image/png';
            });;
            // pngのみにできるがエラーの表示が違うものになる
    }
}
