<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\MediaStream;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $table = 'category';
    protected $fillable = ['name', 'status','slug'];
    protected $orderBy = ['id' => 'desc'];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];
   
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('conversion')->format('webp');
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

     /**
     * returns the user default profile picture if found
     */
    public function getCategoryImageAttribute()
    {
        // return $this->getFirstMedia('image') ? $this->getFirstMedia('image')->getFullUrl() : asset('default_images/admin.png');
        return $this->getFirstMedia('image') ? $this->getFirstMedia('image')->getUrl('conversion') : asset('default_images/admin.png');
    }

      /**
     *  deletes the profile picture of the user
     */
    public function deleteImage()
    {
        $this->getFirstMedia('image') ? $this->getFirstMedia('image')->delete() : null;
    }


    /**
     * return the created at in EAT timezone
     */
    public function getCreatedAtAttribute($value)
    {
        // EAT timezone is UTC+3
        return Carbon::parse($value)->timezone(config('app.default_timezone'))->format(config('app.default_date_format'));
    }

    /**
     * Get all of the comments for the post
     *
     */
    public function post()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * chack post is available show this cetegory  
     */
    public function scopeAvailable($query)
    {
        return $query->whereHas('post',function($query){
            $query->active();
        });
    }


}
