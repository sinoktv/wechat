<?php

namespace WeWork\Api;

use WeWork\Traits\AgentIdTrait;
use WeWork\Traits\HttpClientTrait;
use Mockery\MockInterface;
use Psr\Http\Message\StreamInterface;
use WeWork\Api\Media;
class Kf
{
    use HttpClientTrait, AgentIdTrait;
	
    
	/**
     * 接收消息和事件  读取消息.
     *
     * @return array
    */
	public function sync(string $cursor, string $token, int $limit): array
    {
		$params = [
            'cursor' => $cursor,
            'token' => $token,
            'limit' => $limit
        ];
        return $this->httpClient->postJson('kf/sync_msg', $params);
    }
	//发送消息.
	public function send(array $params)
    {
        return $this->httpClient->postJson('kf/send_msg', $params);
    }
	//发送事件响应消息.
	public function event(array $params)
    {
        return $this->httpClient->postJson('kf/send_msg_on_event', $params);
    }
	
	//添加客服帐号.
	public function accountAdd(string $name, string $mediaId)
    {
        $params = [
            'name' => $name,
            'media_id' => $mediaId,
        ];

        return $this->httpClient->postJson('kf/account/add', $params);
    }
	//修改客服帐号.
	public function accountUpdate(string $openKfId, string $name, string $mediaId)
    {
        $params = [
            'open_kfid' => $openKfId,
            'name' => $name,
            'media_id' => $mediaId,
        ];

        return $this->httpClient->postJson('kf/account/update', $params);
    }
	//删除客服帐号
	public function accountDel(string $openKfId)
    {
        $params = [
            'open_kfid' => $openKfId
        ];

        return $this->httpClient->postJson('kf/account/del', $params);
    }
	//获取客服帐号列表.
	public function getAccountList()
    {
        return $this->httpClient->get('kf/account/list');
    }
	//获取客服帐号链接
	public function getAccountLink(string $openKfId, string $scene)
    {
        $params = [
            'open_kfid' => $openKfId,
            'scene' => $scene
        ];

        return $this->httpClient->postJson('kf/add_contact_way', $params);
    }
	
	//添加接待人员.
	public function servicerAdd(string $openKfId, array $userIds)
    {
        $params = [
            'open_kfid' => $openKfId,
            'userid_list' => $userIds
        ];

        return $this->httpClient->postJson('kf/servicer/add', $params);
    }
	//删除接待人员.
	public function servicerDel(string $openKfId, array $userIds)
    {
        $params = [
            'open_kfid' => $openKfId,
            'userid_list' => $userIds
        ];

        return $this->httpClient->postJson('kf/servicer/del', $params);
    }
	//获取接待人员列表.
	public function servicerList(string $openKfId)
    {
        $params = [
            'open_kfid' => $openKfId
        ];

        return $this->httpClient->get('kf/servicer/list', $params);
    }
	
    //获取微信客户会话状态.
	public function state(string $openKfId, string $externalUserId)
    {
        $params = [
            'open_kfid' => $openKfId,
            'external_userid' => $externalUserId
        ];

        return $this->httpClient->postJson('kf/service_state/get', $params);
    }
	//变更会话状态.
	public function updateState(string $openKfId, string $externalUserId, int $serviceState, string $serviceUserId)
    {
        $params = [
            'open_kfid' => $openKfId,
            'external_userid' => $externalUserId,
            'service_state' => $serviceState,	//0未处理  1由智能助手接待  2待接入池排队中   3由人工接待   4已结束
            'servicer_userid' => $serviceUserId
        ];

        return $this->httpClient->postJson('kf/service_state/trans', $params);
    }
	
	//获取客户基础信息
	public function getcustomerBatchget(array $userid_list)
	{
		$params = [
			'external_userid_list' => $userid_list
		];
		return $this->httpClient->postJson('kf/customer/batchget', $params);
	}
}
