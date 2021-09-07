<?php

namespace AylesSoftware\MessageMedia;

class MessageMediaMessage
{
    /**
     * The phone number the message should be sent from.
     */
    public string $from = '';

    /**
     * Timestamp delay.
     */
    public $delay = null;

    /**
     * @param  string  $content
     */
    public function __construct(public string $content = '')
    {
    }

    /**
     * Set the message content.
     *
     * @param  string  $content
     * @return $this
     */
    public function message($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Set the phone number or sender name the message should be sent from.
     *
     * @param  string  $from
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Set the delay when this should be sent.
     *
     * Leave blank for immediate delivery.
     *
     * @param  string  $delay
     * @return $this
     */
    public function delay($delay)
    {
        $this->delay = $delay;

        return $this;
    }
}
