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
     *
     * @param string $message
     * @return $this
     */
    public function message(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Set the phone number or sender name the message should be sent from.
     *
     * @param string $from
     * @return $this
     */
    public function from(string $from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Set the delay when this should be sent.
     *
     * Leave blank for immediate delivery.
     *
     * @param  mixed  $delay
     * @return $this
     */
    public function delay($delay)
    {
        $this->delay = $delay;

        return $this;
    }
}
