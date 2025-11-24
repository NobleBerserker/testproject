<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SocialPost;
use App\Models\SocialReport;
use App\Services\FacebookService;
use Carbon\Carbon;
class FacebookPostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(FacebookService $fbService)
    {
        try {
            $data = $fbService->getId();
            $pageId = $data['id'] ?? null;

            if (!$pageId) {
                $this->command->error('Could not retrieve page ID.');
                return;
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
                SocialReport::create([
                    'social_post_id' => $socialPost->id,
                    'likes'          => $post['likes']['summary']['total_count'] ?? 0,
                    'comments'       => $post['comments']['summary']['total_count'] ?? 0,
                    'shares'         => $post['shares']['count'] ?? 0,
                ]);


            $count++;  
            }

            $this->command->info("$count posts seeded from Facebook.");
            $this->createTestPost();                
        } catch (\Exception $e) {
            $this->command->error("Error: " . $e->getMessage());
        }
    }
    //creates a test post with 10 days of reports for testing purposes.
    private function createTestPost()
    {
        $post = SocialPost::create([
            'facebook_id'  => 'test_post_' . uniqid(),
            'message'      => 'This is a generated test post for demonstration.',
            'created_time' => now()->subDays(10),
        ]);

        $likes = rand(1, 5);
        $comments = rand(0, 2);
        $shares = rand(0, 1);

        for ($i = 9; $i >= 0; $i--) {
            $likes += rand(0, 5);
            $comments += rand(0, 3);
            $shares += rand(0, 2);

            SocialReport::create([
                'social_post_id' => $post->id,
                'likes'          => $likes,
                'comments'       => $comments,
                'shares'         => $shares,
                'created_at'     => Carbon::now()->subDays($i)->startOfDay(),
                'updated_at'     => Carbon::now()->subDays($i)->startOfDay(),
            ]);
        }

        $this->command->info("Test post + 10-day reports added.");
    }
}
