<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail, HasMedia
//Added to verify the with email
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'bio',
        'image',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('avatar')
            ->width(128) // Resize to width of 128px
            ->crop(128, 128); // Crop to center with width and height of 128px
    }
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatars')
            ->singleFile();
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id');
    }
    public function isFollowedBy(?User $user)
    {
        if (!$user) {
            return false; // If no user is provided, return false
        }
        return $this->followers()->where('follower_id', $user->id)->exists();
    }
    public function hasClapped(Post $post)
    {
        return $post->claps()->where('user_id', $this->id)->exists();
    }

    public function imageUrl()
    {
        return $this->getFirstMedia('avatar')?->getUrl('avatar');
    }
}
