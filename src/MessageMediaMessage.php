<?php

namespace AylesSoftware\MessageMedia;

class MessageMediaMessage
{
    public string $from = '';

    public $delay = null;

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
     * Set the delay when this should be sent.
     * Leave blank for immediate delivery.
     */
    public function delay($delay): self
    {
        $this->delay = $delay;

        return $this;
    }
}
