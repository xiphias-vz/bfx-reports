<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportByFormatReader;

use Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Generated\Shared\Transfer\BladeFxTokenTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Xiphias\Client\ReportsApi\ReportsApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BladeFxReportByFormatReader implements BladeFxReportByFormatReaderInterface
{
    /**
     * @var string
     */
    protected const DEFAULT_DATA_RETURN_TYPE = 'string';

    protected BladeFxAuthenticatorInterface $authenticator;

    protected ReportsApiClientInterface $apiClient;

    protected SessionClientInterface $sessionClient;

    protected ReportsConfig $config;

    /**
     * @param \Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface $authenticator
     * @param \Xiphias\Client\ReportsApi\ReportsApiClientInterface $apiClient
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
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
     * @param int $reportId
     * @param string $format
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByFormat(
        int $reportId,
        string $format,
        ?BladeFxParameterTransfer $parameterTransfer = null,
    ): BladeFxGetReportByFormatResponseTransfer {
        return $this->apiClient->sendGetReportByFormatRequest(
            $this->buildAuthenticatedReportByFormatRequestTransfer($reportId, $format, $parameterTransfer),
        );
    }

    /**
     * @param int $reportId
     * @param string $format
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer
     */
    protected function buildAuthenticatedReportByFormatRequestTransfer(
        int $reportId,
        string $format,
        ?BladeFxParameterTransfer $parameterTransfer = null,
    ): BladeFxGetReportByFormatRequestTransfer {
        return $this->buildReportByFormatRequestTransfer(
            $this->getUserToken(),
            $reportId,
            $format,
            $parameterTransfer,
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
     * @param int $reportId
     * @param string $format
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer
     */
    protected function buildReportByFormatRequestTransfer(
        string $token,
        int $reportId,
        string $format,
        ?BladeFxParameterTransfer $parameterTransfer = null,
    ): BladeFxGetReportByFormatRequestTransfer {
        return (new BladeFxGetReportByFormatRequestTransfer())
            ->setRepId($reportId)
            ->setFileFormat($format)
            ->setLayoutId($this->config->getDefaultLayout())
            ->setReturnType(static::DEFAULT_DATA_RETURN_TYPE)
            ->setParams($parameterTransfer)
            ->setToken((new BladeFxTokenTransfer())->setToken($token));
    }
}
