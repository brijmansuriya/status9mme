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
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, HasAppDateTime,InteractsWithMedia,HasSEO;
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
        'category_id',
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'post_tags','post_id','tag_id');
    }

}

