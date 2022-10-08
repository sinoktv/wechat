<?php

namespace WeWork\ApiCache;

use WeWork\Traits\HttpClientTrait;
use WeWork\Traits\SecretTrait;

class JsAgentTicket extends AbstractApiCache
{
    use SecretTrait, HttpClientTrait;

	public $token_expires_in = 7100;
    /**
     * @return string
     */
    protected function getCacheKey(): string
    {
		$unique = md5($this->secret);
        return md5('wework.api.jsagentticket.' . $unique);
    }

    /**
     * @return string
     */
    protected function getFromServer(): string
    {
		//var_dump($this->config);
        $data = $this->httpClient->get('ticket/get', ['type' => 'agent_config']);
		$this->token_expires_in = isset($data['expires_in']) ? $data['expires_in'] : $this->token_expires_in;
//var_dump($data);die();
        return $data['ticket'];
    }
}
