<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Post;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $fillable = ['name', 'status', 'slug'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

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
     * return the created at in EAT timezone
     */
    public function getCreatedAtAttribute($value)
    {
        // EAT timezone is UTC+3
        return Carbon::parse($value)->timezone(config('app.default_timezone'))->format(config('app.default_date_format'));
    }

    /**
     * Get all of the comments for the Tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
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
