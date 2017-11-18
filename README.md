# Rapture PHP Message

[![PhpVersion](https://img.shields.io/badge/php-7.0.0-orange.svg?style=flat-square)](#)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](#)

Message sending for various services.

## Requirements

- PHP v7.0.0
- php-curl, php-json, php-soap

## Install

```
composer require mrjulio/rapture-message
```

## Quick start

```php
$message= new Message([
    'subject'   =>  'Hello',
    'body'      =>  'Lorem ipsum...'
]);
$message->setSender('no-reply@gmail.com');

$mailgun = new Mailgun(['api-key' => '98asd0as09ds']);
$request = $mailgun->getRequest($message);
$client  = new \Rapture\Http\Client;

$response = $httpClient->sendRequest($request);

if ($response->getStatusCode() === \Rapture\Http\Response::STATUS_OK) {
    echo 'Success!';
}
else {
    echo 'Failed!';
}
```

## About

### Author

Iulian N. `rapture@iuliann.ro`

### Testing

```
cd ./test && phpunit
```

### License

Rapture PHP Message is licensed under the MIT License - see the `LICENSE` file for details.
