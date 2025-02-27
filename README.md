# TikTok Marketing API PHP client library

Convenient full-featured wrapper for [TikTok Marketing API](https://ads.tiktok.com/marketing_api/docs).

🚫 ️️Work In Progress. Not ready for use.

[![Build Status](https://travis-ci.org/promopult/tiktok-marketing-api.svg?branch=master)](https://travis-ci.org/promopult/tiktok-marketing-api)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/promopult/tiktok-marketing-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/promopult/tiktok-marketing-api/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/promopult/tiktok-marketing-api/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/promopult/tiktok-marketing-api/?branch=master)

### Installation

```bash
$ composer require promopult/tiktok-marketing-api
```
or
```
"require": {
  // ...
  "promopult/tiktok-marketing-api": "*"
  // ...
}
```

### Usage
See [examples](/examples) folder.

```php
$credentials = \Promopult\TikTokMarketingApi\Credentials::build(
    getenv('__ACCESS_TOKEN__'),
    getenv('__APP_ID__'),
    getenv('__SECRET__')
);

// Any PSR-18 HTTP-client
$httpClient = new \GuzzleHttp\Client();

$client = new \Promopult\TikTokMarketingApi\Client(
    $credentials,
    $httpClient
);

$response = $client->user->info();

print_r($response);

//Array
//(
//    [message] => OK
//    [code] => 0
//    [data] => Array
//        (
//            [create_time] => 1614175583
//            [display_name] => my_user
//            [id] => xxx
//            [email] => xxx
//        )
//
//    [request_id] => xxx
//)

```
