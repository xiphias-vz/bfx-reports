<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Mapper;

use Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterListTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxReportTransfer;
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
    protected const PARAMETER_SEPARATOR = '?#?';

    /**
     * @var int
     */
    protected const LAYOUT_ID_DEFAULT = 105;

    /**
     * @var string
     */
    protected const QUERY_PARAM_HASH = 'hash';

    /**
     * @param \Xiphias\Zed\Reports\ReportsConfig $config
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     */
    public function __construct(
        protected ReportsConfig $config,
        protected SessionClientInterface $sessionClient
    ) {
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\BladeFxParameterListTransfer
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
     * @return \Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer
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
     * @param \Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer $responseTransfer
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
     * @param string|null $parameterValue
     * @param string|null $parameterName
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
