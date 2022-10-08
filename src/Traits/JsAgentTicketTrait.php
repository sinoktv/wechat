<?php

namespace WeWork\Traits;

use WeWork\ApiCache\JsAgentTicket;

trait JsAgentTicketTrait
{
    /**
     * @var Ticket
     */
    protected $jsAgentTicket;

    /**
     * @param Ticket $ticket
     */
    public function setJsAgentTicket(JsAgentTicket $ticket): void
    {
        $this->jsAgentTicket = $ticket;
    }
}
