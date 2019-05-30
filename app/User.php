<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// mediaとmodelを紐つけるために最初に必要なもの
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

// 画像Fileの調整で必要
use Spatie\MediaLibrary\File;

// Conversionへの登録に必要
use Spatie\MediaLibrary\Models\Media;

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

    // いいねは一度なしにする
    // public function likes()
    // {
    //   return $this->hasMany(Like::class);
    // }

    /**
     * mediaモデルへの登録
     */
    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('avatar')
            ->singleFile()
            // これでアップロードできるのは一つだけ、一つ前のものは自動で削除

            // ->acceptsFile(function (File $file) {
            //     return $file->mimeType === 'image/png';
            // })
            // ファイルの種類を指定できる　今はなし

            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('card')
                    ->width(200)
                    ->height(200);
                $this->addMediaConversion('thumb')
                    ->width(50)
                    ->height(50);
            });
    }
}
