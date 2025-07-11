<?php


declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Request\Builder;

use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Xiphias\Client\ReportsApi\ReportsApiConfig;
use Xiphias\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;

class ReportByFormatRequestBuilder extends AbstractRequestBuilder
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
        /** @var \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $reportByFormatRequestTransfer */
        $reportByFormatRequestTransfer = $requestTransfer;

        $headers = $this->addAuthHeader($reportByFormatRequestTransfer->getToken());
        $headers['AcceptEncoding'] = ['*'];
        $headers['accept'] = ['text/plain'];

        return $headers;
    }

    /**
     * @param string $resource
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function buildRequest(string $resource, AbstractTransfer $requestTransfer): RequestInterface
    {
        $uri = $this->buildUri($resource);
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
        $data = $requestTransfer->toArray(true, true);
        unset($data['params']);
        $data = $this->bodyFormatter->changeArrayFromCamelCaseToSnakeCase($data);

        /** @var \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer $reportByFormatRequestTransfer */
        $reportByFormatRequestTransfer = $requestTransfer;

        foreach ($reportByFormatRequestTransfer->getParams()->getParameterList() as $parameterTransfer) {
            if ($this->bodyFormatter->parameterTransferIsValid($parameterTransfer)) {
                $parameterArray = $parameterTransfer->toArray(true, true);
                $data['params'][] = $this->bodyFormatter->changeArrayFromCamelCaseToSnakeCase($parameterArray);
            }
        }

        return $this->utilEncodingService->encodeJson($data);
    }
}
