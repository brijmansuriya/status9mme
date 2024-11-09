<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\MediaStream;

class Image extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'name',
        'path',
        'status',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;


    public function deleteImage()
    {
        $this->getFirstMedia('image') ? $this->getFirstMedia('image')->delete() : null;
    }

    public function getImageAttribute()
    {
        return $this->getFirstMedia('image') ? $this->getFirstMedia('image')->getFullUrl('conversion') : $this->getFullUrl() ?? url('default_images/admin.png');
    }
    
    public function status(){
        return $this->status == 1 ? 'Active' : 'Inactive';
    }

    
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('conversion')->format('webp');
    }

}
