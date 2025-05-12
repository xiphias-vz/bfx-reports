<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Mapper;

use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Xiphias\Shared\Reports\ReportsConstants;
use Xiphias\Zed\Reports\ReportsConfig;

class ReportsCommunicationMapper
{
    /**
     * @var string
     */
    protected const DELIMITER = '##';

    /**
     * @var int
     */
    protected const LAYOUT_ID_DEFAULT = 1;

    /**
     * @var string
     */
    protected const QUERY_PARAM_HASH = 'hash';

    /**
     * @param ReportsConfig $config
     * @param SessionClientInterface $sessionClient
     */
    public function __construct(
        protected ReportsConfig $config,
        protected SessionClientInterface $sessionClient,
    ) {}

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\BladeFxParameterTransfer
     */
    public function mapDownloadParametersToNewParameterTransfer(Request $request): BladeFxParameterTransfer
    {
        return (new BladeFxParameterTransfer())
            ->setParamName($request->query->get(ReportsConstants::PARAMETER_NAME))
            ->setParamValue($request->query->get(ReportsConstants::PARAMETER_VALUE))
            ->setReportId((int)$request->query->get(ReportsConstants::REPORT_ID))
            ->setSqlDbType('');
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\BladeFxParameterTransfer
     */
    public function mapPreviewParametersToNewParameterTransfer(Request $request): BladeFxParameterTransfer
    {
        $reportId = (int)$request->query->get(ReportsConstants::REPORT_ID);
        $parameterName = $request->query->get(ReportsConstants::PARAMETER_NAME);
        $parameterValue = $request->query->get(ReportsConstants::PARAMETER_VALUE);


        return (new BladeFxParameterTransfer())
            ->setParamName($parameterName)
            ->setParamValue($this->buildParameters($reportId, $parameterValue))
            ->setReportId($reportId)
            ->setSqlDbType('');
    }

    /**
     * @param BladeFxGetReportPreviewResponseTransfer $responseTransfer
     *
     * @return string
     */
    public function assembleUrl(BladeFxGetReportPreviewResponseTransfer $responseTransfer): string
    {
        return $this->config->getParamFormRootUrl()
            . $this->config->getReportPreviewUrlPath()
            . '?' . static::QUERY_PARAM_HASH . '='
            . $responseTransfer->getUrl();
    }

    /**
     * @param int $reportId
     * @param string|null $parameter
     *
     * @return string
     */
    protected function buildParameters(int $reportId, ?string $parameter): string
    {
        return $reportId
            . static::DELIMITER
            . $this->sessionClient->get($this->config->getBfxUserIdSessionKey())
            . static::DELIMITER
            . static::LAYOUT_ID_DEFAULT
            . static::DELIMITER
            . $parameter
            . static::DELIMITER
            . date('j.n.Y. H:i:s')
            . static::DELIMITER
            . $this->sessionClient->get($this->config->getBfxTokenSessionKey());
    }
}
