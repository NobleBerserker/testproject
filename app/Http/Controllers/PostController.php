<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialPost;
use App\Models\SocialReport;

class PostController extends Controller
{
    public function index(SocialPost $post)
    {
        $startDate = now()->subDays(6)->startOfDay();
        $endDate = now()->endOfDay();

        // Fetch reports for this post in the last 7 days
        $reports = $post->reports()
            ->whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at')
            ->get();

        $dates = $likes = $comments = $shares = [];

        foreach ($reports as $report) {
            $dates[] = $report->created_at->format('d M');
            $likes[] = $report->likes;
            $comments[] = $report->comments;
            $shares[] = $report->shares;
        }

        return view('post', compact('post', 'dates', 'likes', 'comments', 'shares'));
    }
}