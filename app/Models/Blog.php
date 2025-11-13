<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'slug',
        'is_published',
        'user_id',
        'category',
        'blog_status',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = static::generateUniqueSlug($blog->title);
            }
        });
    }

    /**
     * Generate a unique slug for the blog post
     *
     * @param string $title
     * @param int|null $excludeId Blog ID to exclude from uniqueness check (for updates)
     * @return string
     */
    public static function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        // Check if slug exists, and if so, append a number until we find a unique one
        while (static::where('slug', $slug)
            ->when($excludeId, function ($query) use ($excludeId) {
                return $query->where('id', '!=', $excludeId);
            })
            ->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return app()->environment('production') ?
                secure_asset('storage/' . $this->image) :
                asset('storage/' . $this->image);
        }
        // Return a placeholder image if no image is set - use HTTPS
        return 'https://picsum.photos/400/200?random=' . $this->id;
    }

    public function scopePublished($query)
    {
        // Check if blog_status column exists
        $hasBlogStatus = Schema::hasColumn('blogs', 'blog_status');

        if ($hasBlogStatus) {
            return $query->where(function ($q) {
                $q->where('is_published', true)
                  ->orWhere('blog_status', 'published');
            });
        } else {
            // Fallback to is_published only if blog_status column doesn't exist
            return $query->where('is_published', true);
        }
    }
}
