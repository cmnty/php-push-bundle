# CmntyPushBundle
Symfony Bundle for [cmnty/push](https://github.com/cmnty/php-push).

## Instalation

Require the bundle with composer:
```bash
composer require cmnty/push-bundle
```
Register the bundle in `app/AppKernel.php`:
```php
public function registerBundles()
{
    $bundles = [
        // ...
        new Cmnty\PushBundle\CmntyPushBundle(),
        // ...
    ];

    return $bundles;
}
```

## Configuration

```yaml
cmnty_push:
    push_services:
        google:
            enabled: true # Default false, automatically true when api_key is supplied.
            api_key: "%gcm_sender_id%" # Required value.
        mozilla:
            enabled: true # Default true
```

## Usage

```php
use Cmnty\Push\Crypto\AuthenticationTag;
use Cmnty\Push\Crypto\PublicKey;
use Cmnty\Push\EndPoint;
use Cmnty\Push\Notification;
use Cmnty\Push\Subscription;

$notification = new Notification('Hello', 'World!');
$subscription = new Subscription(new Endpoint('...'), new PublicKey('...'), new AuthenticationTag('...'));

$client = $this->get('cmnty_push.client');
$client->pushNotification($notification, $subscription);
```

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.
