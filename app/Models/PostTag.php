<?php

namespace App\Models;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Visit;
use Laravel\Horizon\Tags;
use App\Traits\HasAppDateTime;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
// use \JordanMiguel\LaravelPopular\Traits\Visitable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostTag extends Model implements HasMedia
{
    use HasFactory, HasAppDateTime,InteractsWithMedia;
    protected $fillable = [
        'id',
        'post_id',
        'tag_id',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function post()
    {
        return $this->belongsToMany(Post::class,'id','post_id');
    }
    
    public function tag()
    {
        return $this->belongsTo(Tag::class,'tag_id','id');
    }
}