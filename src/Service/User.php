<?php

declare(strict_types=1);

namespace Promopult\TikTokMarketingApi\Service;

use bandwidthThrottle\tokenBucket\BlockingConsumer;
use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\storage\FileStorage;
use bandwidthThrottle\tokenBucket\TokenBucket;

final class User extends \Promopult\TikTokMarketingApi\AbstractService
{
    public function __construct(
        \Promopult\TikTokMarketingApi\CredentialsInterface $credentials,
        \Psr\Http\Client\ClientInterface $httpClient
    )
    {
        parent::__construct($credentials, $httpClient);
        $storage = new FileStorage(__DIR__ . "/../../config/buckets/api-user.bucket");
        $rate    = new Rate(10, Rate::SECOND);
        $this->bucket = new TokenBucket(10, $rate, $storage);
        $this->consumer = new BlockingConsumer($this->bucket);
        $this->bucket->bootstrap(10);
    }
    /**
     * Getting user information
     *
     * @return array
     *
     * @throws \Psr\Http\Client\ClientExceptionInterface
     *
     * @see https://ads.tiktok.com/marketing_api/docs?id=100680
     */
    public function info(): array
    {
        return $this->requestApi(
            'GET',
            '/open_api/v1.2/user/info/'
        );
    }
}
