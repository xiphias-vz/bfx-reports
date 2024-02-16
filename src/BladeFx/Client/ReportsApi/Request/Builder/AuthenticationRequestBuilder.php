<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi\Request\Builder;

use BladeFx\Client\ReportsApi\ReportsApiConfig;
use BladeFx\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class AuthenticationRequestBuilder extends AbstractRequestBuilder
{
    /**
     * @var array<\BladeFx\Client\ReportsApi\Plugins\Formatter\AuthenticationRequestFieldFormatterPlugin>
     */
    protected array $fieldFormatterPlugins;

    /**
     * @param \BladeFx\Client\ReportsApi\ReportsApiConfig $apiClientConfig
     * @param \Spryker\Service\UtilEncoding\UtilEncodingServiceInterface $utilEncodingService
     * @param \BladeFx\Client\ReportsApi\Request\Formatter\RequestBodyFormatterInterface $bodyFormatter
     * @param array $fieldFormatterPlugins
     */
    public function __construct(
        ReportsApiConfig $apiClientConfig,
        UtilEncodingServiceInterface $utilEncodingService,
        RequestBodyFormatterInterface $bodyFormatter,
        array $fieldFormatterPlugins,
    ) {
        parent::__construct($apiClientConfig, $utilEncodingService, $bodyFormatter);

        $this->fieldFormatterPlugins = $fieldFormatterPlugins;
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
        return [];
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return string
     */
    protected function getEncodedData(AbstractTransfer $requestTransfer): string
    {
        $data = $requestTransfer->toArray(true, true);

        $this->executeFormatterPlugins($data);

        return $this->utilEncodingService->encodeJson($data);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function executeFormatterPlugins(array $data): array
    {
        foreach ($this->fieldFormatterPlugins as $fieldFormatterPlugin) {
            $data = $fieldFormatterPlugin->format($data);
        }

        return $data;
    }
}
