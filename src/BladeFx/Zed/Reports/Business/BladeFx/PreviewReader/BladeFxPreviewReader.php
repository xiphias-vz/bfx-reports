<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Business\BladeFx\PreviewReader;

use BladeFx\Client\ReportsApi\ReportsApiClientInterface;
use BladeFx\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use BladeFx\Zed\Reports\ReportsConfig;
use Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;

class BladeFxPreviewReader implements BladeFxPreviewReaderInterface
{
    /**
     * @var \BladeFx\Client\ReportsApi\ReportsApiClientInterface
     */
    protected ReportsApiClientInterface $apiClient;

    /**
     * @var \BladeFx\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface
     */
    protected TokenResolverInterface $tokenResolver;

    /**
     * @var \BladeFx\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \BladeFx\Client\ReportsApi\ReportsApiClientInterface $apiClient
     * @param \BladeFx\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface $tokenResolver
     * @param \BladeFx\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        ReportsApiClientInterface $apiClient,
        TokenResolverInterface $tokenResolver,
        ReportsConfig $config,
    ) {
        $this->apiClient = $apiClient;
        $this->tokenResolver = $tokenResolver;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportsPreview(BladeFxParameterTransfer $parameterTransfer): BladeFxGetReportPreviewResponseTransfer
    {
        $requestTransfer = $this->buildAuthenticatedGetReportsListRequest($parameterTransfer);

        return $this->apiClient->sendGetReportPreviewRequest($requestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer
     */
    protected function buildAuthenticatedGetReportsListRequest(
        BladeFxParameterTransfer $parameterTransfer,
    ): BladeFxGetReportPreviewRequestTransfer {
        return (new BladeFxGetReportPreviewRequestTransfer())
            ->setToken($this->tokenResolver->resolveToken())
            ->setRepId($parameterTransfer->getReportId())
            ->setParams($parameterTransfer)
            ->setRootUrl($this->config->getRootUrl())
            ->setLayoutId($this->config->getDefaultLayout())
            ->setReturnType($this->config->getReturnTypeJson());
    }
}
