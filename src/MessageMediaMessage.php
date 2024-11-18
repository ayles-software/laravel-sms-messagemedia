<?php

namespace AylesSoftware\MessageMedia;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Traits\Conditionable;

class MessageMediaMessage
{
    use Conditionable, Macroable;

    public string $from = '';

    public $delay = null;

    public ?string $to = null;

    public function __construct(public string $message = '')
    {
    }

    /**
     * Set the message content.
     */
    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the phone number or sender name the message should be sent from.
     */
    public function from(string $from): self
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Set who this message is sent to, defaults to null and pulled from the modal using ->routeNotificationForMessageMedia()
     */
    public function to(string $to): self
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Set the delay when this should be sent.
     * Leave blank for immediate delivery.
     */
    public function delay($delay): self
    {
        $this->delay = $delay;

        return $this;
    }
}
