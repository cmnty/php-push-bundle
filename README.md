# CmntyPushBundle

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

Symfony Bundle for [cmnty/push][link-push-library].

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

## Credits

- [Johan de Ruijter][link-jdr]
- [CMNTY Corporation][link-cmnty]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/cmnty/push-bundle.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/cmnty/push-bundle.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/cmnty/push-bundle
[link-downloads]: https://packagist.org/packages/cmnty/push-bundle
[link-push-library]: https://github.com/cmnty/php-push
[link-jdr]: https://github.com/johanderuijter
[link-cmnty]: https://github.com/cmnty
[link-contributors]: ../../contributors
