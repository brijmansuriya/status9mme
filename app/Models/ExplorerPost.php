<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExplorerPost extends Model
{
    use HasFactory;

    protected $fillable = ['explorer_id', 'post_id'];

    public function explorer()
    {
        return $this->belongsTo(Explorer::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
