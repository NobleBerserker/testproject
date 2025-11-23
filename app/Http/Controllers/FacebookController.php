<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\FacebookService;
use App\Models\SocialPost;
use App\Models\SocialReport;
use Carbon\Carbon;
class FacebookController extends Controller
{
    public function getPosts(FacebookService $fbService)
    {
        try {
            $data = $fbService->getId();
            $pageId = $data['id'] ?? null;

            if (!$pageId) {
                return response()->json([
                    'status'=>'error',
                    'message' => 'Could not retrieve page ID.',
                ], 400);
            }
            $count = 0;
            $posts = $fbService->getPosts($pageId)['data'] ?? [];

            foreach ($posts as $post) {
                if (empty($post['message'])) {
                    continue;
                }

                $socialPost = SocialPost::updateOrCreate(
                    ['facebook_id' => $post['id']],
                    [   'created_time' => Carbon::parse($post['created_time']),
                        'message' => $post['message'],
                    ]
                );
                SocialReport::updateOrCreate(
                    ['social_post_id' => $socialPost->id], // local DB ID
                    [
                        'likes' => $post['likes']['summary']['total_count'] ?? 0,
                        'comments' => $post['comments']['summary']['total_count'] ?? 0,
                        'shares' => $post['shares']['count'] ?? 0,
                    ]
                );


            $count++;  
            }

            return back()->with('success', "$count posts updated from Facebook.");
                
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }

}
