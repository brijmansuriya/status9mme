<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Explorer;
use App\Models\Tag;
use App\Models\Visit;
use App\Traits\HasAppDateTime;
use Cohensive\OEmbed\Facades\OEmbed;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
// use \JordanMiguel\LaravelPopular\Traits\Visitable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Horizon\Tags;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
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
        'active',
        'status',
        'created_by',
        'categorie_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

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
