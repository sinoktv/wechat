<?php

namespace WeWork\ApiCache;

use WeWork\Traits\HttpClientTrait;
use WeWork\Traits\SecretTrait;

class JsApiTicket extends AbstractApiCache
{
    use SecretTrait, HttpClientTrait;
	
	public $token_expires_in = 7100;
    /**
     * @return string
     */
    protected function getCacheKey(): string
    {
        $unique = md5($this->secret);

        return md5('wework.api.js_ticket.' . $unique);
    }

    /**
     * @return string
     */
    protected function getFromServer(): string
    {
        $data = $this->httpClient->get('get_jsapi_ticket');
		$this->token_expires_in = isset($data['expires_in']) ? $data['expires_in'] : $this->token_expires_in;
        return $data['ticket'];
    }
}
