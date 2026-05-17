<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'image',
        'status',
        'featured',
        'spotlight',
        'trashed_reason',
        'category_id',
        'view_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function likes()
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->latest();
    }

    public function allComments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function isLikedBy($user)
    {
        if (!$user)
            return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // Kalau sudah URL penuh
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Ambil konfigurasi Supabase (jika ada di local)
        $supabaseUrl = config('services.supabase.url');
        $bucket = config('services.supabase.bucket');

        if ($supabaseUrl && $bucket) {
            return rtrim($supabaseUrl, '/') . '/storage/v1/object/public/' . $bucket . '/' . ltrim($this->image, '/');
        }

        // Jika dideploy di Laravel Cloud / R2 / S3
        if (env('AWS_URL')) {
            return rtrim(env('AWS_URL'), '/') . '/' . ltrim($this->image, '/');
        }

        // Fallback ke Laravel Storage URL
        try {
            return Storage::disk('supabase')->url($this->image);
        } catch (\Exception $e) {
            return asset('storage/' . $this->image);
        }
    }
}