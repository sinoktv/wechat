<?php

namespace WeWork\Api;

use WeWork\Traits\AgentIdTrait;
use WeWork\Traits\HttpClientTrait;

class ClientIn
{
    use HttpClientTrait, AgentIdTrait;

    /**
     * 获取登录url.
     *
     * @param string      $redirectUri
     * @param string      $scope
     * @param string|null $state
     *
     * @return string
     */
    public function getOAuthRedirectUrl(string $appid,string $redirectUri = ''
	, string $scope = 'snsapi_userinfo', string $state = '')
    {
        //$redirectUri || $redirectUri = $this->config->get('kf_redirect_uri_oauth');
        //$state || $state = random_bytes(64);
        $params = [
            'appid' => $appid,//$this->config->get('corp_id'),
            'redirect_uri' => urlencode($redirectUri),
            'response_type' => 'code',
            'scope' => $scope,
            'state' => $state,
        ];
		//$param = implode("&",$params);
		$param = http_build_query($params);
		//var_dump($param);die();
        return "https://open.weixin.qq.com/connect/oauth2/authorize?". $param ."#wechat_redirect";
    }
}
