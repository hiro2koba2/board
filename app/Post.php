<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Like;

// medialibraryに必要なもの
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

// 画像Fileの調整で必要
use Spatie\MediaLibrary\File;

// Conversionへの登録に必要
use Spatie\MediaLibrary\Models\Media;

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

    public function like_by()
    {
      return Like::where('user_id', Auth::user()->id)->first();
    }

    public function registerMediaCollections()
    {
        $this
            ->addMediaCollection('postImages')
            ->singleFile()
            // これでアップロードできるのは一つだけ、一つ前のものは自動で削除

            // ->acceptsFile(function (File $file) {
            //     return $file->mimeType === 'image/png';
            // })
            // ファイルの種類を指定できる　pngのみにした

            ->registerMediaConversions(function (Media $media) {
                $this->addMediaConversion('card')
                // 縦幅を200とする、そこから横幅を同じ分取る
                    ->height(200)
                    ->width(200);
                $this->addMediaConversion('thumb')
                    ->height(50)
                    ->width(50);
            });
    }
}
