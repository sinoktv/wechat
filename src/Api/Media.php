<?php

namespace WeWork\Api;

use Psr\Http\Message\StreamInterface;
use WeWork\Traits\HttpClientTrait;

class Media
{
    use HttpClientTrait;

    /**
     * 上传临时素材
     *
     * @param string $type
     * @param string $path
     * @return array
     */
    public function upload(string $type, string $path): array
    {
		//var_dump($path);
		$types = compact('type');
		//var_dump($types);die();
        return $this->httpClient->postFile('media/upload', $path, $types);
    }

    /**
     * 获取临时素材
     *
     * @param string $id
     * @return StreamInterface
     */
    public function get(string $id): StreamInterface
    {
        return $this->httpClient->getStream('media/get', ['media_id' => $id]);
    }
	public function getMessageObject(string $id): object
    {
        return $this->httpClient->getMessageObject('media/get', ['media_id' => $id]);
		//'Body'=>$file->getBody(),
		//'Headers'=>$file->getHeaders(),
    }

    /**
     * 获取高清语音素材
     *
     * @param string $id
     * @return StreamInterface
     */
    public function getVoice(string $id): StreamInterface
    {
        return $this->httpClient->getStream('media/get/jssdk', ['media_id' => $id]);
    }
	public function getVoiceObject(string $id): object
    {
        return $this->httpClient->getMessageObject('media/get/jssdk', ['media_id' => $id]);
		//'Body'=>$file->getBody(),
		//'Headers'=>$file->getHeaders(),
    }
    /**
     * 上传图片
     *
     * @param string $path
     * @return array
     */
    public function uploadImg(string $path): array
    {
        return $this->httpClient->postFile('media/uploadimg', $path);
    }
}
