<?php

namespace App\Models;

use App\Models\ExplorerPost;
use App\Traits\HasAppDateTime;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\MediaLibrary\InteractsWithMedia;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Explorer extends Model implements HasMedia, Viewable
{
    use HasFactory, HasAppDateTime, InteractsWithMedia, HasSEO, InteractsWithViews;
    protected $fillable = ['title', 'keywords', 'description', 'image', 'slug'];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('conversion')->format('webp');
    }
    
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'explorers_posts');
    }

    /**
     *  deletes the profile picture of the user
     */
    public function deleteFile()
    {
        $this->getFirstMedia('explorer/image') ? $this->getFirstMedia('explorer/image')->delete() : null;
    }

    /**
     * returns the user default profile picture if found
     */
    public function getImageAttribute()
    {
        return $this->getFirstMedia('explorer/image') ?
         $this->getFirstMedia('explorer/image')->getFullUrl('conversion') :
          asset('default_images/admin.png');
    }

}
