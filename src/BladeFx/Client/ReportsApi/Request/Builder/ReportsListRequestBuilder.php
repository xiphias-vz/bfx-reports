<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi\Request\Builder;

use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class ReportsListRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @return string
     */
    public function getMethodName(): string
    {
        return parent::METHOD_GET;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    public function getAdditionalHeaders(AbstractTransfer $requestTransfer): array
    {
        return $this->addAuthHeader($requestTransfer);
    }

    /**
     * @param string $resource
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|\Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer|BladeFxGetReportsListRequestTransfer $requestTransfer @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer@param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function buildRequest(
        string $resource,
        AbstractTransfer|BladeFxGetReportsListRequestTransfer $requestTransfer,
        ?BladeFxParameterTransfer $parameterTransfer = null,
    ): RequestInterface {
        $uri = $this->buildUri($resource, $this->getQueryParamsFromRequestTransfer($requestTransfer));
        $headers = $this->getCombinedHeaders($requestTransfer);
        $encodedData = $this->getEncodedData($requestTransfer);

        return new Request($this->getMethodName(), $uri, $headers, $encodedData);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer $requestTransfer
     *
     * @return array
     */
    protected function getQueryParamsFromRequestTransfer(BladeFxGetReportsListRequestTransfer $requestTransfer): array
    {
        return [
            'catId' => $requestTransfer->getCatId(),
            'attribute' => $requestTransfer->getAttribute(),
        ];
    }
}
