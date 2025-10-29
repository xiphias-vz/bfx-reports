<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportByFormatReader;

use Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer;
use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxTokenTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Xiphias\BladeFxApi\BladeFxApiClientInterface;
use Xiphias\Zed\Reports\Business\BladeFx\Authenticator\BladeFxAuthenticatorInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class BladeFxReportByFormatReader implements BladeFxReportByFormatReaderInterface
{
    /**
     * @var string
     */
    protected const DEFAULT_DATA_RETURN_TYPE = 'string';

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
     * @param int $reportId
     * @param string $format
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer|null $paramListTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByFormat(
        int $reportId,
        string $format,
        ?BladeFxParameterListTransfer $paramListTransfer = null
    ): BladeFxGetReportByFormatResponseTransfer {
        return $this->apiClient->sendGetReportByFormatRequest(
            $this->buildAuthenticatedReportByFormatRequestTransfer($reportId, $format, $paramListTransfer),
        );
    }

    /**
     * @param int $reportId
     * @param string $format
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer|null $paramListTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer
     */
    protected function buildAuthenticatedReportByFormatRequestTransfer(
        int $reportId,
        string $format,
        ?BladeFxParameterListTransfer $paramListTransfer = null
    ): BladeFxGetReportByFormatRequestTransfer {
        return $this->buildReportByFormatRequestTransfer(
            $this->getUserToken(),
            $reportId,
            $format,
            $paramListTransfer,
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
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer|null $paramListTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportByFormatRequestTransfer
     */
    protected function buildReportByFormatRequestTransfer(
        string $token,
        int $reportId,
        string $format,
        ?BladeFxParameterListTransfer $paramListTransfer = null
    ): BladeFxGetReportByFormatRequestTransfer {
        return (new BladeFxGetReportByFormatRequestTransfer())
            ->setRepId($reportId)
            ->setFileFormat($format)
            ->setLayoutId($this->config->getDefaultLayout())
            ->setReturnType(static::DEFAULT_DATA_RETURN_TYPE)
            ->setParams($paramListTransfer)
            ->setToken((new BladeFxTokenTransfer())->setAccessToken($token));
    }
}
