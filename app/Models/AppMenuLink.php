<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\HasAppDateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class AppMenuLink extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, HasAppDateTime;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'show_name',
        'type',
        'value',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     *  returns the user app menu links
     */
    public function scopeUser($query)
    {
        return $query->where('for', 'user');
    }

    /**
     * get the generated link for the
     */
    public function getGeneratedLinkAttribute()
    {
        return  $this->type == "file" ? $this->file : route('menu.webview', $this->id);
    }

    /**
     *  deletes the file if exists
     */
    public function deleteFile()
    {
        $this->getFirstMedia('app-link/file') ? $this->getFirstMedia('app-link/file')->delete() : null;
    }

    /**
     * returns the file if found
     */
    public function getFileAttribute()
    {
        return $this->getFirstMedia('app-link/file') ? $this->getFirstMedia('app-link/file')->getFullUrl() : '';
    }

     /**
     * return the created at in EAT timezone
     */
    public function getCreatedAtAttribute($value)
    {
        // EAT timezone is UTC+3
        return Carbon::parse($value)->timezone(config('app.default_timezone'))->format(config('app.default_date_format'));
    }
}
