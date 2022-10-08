<?php

namespace WeWork\ApiCache;

use WeWork\Traits\CacheTrait;

abstract class AbstractApiCache
{
    use CacheTrait;

    /**
     * @return string
     */
    abstract protected function getCacheKey(): string;

    /**
     * @return mixed
     */
    abstract protected function getFromServer();

    /**
     * @param bool $refresh
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function get(bool $refresh = false)
    {
        $key = $this->getCacheKey();

        $value = $this->cache->get($key);

        if ($refresh || !$value) {
            $value = $this->getFromServer();
			//$value_token = $value['access_token'];
			//$value_expires_in = $value['expires_in'];
			//$this->cache->set($key, $value_token, $value_expires_in);
			$value_expires_in = $this->token_expires_in;
            $this->cache->set($key, $value, $value_expires_in);
			//$this->cache->set($key, $value, 7100);
        }

        return $value;
    }
}
