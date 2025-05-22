<?php


namespace Xiphias\Client\ReportsApi\Http\Client;

use GuzzleHttp\ClientInterface;
use Spryker\Shared\Log\LoggerTrait;

abstract class AbstractHttpClient implements HttpApiClientInterface
{
    use LoggerTrait;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected ClientInterface $client;

    /**
     * @param \GuzzleHttp\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }
}
