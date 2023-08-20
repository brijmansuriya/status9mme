<?php

namespace App\Models;

use App\Traits\HasAppDateTime;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends Model implements HasMedia
{
    use HasFactory, HasAppDateTime, InteractsWithMedia;
    protected $fillable = [
        'id',
        'post_id',
        'post_count',
    ];
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
