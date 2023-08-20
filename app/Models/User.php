<?php

namespace App\Models;

use Exception;
use Carbon\Carbon;
use App\Models\Artist;
use DateTimeInterface;
use App\Models\Visitor;
use App\Models\PlayList;
use App\Models\WatchLog;
use App\Models\WatchList;
use App\Models\Searchable;
use App\Models\Notification;
use App\Traits\HasAppDateTime;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use App\Notifications\User\LoggedOut;
use Illuminate\Notifications\Notifiable;
use App\Notifications\User\DeleteAccount;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Notifications\User\LoggedOutInactive;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\User\AccountStatusUpdated;
use App\Notifications\User\toggleStatusLoggedOut;
use App\Notifications\User\MultipleLoginLoggedOut;
use App\Notifications\User\UserPermanentlyDeleted;
use App\Notifications\customPasswordResetNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, InteractsWithMedia, HasAppDateTime;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [

        'company_name',
        'title',
        'company_email',
        'company_phone',
        'country_code',
        'company_country_code',
        'city',
        'phone',
        'first_name',
        'last_name',
        'full_name',
        'email',
        'address',
        'city',
        'lat',
        'lng',
        'device_type',
        'email_verified_at',
        'website',
        'country_id',
        'booth_number',
        'other_title',
        'pincode'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('conversion')->format('webp');
    }


    /**
     *  expires all tokens of user and sends logged out to the last logged in user
     */
    public function expireAllTokens()
    {
        $this->tokens()->delete();
    }








    /**
     *  over ride the default password notification
     */
    public function sendPasswordResetNotification($token)
    {
        $userType = 'users';
        $email =  request()->get('email');
        $this->notify(new customPasswordResetNotification($token, $userType, $email));
    }

    public function deleteProfilePicture()
    {
        $this->getFirstMedia('customer/profile-picture') ? $this->getFirstMedia('customer/profile-picture')->delete() : null;
    }

    /**
     * returns the exhibitor default profile picture if found
     */
    public function getProfilePictureAttribute()
    {
        return $this->getFirstMedia('customer/profile-picture') ? $this->getFirstMedia('customer/profile-picture')->getFullUrl('conversion') : url('default_images/admin.png');
    }

    /**
     *  toggles the user status active/inactive
     */
    public function toggleStatus()
    {
        if ($this->status == "1") {
            //if it is deactivated then log out the device
            $this->status = (string) 0;
            $this->inactiveAccount();
            $this->device_token = null;
        } else {
            $this->status = (string) 1;
        }
        $this->notify(new AccountStatusUpdated());
        $this->update();
    }

    /**
     * permanently deletes the user
     */
    public function permanentlyDeleted()
    {
        $email = $this->email;
        $this->email = null;
        $this->username = null;
        $this->phone = null;
        $this->update();

        $this->deletedAccount();
        $this->expireAllTokens();
        $this->delete();

        Notification::route('mail', $email)->notify(new UserPermanentlyDeleted());
    }

    /**
     *  returns the active users
     */
    public function scopeActive($query)
    {
        return $query->where('status', '1');
    }

    /**
     *  datetime interface check
     */
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format(config('app.default_date_format'));
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
