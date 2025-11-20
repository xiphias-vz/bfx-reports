<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportsReader;

use Generated\Shared\Transfer\ReportsReaderRequestTransfer;
use Xiphias\BladeFxApi\BladeFxApiClientInterface;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportParamFormRequestTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportParamFormResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportsListRequestTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportsListResponseTransfer;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class ReportsReader implements ReportsReaderInterface
{
    /**
     * @var \Xiphias\BladeFxApi\BladeFxApiClientInterface
     */
    protected BladeFxApiClientInterface $apiClient;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface
     */
    protected TokenResolverInterface $tokenResolver;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \Xiphias\BladeFxApi\BladeFxApiClientInterface $apiClient
     * @param \Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface $tokenResolver
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        BladeFxApiClientInterface $apiClient,
        TokenResolverInterface $tokenResolver,
        ReportsConfig $config
    ) {
        $this->apiClient = $apiClient;
        $this->tokenResolver = $tokenResolver;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\ReportsReaderRequestTransfer $readerRequestTransfer
     * @param string|null $attribute
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportsListResponseTransfer
     */
    public function getReportsList(ReportsReaderRequestTransfer $readerRequestTransfer, ?string $attribute = ''): BladeFxGetReportsListResponseTransfer
    {
        $requestTransfer = $this->buildAuthenticatedGetReportsListRequest($readerRequestTransfer, $attribute);

        return $this->apiClient->sendGetReportsListRequest($requestTransfer, true);
    }

    /**
     * @param \Generated\Shared\Transfer\ReportsReaderRequestTransfer $readerRequestTransfer
     * @param string|null $attribute
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportsListRequestTransfer
     */
    public function buildAuthenticatedGetReportsListRequest(
        ReportsReaderRequestTransfer $readerRequestTransfer,
        ?string $attribute = ''
    ): BladeFxGetReportsListRequestTransfer {
        return (new BladeFxGetReportsListRequestTransfer())
            ->setCatId($readerRequestTransfer->getActiveCategory() ?? $this->config->getDefaultCategoryIndex())
            ->setAttribute($attribute)
            ->setReturnType($this->config->getReturnTypeJson())
            ->setAccessToken($this->tokenResolver->resolveToken());
    }

    /**
     * @param int $reportId
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportParamFormResponseTransfer
     */
    public function getReportParamForm(int $reportId): BladeFxGetReportParamFormResponseTransfer
    {
        $requestTransfer = (new BladeFxGetReportParamFormRequestTransfer())
            ->setRootUrl($this->config->getParamFormRootUrl())
            ->setReportId($reportId)
            ->setAccessToken($this->tokenResolver->resolveToken());

        return $this->apiClient->sendGetReportParamFormRequest($requestTransfer, true);
    }
}
