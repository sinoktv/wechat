<?php

namespace WeWork\Api;

use WeWork\Message\ResponseMessageInterface;
use WeWork\Traits\HttpClientTrait;

class AppChat
{
    use HttpClientTrait;

    /**
     * 创建群聊会话
     *
     * @param array $json
     * @return array
     */
    public function create(array $json): array
    {
        return $this->httpClient->postJson('appchat/create', $json);
    }

    /**
     * 修改群聊会话
     *
     * @param array $json
     * @return array
     */
    public function update(array $json): array
    {
        return $this->httpClient->postJson('appchat/update', $json);
    }

    /**
     * 获取群聊会话
     *
     * @param string $id
     * @return array
     */
    public function get(string $id): array
    {
        return $this->httpClient->get('appchat/get', ['chatid' => $id]);
    }

    /**
     * 应用推送消息
     *
     * @param string $id
     * @param ResponseMessageInterface $responseMessage
     * @param bool $safe
     * @return array
     */
    public function send(string $id, ResponseMessageInterface $responseMessage, bool $safe = false): array
    {
        return $this->httpClient->postJson(
            'appchat/send',
            array_merge(['chatid' => $id], $responseMessage->formatForResponse(), ['safe' => (int)$safe])
        );
    }
	
	//获取客户列表  企业可通过此接口获取指定成员添加的客户列表
	public function externalcontactList(string $userid=''): array
    {
		return $this->httpClient->get('externalcontact/list', array(
			'userid'=>$userid,
		));
    }
	
	//获取客户详情
	//企业需要使用系统应用“客户联系”或配置到“可调用应用”列表中的自建应用的secret所获取的accesstoken来调用（accesstoken如何获取？）；
	public function externalcontactGet(string $external_userid='',string $cursor=''): array
    {
		return $this->httpClient->get('externalcontact/get', array(
			'external_userid'=>$external_userid,
			'cursor'=>$cursor,
		));
    }
	//批量获取客户详情   获取指定成员添加的客户信息列表
	public function externalcontactBatchGet(array $userid_list,string $cursor='',int $limit=50): array
    {
        return $this->httpClient->postJson('externalcontact/batch/get_by_user', array(
			'userid_list'=>$userid_list,
			'cursor'=>$cursor,
			'limit'=>$limit,
		));
    }
	
	//获取客户群列表
	public function externalcontactGroupchatList(array $json): array
    {
        return $this->httpClient->postJson('externalcontact/groupchat/list', $json);
    }
	//获取客户群详情
	public function externalcontactGroupchatGet(string $chat_id='',int $need_name=0): array
    {
        return $this->httpClient->postJson('externalcontact/groupchat/get', array(
			'chat_id'=>$chat_id,
			'need_name'=>$need_name,
		));
    }
}
