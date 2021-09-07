<?php

namespace AylesSoftware\MessageMedia;

use Exception;
use Illuminate\Events\Dispatcher;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Events\NotificationFailed;

class MessageMediaChannel
{
    public function __construct(public MessageMediaApi $client, public Dispatcher $events)
    {
    }

    public function send($notifiable, Notification $notification)
    {
        if (! method_exists($notification, 'toMessageMedia')) {
            throw new Exception('Please implement toMessageMedia() to send an SMS');
        }

        $message = $notification->toMessageMedia($notifiable);

        $result = $this->client->sendSms(
            $message->content,
            $message->delay,
            $notifiable->routeNotificationForMessageMedia(),
            $message->from ?: config('services.message_media.from'),
        );

        if (! $result->status) {
            $this->events->dispatch(
                new NotificationFailed($notifiable, $notification, get_class($this), $result->errorMessage)
            );

            throw new Exception('Notification failed '.$result->errorMessage);
        }
    }
}
