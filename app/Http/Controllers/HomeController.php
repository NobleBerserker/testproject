<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialPost;

class HomeController extends Controller
{
    public function index()
    {
        $posts = SocialPost::with('latestReport')
        ->orderBy('created_time', 'desc')
        ->get();

        return view('home', compact('posts'));
    }
}
