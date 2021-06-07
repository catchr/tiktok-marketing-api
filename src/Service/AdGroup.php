<?php

declare(strict_types=1);

namespace Promopult\TikTokMarketingApi\Service;

use bandwidthThrottle\tokenBucket\BlockingConsumer;
use bandwidthThrottle\tokenBucket\Rate;
use bandwidthThrottle\tokenBucket\storage\FileStorage;
use bandwidthThrottle\tokenBucket\TokenBucket;

final class AdGroup extends \Promopult\TikTokMarketingApi\AbstractService
{
    /**
     * AdGroup constructor.
     * @param \Promopult\TikTokMarketingApi\CredentialsInterface $credentials
     * @param \Psr\Http\Client\ClientInterface $httpClient
     * @throws \bandwidthThrottle\tokenBucket\storage\StorageException
     */
    public function __construct(
        \Promopult\TikTokMarketingApi\CredentialsInterface $credentials,
        \Psr\Http\Client\ClientInterface $httpClient
    )
    {
        parent::__construct($credentials, $httpClient);
        $storage = new FileStorage(__DIR__ . "/../../config/buckets/api-adgroup.bucket");
        $rate    = new Rate(10, Rate::SECOND);
        $this->bucket = new TokenBucket(10, $rate, $storage);
        $this->consumer = new BlockingConsumer($this->bucket);
        $this->bucket->bootstrap(10);
    }
    /**
     * @param int $advertiserId         Advertiser ID
     * @param array|null $fields        Fields to be returned. When not specified, all fields are returned by default.
     * @param array|null $filtering     Filter conditions. Set these conditions according to your requirements.
     *                                  If not set, all ad groups under the advertiser will be returned.
     * @param int|null $page            Current page number. Default value is 1. Range of values: ≥ 1
     * @param int|null $pageSize        Page size.Default value is: 10. Range of values: 1-1000
     * @return array
     * @throws \Throwable
     *
     * @see https://ads.tiktok.com/marketing_api/docs?id=100529
     */
    public function get(
        int $advertiserId,
        ?array $fields = null,
        ?array $filtering = null,
        ?int $page = null,
        ?int $pageSize = null
    ): array {
        return $this->requestApi(
            'GET',
            '/open_api/v1.2/adgroup/get/',
            [
                'advertiser_id' => $advertiserId,
                'fields' => $fields,
                'filtering' => $filtering,
                'page' => $page,
                'page_size' => $pageSize
            ]
        );
    }
}
