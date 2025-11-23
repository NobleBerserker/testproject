<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialPost;

class PostController extends Controller
{
    public function index($postId)
    {
        $post = SocialPost::where('facebook_id', $postId)->firstOrFail();

        return view('post', compact('post'));
    }
}
