# MessageMedia sms notifications channel for Laravel 10

This package makes it easy to send notifications using [messagemedia.com](//messagemedia.com) with Laravel 10.

## Installation

Install the package via composer:
```bash
composer require ayles-software/laravel-sms-messagemedia
```

When generating an API key in Message Media make sure to use the Basic Authentication type. **HMAC Auth is not supported**

Add your MessageMedia api key, secret and optional default sender sms_from to your `config/services.php`:

```php
'message_media' => [
    'key' => env('MESSAGE_MEDIA_KEY'),
    'secret'  => env('MESSAGE_MEDIA_SECRET'),
    'from' => env('MESSAGE_MEDIA_FROM'),
],
```

## Usage

Use MessageMediaChannel in `via()` method inside your notification classes. Example:

```php
namespace App\Notifications;

use Illuminate\Notifications\Notification;
use AylesSoftware\MessageMedia\MessageMediaChannel;
use AylesSoftware\MessageMedia\MessageMediaMessage;

class SmsTest extends Notification
{
    public function __construct(public string $token)
    {
    }

    public function via($notifiable)
    {
        return [MessageMediaChannel::class];
    }

    public function toMessageMedia($notifiable)
    {
        return (new MessageMediaMessage)
            ->message("SMS test to user #{$notifiable->id} with token {$this->token} by MessageMedia")
            ->from('Dory');
            
        // setting a delay when the sms should be sent
        return (new MessageMediaMessage)
            ->message("SMS test to user #{$notifiable->id} with token {$this->token} by MessageMedia")
            ->from('Dory')
            ->delay(now()->addHours(6));
    }
}
```

In notifiable model (User), include method `routeNotificationForMessageMedia()` that returns recipient mobile number:

```php
public function routeNotificationForMessageMedia()
{
    return $this->phone;
}
```

Then send a notification the standard way:
```php
$user = User::find(1);

$user->notify(new SmsTest);
```

## Events
Following events are triggered by Notification. By default:
- Illuminate\Notifications\Events\NotificationSending
- Illuminate\Notifications\Events\NotificationSent

NotificationFailed will trigger if something goes wrong
- Illuminate\Notifications\Events\NotificationFailed

## Testing

Yes

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
