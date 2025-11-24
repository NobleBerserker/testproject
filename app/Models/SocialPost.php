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

    public function latestReport()
    {
        return $this->hasOne(SocialReport::class, 'social_post_id', 'id')
        ->latest('created_at');
    }    
    public function reports()
    {
        return $this->hasMany(SocialReport::class, 'social_post_id', 'id');
    }

    public function getLikesAttribute()
    {
        return $this->latestReport?->likes ?? 0;
    }

    public function getCommentsAttribute()
    {
        return $this->latestReport?->comments ?? 0;
    }

    public function getSharesAttribute()
    {
        return $this->latestReport?->shares ?? 0;
    }

    public function getRouteKeyName()
    {
        return 'facebook_id';
    }
}
