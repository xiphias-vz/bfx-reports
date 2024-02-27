<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Business\BladeFx\ReportsReader;

use BladeFx\Client\ReportsApi\ReportsApiClientInterface;
use BladeFx\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use BladeFx\Zed\Reports\ReportsConfig;
use Generated\Shared\Transfer\BladeFxGetReportParamFormRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Generated\Shared\Transfer\ReportsReaderRequestTransfer;

class ReportsReader implements ReportsReaderInterface
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
     * @param \Generated\Shared\Transfer\ReportsReaderRequestTransfer $readerRequestTransfer
     * @param string|null $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
     */
    public function getReportsList(ReportsReaderRequestTransfer $readerRequestTransfer, ?string $attribute = ''): BladeFxGetReportsListResponseTransfer
    {
        $requestTransfer = $this->buildAuthenticatedGetReportsListRequest($readerRequestTransfer, $attribute);

        return $this->apiClient->sendGetReportsListRequest($requestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ReportsReaderRequestTransfer $readerRequestTransfer
     * @param string|null $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer
     */
    public function buildAuthenticatedGetReportsListRequest(
        ReportsReaderRequestTransfer $readerRequestTransfer,
        ?string $attribute = '',
    ): BladeFxGetReportsListRequestTransfer {
        return (new BladeFxGetReportsListRequestTransfer())
            ->setToken($this->tokenResolver->resolveToken())
            ->setCatId($readerRequestTransfer->getActiveCategory() ?? $this->config->getDefaultCategoryIndex())
            ->setAttribute($attribute)
            ->setReturnType($this->config->getReturnTypeJson());
    }

    /**
     * @param int $reportId
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamForm(int $reportId): BladeFxGetReportParamFormResponseTransfer
    {
        $requestTransfer = (new BladeFxGetReportParamFormRequestTransfer())
            ->setToken($this->tokenResolver->resolveToken())
            ->setRootUrl($this->config->getParamFormRootUrl())
            ->setReportId($reportId);

        return $this->apiClient->sendGetReportParamFormRequest($requestTransfer);
    }
}
