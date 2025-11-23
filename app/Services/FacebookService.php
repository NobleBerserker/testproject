<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class FacebookService
{
	protected string $token;

	public function __construct()
	{
		$this->token = env('META_ACCESS_TOKEN');
	}

	private function request(string $url, array $params = [])
	{
	    $verify = env('APP_ENV') === 'local' ? false : true;
	    $response = Http::withOptions(['verify' => $verify])->get($url, $params);

	    if ($response->failed()) {
	        throw new \Exception('Facebook API request failed: ' . $response->body());
	    }

	    return $response->json();
	}

	public function getId()
	{
	    return $this->request('https://graph.facebook.com/v24.0/me', [
	        'access_token' => $this->token,
	    ]);
	}

	public function getPosts($pageId)
	{
	    return $this->request("https://graph.facebook.com/v24.0/{$pageId}/feed", [
	        'access_token' => $this->token,
	        'fields' => 'id,message,created_time,shares,likes.summary(true),comments.summary(true)',
	    ]);
	}
}