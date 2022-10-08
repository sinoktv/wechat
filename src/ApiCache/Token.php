<?php

namespace WeWork\ApiCache;

use WeWork\Traits\CorpIdTrait;
use WeWork\Traits\HttpClientTrait;
use WeWork\Traits\SecretTrait;

class Token extends AbstractApiCache
{
    use CorpIdTrait, SecretTrait, HttpClientTrait;
	
	public $token_expires_in = 7100;
    /**
     * @return string
     */
    protected function getCacheKey(): string
    {
        $unique = md5($this->secret);
//var_dump($this->secret);var_dump('wework.api.token.1' . $unique);
        return md5('wework.api.token.' . $unique);
    }

    /**
     * @return string
     */
    protected function getFromServer(): string
    {
        $data = $this->httpClient->get('gettoken', ['corpid' => $this->corpId, 'corpsecret' => $this->secret]);
//var_dump($this->corpId);var_dump($this->secret);var_dump($data);
		$this->token_expires_in = isset($data['expires_in']) ? $data['expires_in'] : $this->token_expires_in;
		return $data['access_token'];
		//return $data;
    }
}
