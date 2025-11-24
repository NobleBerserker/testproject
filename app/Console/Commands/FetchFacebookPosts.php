<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\FacebookService;
use App\Models\SocialPost;
use App\Models\SocialReport;
use Carbon\Carbon;

class FetchFacebookPosts extends Command
{
    protected $signature = 'app:fetch-facebook-posts';
    protected $description = 'Fetch latest Facebook posts and store daily reports';

    public function handle(FacebookService $fbService)
    {
        try {
            $data = $fbService->getId();
            $pageId = $data['id'] ?? null;

            if (!$pageId) {
                $this->error('Could not retrieve page ID.');
                return 1;
            }

            $posts = $fbService->getPosts($pageId)['data'] ?? [];
            $count = 0;

            foreach ($posts as $post) {
                if (empty($post['message'])) {
                    continue;
                }

                $socialPost = SocialPost::updateOrCreate(
                    ['facebook_id' => $post['id']],
                    [
                        'created_time' => Carbon::parse($post['created_time']),
                        'message' => $post['message'],
                    ]
                );

                $reportExists = SocialReport::where('social_post_id', $socialPost->id)
                ->whereDate('created_at', today())
                ->exists();

                if (!$reportExists) {
                    SocialReport::create([
                        'social_post_id' => $socialPost->id, 
                        'likes' => $post['likes']['summary']['total_count'] ?? 0,
                        'comments' => $post['comments']['summary']['total_count'] ?? 0,
                        'shares' => $post['shares']['count'] ?? 0,
                    ]);
                }
                $count++;
            }

            $this->info("$count posts updated from Facebook.");

        } catch (\Exception $e) {
            $this->error($e->getMessage());
            return 1;
        }

        return 0;
    }
}
