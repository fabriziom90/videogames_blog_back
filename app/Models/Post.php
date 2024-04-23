<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id', 'slug', 'cover_image', 'approved', 'content', 'category_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function image_gallery_post(){
        return $this->hasMany(ImageGalleryPost::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function generateSlug($title)
    {
        return Str::slug($title, '-');
    }
}
