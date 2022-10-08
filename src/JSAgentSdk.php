<?php

namespace WeWork;

use WeWork\Crypt\PrpCrypt;
use WeWork\Traits\CorpIdTrait;
use WeWork\Traits\JsAgentTicketTrait;
use WeWork\Traits\TicketTrait;
use WeWork\Traits\AgentIdTrait;

class JSAgentSdk
{
    use CorpIdTrait,AgentIdTrait, TicketTrait, JsAgentTicketTrait;

    /**
     * @param string $url
     * @return array
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
	public function getJsAgentConfig(string $url): array
    {
        $appId = $this->corpId;
		$agent_id = $this->agentId;
        $timestamp = $this->getTimestamp();

        $nonceStr = $this->getNonceStr();

        $signature = sha1("jsapi_ticket={$this->jsAgentTicket->get()}&noncestr={$nonceStr}&timestamp={$timestamp}&url={$url}");

        return compact('appId', 'timestamp', 'nonceStr', 'signature','agent_id');
    }
    /**
     * @return array
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getChooseInvoiceConfig(): array
    {
        $timestamp = $this->getTimestamp();

        $nonceStr = $this->getNonceStr();

        $array = ['INVOICE', $this->corpId, $timestamp, $nonceStr, $this->ticket->get()];

        sort($array, SORT_STRING);

        $str = implode($array);

        $cardSign = sha1($str);

        return compact('timestamp', 'nonceStr', 'cardSign');
    }

    /**
     * @return int
     */
    protected function getTimestamp(): int
    {
        return time();
    }

    /**
     * @return string
     */
    protected function getNonceStr(): string
    {
        return (new PrpCrypt(null))->getRandomStr();
    }
}
