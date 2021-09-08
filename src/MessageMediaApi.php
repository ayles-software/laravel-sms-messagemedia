<?php

namespace AylesSoftware\MessageMedia;

use RuntimeException;
use Illuminate\Support\Facades\Http;

class MessageMediaApi
{
    protected string $url = 'https://api.messagemedia.com/v1/messages';

    public function sendSms($message, $delay, $to, $from)
    {
        if (strlen($message) > 5000) {
            throw new RuntimeException('Notification was not sent. Content length may not be greater than 5000 characters.');
        }

        $response = Http::withBasicAuth(
            config('services.message_media.key'),
            config('services.message_media.secret')
        )->post($this->url, [
            'messages' => [
                [
                    'content' => $message,
                    'destination_number' => $to,
                    'source_number' => $from,
                     'scheduled' => optional($delay)->toIso8601String(),
                ],
            ],
        ]);

        if (! $response->successful()) {
            return (object) [
                'success' => false,
                'message' => $message,
                'to' => $to,
                'from' => $from,
                'delay' => $delay,
                'errorMessage' => $response->json('details.0') ?: $response->json('message'),
            ];
        }

        return (object) [
            'id' => $response->json('messages.0.message_id'),
            'message' => $message,
            'to' => $to,
            'from' => $from,
            'delay' => $delay,
            'success' => true,
        ];
    }
}
