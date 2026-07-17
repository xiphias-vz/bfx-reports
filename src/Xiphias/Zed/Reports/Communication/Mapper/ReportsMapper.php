<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Mapper;

use Spryker\Client\Session\SessionClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxReportTransfer;
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
     * @return \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer
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
    public function mapPreviewParametersToNewParameterListTransfer(Request $request): BladeFxParameterListTransfer
    {
        $reportId = (int)$request->query->get(BladeFxReportTransfer::REP_ID);
        $contextValue = $request->query->get(ReportsConstants::PARAMETER_NAME);
        $idValue = $request->query->get(ReportsConstants::PARAMETER_VALUE);

        return (new BladeFxParameterListTransfer())
            ->setParameterList($this->buildParameters($contextValue, $idValue))
            ->setReportId($reportId)
            ->setSqlDbType('');
    }

    /**
     * @param string|null $contextValue
     * @param string|null $idValue
     *
     * @return array<\Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer>
     */
    protected function buildParameters(?string $contextValue, ?string $idValue): array
    {
        return [
            (new BladeFxParameterTransfer())
                ->setParamName(ReportsConstants::CONTEXT_BLADE_FX_PARAMETER_NAME)
                ->setSqlDbType('')
                ->setParamValue($contextValue),
            (new BladeFxParameterTransfer())
                ->setSqlDbType('')
                ->setParamName(ReportsConstants::ID_BLADE_FX_PARAMETER_NAME)
                ->setParamValue($idValue),
        ];
    }
}
