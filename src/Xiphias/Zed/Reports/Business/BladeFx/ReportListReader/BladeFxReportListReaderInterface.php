<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\ReportListReader;

use Xiphias\BladeFxApi\DTO\BladeFxGetReportsListResponseTransfer;

interface BladeFxReportListReaderInterface
{
    /**
     * @param string|null $attribute
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportsListResponseTransfer
     */
    public function getReportList(?string $attribute): BladeFxGetReportsListResponseTransfer;
}
