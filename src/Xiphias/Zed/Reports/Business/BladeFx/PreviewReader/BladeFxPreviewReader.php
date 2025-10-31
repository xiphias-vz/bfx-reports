<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\PreviewReader;

use Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewRequestTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxTokenTransfer;
use Xiphias\BladeFxApi\BladeFxApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\TokenResolver\TokenResolverInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BladeFxPreviewReader implements BladeFxPreviewReaderInterface
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
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportsPreview(BladeFxParameterTransfer $parameterTransfer): BladeFxGetReportPreviewResponseTransfer
    {
        $requestTransfer = $this->buildAuthenticatedGetReportsListRequest($parameterTransfer);

        return $this->apiClient->sendGetReportPreviewRequest($requestTransfer);
    }

    /**
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewRequestTransfer
     */
    protected function buildAuthenticatedGetReportsListRequest(
        BladeFxParameterTransfer $parameterTransfer
    ): BladeFxGetReportPreviewRequestTransfer {
        return (new BladeFxGetReportPreviewRequestTransfer())
            ->setRepId($parameterTransfer->getReportId())
            ->setParams($parameterTransfer)
            ->setRootUrl($this->config->getRootUrl())
            ->setLayoutId($this->config->getDefaultLayout())
            ->setReturnType($this->config->getReturnTypeJson())
            ->setToken((new BladeFxTokenTransfer())->setAccessToken($this->tokenResolver->resolveToken()));
    }
}
