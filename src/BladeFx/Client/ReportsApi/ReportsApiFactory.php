<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi;

use BladeFx\Client\ReportsApi\Handler\ApiHandler;
use BladeFx\Client\ReportsApi\Handler\ApiHandlerInterface;
use BladeFx\Client\ReportsApi\Http\Client\HttpApiClient;
use BladeFx\Client\ReportsApi\Http\Client\HttpApiClientInterface;
use BladeFx\Client\ReportsApi\Request\RequestFactory;
use BladeFx\Client\ReportsApi\Request\RequestFactoryInterface;
use BladeFx\Client\ReportsApi\Request\RequestManager;
use BladeFx\Client\ReportsApi\Request\RequestManagerInterface;
use BladeFx\Client\ReportsApi\Response\ResponseFactory;
use BladeFx\Client\ReportsApi\Response\ResponseFactoryInterface;
use BladeFx\Client\ReportsApi\Response\ResponseManager;
use BladeFx\Client\ReportsApi\Response\ResponseManagerInterface;
use GuzzleHttp\ClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\Session\SessionClientInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;

/**
 * @method \BladeFx\Client\ReportsApi\ReportsApiConfig getConfig()
 */
class ReportsApiFactory extends AbstractFactory
{
    /**
     * @return \BladeFx\Client\ReportsApi\Handler\ApiHandlerInterface
     */
    public function createApiHandler(): ApiHandlerInterface
    {
        return new ApiHandler(
            $this->createRequestManager(),
            $this->createResponseManager(),
            $this->createHttpApiClient(),
            $this->getConfig(),
            $this->createRequestFactory(),
        );
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\RequestManagerInterface
     */
    private function createRequestManager(): RequestManagerInterface
    {
        return new RequestManager(
            $this->createRequestFactory(),
        );
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\ResponseManagerInterface
     */
    public function createResponseManager(): ResponseManagerInterface
    {
        return new ResponseManager($this->createResponseFactory());
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Request\RequestFactoryInterface
     */
    private function createRequestFactory(): RequestFactoryInterface
    {
        return new RequestFactory();
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Response\ResponseFactoryInterface
     */
    private function createResponseFactory(): ResponseFactoryInterface
    {
        return new ResponseFactory(
            $this->getUtilEncodingService(),
        );
    }

    /**
     * @return \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): UtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(ReportsApiDependencyProvider::UTIL_ENCODING_SERVICE);
    }

    /**
     * @return \BladeFx\Client\ReportsApi\Http\Client\HttpApiClientInterface
     */
    private function createHttpApiClient(): HttpApiClientInterface
    {
        return new HttpApiClient($this->getHttpClient());
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    private function getHttpClient(): ClientInterface
    {
        return $this->getProvidedDependency(ReportsApiDependencyProvider::CLIENT_HTTP);
    }

    /**
     * @return \Spryker\Client\Session\SessionClientInterface
     */
    protected function getSessionClient(): SessionClientInterface
    {
        return $this->getProvidedDependency(ReportsApiDependencyProvider::SESSION_CLIENT);
    }
}
