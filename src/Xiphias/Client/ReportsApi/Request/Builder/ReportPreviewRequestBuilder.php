<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Builder;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Xiphias\Client\ReportsApi\ReportsApiConfig;
use Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;
use Xiphias\Shared\Reports\ReportsConstants;

class ReportPreviewRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @var \Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface
     */
    protected RequestBodyFormatterInterface $bodyFormatter;

    /**
     * @var \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected UtilEncodingServiceInterface $utilEncodingService;

    /**
     * @var \Xiphias\Client\ReportsApi\ReportsApiConfig
     */
    protected ReportsApiConfig $config;

    /**
     * @param \Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface $bodyFormatter
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     * @param \Xiphias\Client\ReportsApi\ReportsApiConfig $config
     */
    public function __construct(RequestBodyFormatterInterface $bodyFormatter, UtilEncodingServiceInterface $utilEncodingService, ReportsApiConfig $config)
    {
        parent::__construct($config, $utilEncodingService, $bodyFormatter);

        $this->bodyFormatter = $bodyFormatter;
        $this->utilEncodingService = $utilEncodingService;
        $this->config = $config;
    }

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
        /** @var \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $reportPreviewRequestTransfer */
        $reportPreviewRequestTransfer = $requestTransfer;

        return $this->addAuthHeader($reportPreviewRequestTransfer->getToken());
    }

    /**
     * @param string $resource
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function buildRequest(
        string $resource,
        AbstractTransfer $requestTransfer,
    ): RequestInterface {
        $uri = $this->buildUri(
            $resource,
        );
        $headers = $this->getCombinedHeaders($requestTransfer);
        $encodedData = $this->getEncodedData($requestTransfer);

        return new Request($this->getMethodName(), $uri, $headers, $encodedData);
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return string
     */
    protected function getEncodedData(AbstractTransfer $requestTransfer): string
    {
        /** @var \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $reportPreviewRequestTransfer */
        $reportPreviewRequestTransfer = $requestTransfer;

        $data = $this->bodyFormatter->formatDataBeforeEncoding(
            $reportPreviewRequestTransfer,
        );

        $data[ReportsConstants::ENTRY_TEXT_REPORT_PREVIEW_PARAMETER_NAME] = $reportPreviewRequestTransfer->getParams()->getParamValue();
        $data = $this->cleanDataOfUnneededParameters($data);

        return $this->utilEncodingService->encodeJson($data);
    }

    /**
     * @param array<string, mixed> $data
     *
     * @return array<string, string>
     */
    protected function cleanDataOfUnneededParameters(array $data): array
    {
        foreach ($data as $key => $value) {
            if ($key !== ReportsConstants::ENTRY_TEXT_REPORT_PREVIEW_PARAMETER_NAME) {
                unset($data[$key]);
            }
        }

        return $data;
    }
}
