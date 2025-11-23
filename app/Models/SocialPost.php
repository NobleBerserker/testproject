<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialPost extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    protected $fillable = [
        'created_time',
        'message',
        'facebook_id',
    ];

    protected $casts = [
        'created_time' => 'datetime',
    ];
    
    public function report()
    {
        return $this->hasOne(SocialReport::class, 'social_post_id');
    }
}
