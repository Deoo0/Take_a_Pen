<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        // 'image',
        'title',
        'slug',
        'content',
        'image',
        'category_id',
        'user_id',
        'published_at',
    ];
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->width(400);

        $this
            ->addMediaConversion('large')
            ->width(1200);
    }
    public function claps()
    {
        return $this->hasMany(Clap::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function readTime($wordsPerMinute = 200)
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $minutes = ceil($wordCount / $wordsPerMinute); // Assuming average reading speed of 200 words per minute
        return max(1, $minutes);
    }

    public function imageUrl($conversionName = '')
    {
        return $this->getFirstMedia()?->getUrl($conversionName);
    }
}
