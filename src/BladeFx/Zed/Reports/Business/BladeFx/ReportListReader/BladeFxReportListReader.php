<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Zed\Reports\Business\BladeFx\ReportListReader;

use BladeFx\Client\ReportsApi\ReportsApiClient;
use BladeFx\Client\ReportsApi\ReportsApiClientInterface;
use BladeFx\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface;
use BladeFx\Zed\Reports\ReportsConfig;
use Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer;
use Spryker\Client\Session\SessionClientInterface;

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
     * @var \BladeFx\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface
     */
    protected BladeFxAuthenticatorInterface $authenticator;

    /**
     * @var \BladeFx\Client\ReportsApi\ReportsApiClient
     */
    protected ReportsApiClient $apiClient;

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected SessionClientInterface $sessionClient;

    /**
     * @var \BladeFx\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $config;

    /**
     * @param \BladeFx\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface $authenticator
     * @param \BladeFx\Client\ReportsApi\ReportsApiClientInterface $apiClient
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param \BladeFx\Zed\Reports\ReportsConfig $config
     */
    public function __construct(
        BladeFxAuthenticatorInterface $authenticator,
        ReportsApiClientInterface $apiClient,
        SessionClientInterface $sessionClient,
        ReportsConfig $config,
    ) {
        $this->authenticator = $authenticator;
        $this->apiClient = $apiClient;
        $this->sessionClient = $sessionClient;
        $this->config = $config;
    }

    /**
     * @param string|null $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListResponseTransfer
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
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer
     */
    protected function buildAuthenticatedReportListRequestTransfer(?string $attribute = ''): BladeFxGetReportsListRequestTransfer
    {
        return $this->buildReportListRequestTransfer(
            $this->getUserToken(),
            $attribute,
        );
    }

    /**
     * @return string
     */
    protected function getUserToken(): string
    {
        $bfxTokenSessionKey = $this->config->getBfxTokenSessionKey();

        if ($this->sessionClient->has($bfxTokenSessionKey)) {
            return $this->sessionClient->get($bfxTokenSessionKey);
        }

        return $this->getAuthenticationResponseTransfer()?->getToken();
    }

    /**
     * @param string $token
     * @param string $attribute
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportsListRequestTransfer
     */
    protected function buildReportListRequestTransfer(
        string $token,
        string $attribute = '',
    ): BladeFxGetReportsListRequestTransfer {
        return (new BladeFxGetReportsListRequestTransfer())
            ->setToken($token)
            ->setAttribute($attribute)
            ->setReturnType(static::DEFAULT_DATA_RETURN_TYPE);
    }

    /**
     * @return \Generated\Shared\Transfer\BladeFxAuthenticationResponseTransfer
     */
    protected function getAuthenticationResponseTransfer(): BladeFxAuthenticationResponseTransfer
    {
        return $this->authenticator->authenticate();
    }
}
