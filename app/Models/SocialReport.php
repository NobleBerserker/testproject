<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'social_post_id',
        'likes',
        'comments',
        'shares'
    ];
    
    public function post()
    {
        return $this->belongsTo(SocialPost::class, 'social_post_id');
    }
}
