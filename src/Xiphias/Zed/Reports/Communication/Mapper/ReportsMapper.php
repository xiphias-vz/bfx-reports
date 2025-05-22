<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Mapper;

use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Generated\Shared\Transfer\BladeFxParameterListTransfer;
use Generated\Shared\Transfer\BladeFxReportTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Spryker\Client\Session\SessionClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Xiphias\Shared\Reports\ReportsConstants;
use Xiphias\Zed\Reports\ReportsConfig;

class ReportsMapper implements ReportsMapperInterface
{
    /**
     * @var string
     */
    protected const DELIMITER = '##';

    /**
     * @var string
     */
    protected const PARAMETER_SEPARATOR = ',';

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
     * @return BladeFxParameterListTransfer
     */
    public function mapDownloadParametersToNewParameterListTransfer(Request $request): BladeFxParameterListTransfer
    {
        $reportId = (int)$request->get(BladeFxReportTransfer::REP_ID);
        $paramId = $request->query->get(ReportsConstants::PARAMETER_VALUE);
        $contextValue = $request->query->get(ReportsConstants::PARAMETER_NAME);
        $parameterTransfers = new BladeFxParameterListTransfer();

        $parameterTransfers->addBladeFxParameter((new BladeFxParameterTransfer())
            ->setParamName(ReportsConstants::CONTEXT_BLADE_FX_PARAMETER_NAME)
            ->setParamValue($contextValue)
            ->setReportId($reportId)
            ->setSqlDbType(''));

        $parameterTransfers->addBladeFxParameter((new BladeFxParameterTransfer())
            ->setParamName(ReportsConstants::ID_BLADE_FX_PARAMETER_NAME)
            ->setParamValue($paramId)
            ->setReportId($reportId)
            ->setSqlDbType(''));

        return $parameterTransfers;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\BladeFxParameterTransfer
     */
    public function mapPreviewParametersToNewParameterTransfer(Request $request): BladeFxParameterTransfer
    {
        $reportId = (int)$request->query->get(BladeFxReportTransfer::REP_ID);
        $parameterName = $request->query->get(ReportsConstants::PARAMETER_NAME);
        $parameterValue = $request->query->get(ReportsConstants::PARAMETER_VALUE);


        return (new BladeFxParameterTransfer())
            ->setParamName($parameterName)
            ->setParamValue($this->buildParameters($reportId, $parameterValue, $parameterName))
            ->setReportId($reportId)
            ->setSqlDbType('');
    }

    /**
     * @param BladeFxGetReportPreviewResponseTransfer $responseTransfer
     *
     * @return string
     */
    public function assemblePreviewUrl(BladeFxGetReportPreviewResponseTransfer $responseTransfer): string
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
    protected function buildParameters(int $reportId, ?string $parameterValue, ?string $parameterName): string
    {
        return $reportId
            . static::DELIMITER
            . $this->sessionClient->get($this->config->getBfxUserIdSessionKey())
            . static::DELIMITER
            . static::LAYOUT_ID_DEFAULT
            . static::DELIMITER
            . $parameterName
            . static::PARAMETER_SEPARATOR
            . $parameterValue
            . static::DELIMITER
            . date('j.n.Y. H:i:s')
            . static::DELIMITER
            . $this->sessionClient->get($this->config->getBfxTokenSessionKey());
    }
}
