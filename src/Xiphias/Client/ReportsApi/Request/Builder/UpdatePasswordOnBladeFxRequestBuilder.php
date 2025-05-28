<?php


namespace Xiphias\Client\ReportsApi\Request\Builder;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Xiphias\Client\ReportsApi\ReportsApiConfig;
use Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;
use Xiphias\Shared\Reports\ReportsConstants;

class UpdatePasswordOnBladeFxRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return parent::METHOD_POST;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    public function getAdditionalHeaders(AbstractTransfer $requestTransfer): array
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer $reportParamFormRequestTransfer */
        $reportParamFormRequestTransfer = $requestTransfer;

        return $this->addAuthHeader($reportParamFormRequestTransfer->getToken());
    }

    /**
     * @param string $resource
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function buildRequest(
        string $resource,
        AbstractTransfer $requestTransfer
    ): RequestInterface {
        $uri = $this->buildUri($resource, $this->getUrlParamsFromRequestTransfer($requestTransfer));
        $headers = $this->getCombinedHeaders($requestTransfer);
        $encodedData = $this->getEncodedData($requestTransfer);

        return new Request($this->getMethodName(), $uri, $headers, $encodedData);
    }
}
