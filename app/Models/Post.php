<?php

namespace App\Models;

use App\Models\Visit;
use Laravel\Horizon\Tags;
use App\Traits\HasAppDateTime;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\MediaLibrary\InteractsWithMedia;
// use \JordanMiguel\LaravelPopular\Traits\Visitable;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia, Viewable
{
    public const YOUTUBE = 'www.youtube.com';
    public const YOUTUBE_SORT_PATH = 'shorts';
    use HasFactory, HasAppDateTime, InteractsWithMedia, HasSEO, InteractsWithViews;
    protected $fillable = [
        'id',
        'title',
        'keyword',
        'slug',
        'image',
        'description',
        'meta_description',
        'url',
        'video_type',
        'active',
        'status',
        'created_by',
        'categorie_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    //constnts YOUTUBE_short
    public const YOUTUBE_VIDEO  = '0';
    public const YOUTUBE_SHORT  = '1';
    public const NORMAL_VIDEO  = '2';

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('conversion')->format('webp');
    }

    public function getDynamicSEOData(): SEOData
    {
        $pathToFeaturedImageRelativeToPublicPath = // ..;
            // Override only the properties you want:
            $data = new SEOData($this->title, $this->excerpt, $this->image);
        return $data;
    }
    /**
     *  deletes the profile picture of the user
     */
    public function deleteFile()
    {
        $this->getFirstMedia('post/image') ? $this->getFirstMedia('post/image')->delete() : null;
    }

    /**
     * returns the user default profile picture if found
     */
    public function getImageAttribute()
    {
        return $this->getFirstMedia('post/image') ?
            $this->getFirstMedia('post/image')->getFullUrl('conversion') :
            asset('default_images/admin.png');
    }

    /**
     * get the generated link for the
     */
    public function getGeneratedLinkAttribute()
    {
        return route('menu.post.webview', $this->id);
    }

    public function toggleStatus()
    {
        if ($this->status == 1) {
            $this->status = (string) 0;
        } else {
            $this->status = (string) 1;
        }
        $this->update();
    }

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    //get all post explores and use exploer show direct post
    public function explorers()
    {
        return $this->belongsToMany(Explorer::class, 'explorers_posts');
    }

    // Scope for available posts
    public function scopeAvailable($query)
    {
        return $query->active();
    }
}
