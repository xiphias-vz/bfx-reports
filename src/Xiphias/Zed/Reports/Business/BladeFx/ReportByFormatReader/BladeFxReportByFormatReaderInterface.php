<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportByFormatReader;

use Xiphias\BladeFxApi\DTO\BladeFxGetReportByFormatResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer;

interface BladeFxReportByFormatReaderInterface
{
    /**
     * @param int $reportId
     * @param string $format
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer|null $paramListTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportByFormatResponseTransfer
     */
    public function getReportByFormat(
        int $reportId,
        string $format,
        ?BladeFxParameterListTransfer $paramListTransfer
    ): BladeFxGetReportByFormatResponseTransfer;
}
