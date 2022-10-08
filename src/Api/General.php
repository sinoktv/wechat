<?php

namespace WeWork\Api;

use WeWork\Traits\AgentIdTrait;
use WeWork\Traits\HttpClientTrait;

class General
{
    use HttpClientTrait, AgentIdTrait;

    /**
     * 创建菜单
     *
     * @param array $params
     * @return array
     */
    public function postJson(string $dirname,array $params,array $params2=null): array
    {
		if (is_null($params2)){
			return $this->httpClient->postJson($dirname, $params);
		}else{
			return $this->httpClient->postJson($dirname, $params,$params2);
		}
    }

    /**
     * 获取菜单
     *
     * @return array
     */
    public function get(string $dirname,array $params=null): array
    {
		if (is_null($params)){
			return $this->httpClient->get($dirname);
		}else{
			return $this->httpClient->get($dirname, $params);
		}
    }
}
