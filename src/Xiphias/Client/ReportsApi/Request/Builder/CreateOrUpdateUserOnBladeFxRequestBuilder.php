<?php


namespace Xiphias\Client\ReportsApi\Request\Builder;

use Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Xiphias\Client\ReportsApi\ReportsApiConfig;
use Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;
use Xiphias\Client\ReportsApi\Request\Mapper\RequestMapperInterface;

class CreateOrUpdateUserOnBladeFxRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @var \Xiphias\Client\ReportsApi\Request\Mapper\RequestMapperInterface
     */
    protected RequestMapperInterface $requestMapper;

    /**
     * @param \Xiphias\Client\ReportsApi\ReportsApiConfig $apiClientConfig
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     * @param \Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface $requestBodyFormatter
     * @param \Xiphias\Client\ReportsApi\Request\Mapper\RequestMapperInterface $requestMapper
     */
    public function __construct(
        ReportsApiConfig $apiClientConfig,
        UtilEncodingServiceInterface $utilEncodingService,
        RequestBodyFormatterInterface $requestBodyFormatter,
        RequestMapperInterface $requestMapper
    ) {
        parent::__construct($apiClientConfig, $utilEncodingService, $requestBodyFormatter);
        $this->requestMapper = $requestMapper;
    }

    /**
     * @return string
     */
    protected function getMethodName(): string
    {
        return parent::METHOD_POST;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    protected function getAdditionalHeaders(AbstractTransfer $requestTransfer): array
    {
        /** @var \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer $createOrUpdateUserRequestTransfer */
        $createOrUpdateUserRequestTransfer = $requestTransfer;

        return $this->addAuthHeader($createOrUpdateUserRequestTransfer->getToken());
    }

    /**
     * @param string $resource
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function buildRequest(
        string $resource,
        AbstractTransfer|BladeFxCreateOrUpdateUserRequestTransfer $requestTransfer
    ): RequestInterface {
        /** @var \Generated\Shared\Transfer\BladeFxCreateOrUpdateUserRequestTransfer $createOrUpdateUserRequestTransfer */
        $createOrUpdateUserRequestTransfer = $requestTransfer;

        $uri = $this->buildUri($resource);

        $headers = $this->getCombinedHeaders($requestTransfer);
        $modifiedRequestTransfer = $this->requestMapper->mapCreateOrUpdateUserRequestTransferWithoutToken($createOrUpdateUserRequestTransfer);
        $encodedData = $this->getEncodedData($modifiedRequestTransfer);

        return new Request($this->getMethodName(), $uri, $headers, $encodedData);
    }
}
