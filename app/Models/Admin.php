<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use App\Traits\HasAppDateTime;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\customPasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable implements HasMedia
{
    use  HasFactory, Notifiable, SoftDeletes, InteractsWithMedia, HasAppDateTime;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('conversion')->format('webp');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('app.default_date_format'));
    }
    /**
     *  over ride the default password notification
     */
    public function sendPasswordResetNotification($token)
    {
        $userType = request()->get('user_type');
        $email =  request()->get('email');
        $this->notify(new customPasswordResetNotification($token, $userType, $email));
    }


    /**
     *  deletes the profile picture of the user
     */
    public function deleteProfilePicture()
    {
        $this->getFirstMedia('admin/profile-picture') ? $this->getFirstMedia('admin/profile-picture')->delete() : null;
    }

    /**
     * returns the user default profile picture if found
     */
    public function getProfilePictureAttribute()
    {
        return $this->getFirstMedia('admin/profile-picture') ? $this->getFirstMedia('admin/profile-picture')->getFullUrl('conversion') : asset('default_images/admin.png');
    }

    /**
     * return the created at in EAT timezone
     */
    public function getCreatedAtAttribute($value)
    {
        // EAT timezone is UTC+3
        return Carbon::parse($value)->timezone(config('app.timezone'))->format(config('app.default_date_format'));
    }
}
