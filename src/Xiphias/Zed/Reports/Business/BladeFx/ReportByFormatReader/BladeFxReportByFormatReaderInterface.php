<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportByFormatReader;

use Generated\Shared\Transfer\BladeFxGetReportByFormatResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer;

interface BladeFxReportByFormatReaderInterface
{
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
        ?BladeFxParameterListTransfer $paramListTransfer
    ): BladeFxGetReportByFormatResponseTransfer;
}
