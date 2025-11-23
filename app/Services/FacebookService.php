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

	public function testConnection()
	{	
		$verify = env('APP_ENV') === 'local' ? false : true;
		return Http::withOptions([
            'verify' => $verify
        ])->get('https://graph.facebook.com/v24.0/me', [
            'access_token' => $this->token,
        ]);
	}
}