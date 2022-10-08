<?php

namespace WeWork\Http;
use think\facade\Config;
class Response extends \GuzzleHttp\Psr7\Response
{
    /**
     * @inheritdoc
     */
    public function getBody()
    {
        $stream = parent::getBody();

        $data = json_decode((string)$stream, true);
		/*if (Config::get('weixin.log')['level'] == 'debug'){
			if (JSON_ERROR_NONE === json_last_error() && $data['errcode'] !== 0) {
				throw new \InvalidArgumentException($data['errmsg'], $data['errcode']);
			}
		}*/

        return $stream;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return \GuzzleHttp\json_decode((string)$this->getBody(), true);
    }
}
