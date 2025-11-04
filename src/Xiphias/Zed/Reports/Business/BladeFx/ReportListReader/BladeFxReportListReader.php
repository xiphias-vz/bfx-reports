<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportListReader;

use Spryker\Client\Session\SessionClientInterface;
use Xiphias\BladeFxApi\BladeFxApiClientInterface;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportsListRequestTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxGetReportsListResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxTokenTransfer;
use Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BladeFxReportListReader implements BladeFxReportListReaderInterface
{
    /**
     * @var string
     */
    protected const DEFAULT_DATA_RETURN_TYPE = 'JSON';

    /**
     * @var int
     */
    protected const DEFAULT_CATEGORY_INDEX = 0;

    /**
     * @var \Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface
     */
    protected BladeFxAuthenticatorInterface $authenticator;

    /**
     * @var \Xiphias\BladeFxApi\BladeFxApiClientInterface
     */
    protected BladeFxApiClientInterface $apiClient;

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected SessionClientInterface $sessionClient;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface $authenticator
     * @param \Xiphias\BladeFxApi\BladeFxApiClientInterface $apiClient
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        BladeFxAuthenticatorInterface $authenticator,
        BladeFxApiClientInterface $apiClient,
        SessionClientInterface $sessionClient,
        ReportsConfig $config
    ) {
        $this->authenticator = $authenticator;
        $this->apiClient = $apiClient;
        $this->sessionClient = $sessionClient;
        $this->config = $config;
    }

    /**
     * @param string|null $attribute
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportsListResponseTransfer
     */
    public function getReportList(?string $attribute = ''): BladeFxGetReportsListResponseTransfer
    {
        return $this->apiClient->sendGetReportsListRequest(
            $this->buildAuthenticatedReportListRequestTransfer($attribute),
        );
    }

    /**
     * @param string|null $attribute
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportsListRequestTransfer
     */
    protected function buildAuthenticatedReportListRequestTransfer(?string $attribute = ''): BladeFxGetReportsListRequestTransfer
    {
        return $this->buildReportListRequestTransfer(
            $this->getUserToken(),
            $attribute,
        );
    }

    /**
     * @return string|null
     */
    protected function getUserToken(): string|null
    {
        $bfxTokenSessionKey = $this->config->getBfxTokenSessionKey();

        return $this->sessionClient->has($bfxTokenSessionKey) ? $this->sessionClient->get($bfxTokenSessionKey) : null;
    }

    /**
     * @param string $token
     * @param string $attribute
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportsListRequestTransfer
     */
    protected function buildReportListRequestTransfer(
        string $token,
        string $attribute = ''
    ): BladeFxGetReportsListRequestTransfer {
        return (new BladeFxGetReportsListRequestTransfer())
            ->setToken((new BladeFxTokenTransfer())->setAccessToken($token))
            ->setAttribute($attribute)
            ->setReturnType(static::DEFAULT_DATA_RETURN_TYPE);
    }
}
