<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

// mediaとmodelを紐つけるために最初に必要なもの
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

// 例外処理　結局Laravel内部のバリデーションで解決したのでコメントアウト
// use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

// 画像Fileの調整で必要
use Spatie\MediaLibrary\File;

// Conversionへの登録に必要
use Spatie\MediaLibrary\Models\Media;

// jwtでのAPI認証のため
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements HasMedia, JWTSubject
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


    // JWT認証で追加

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }



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

    // いいね機能のもの
    public function likes()
    {
      return $this->hasMany('App\Like');
    }

    /**
     * mediaモデルへの登録（Laravel medialibrary）
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
            ->singleFile()
            // これでアップロードできるのは一つだけ、一つ前のものは自動で削除

            ->registerMediaConversions(function (Media $media) {

            $this->addMediaConversion('thumb');

        });

    }
}
