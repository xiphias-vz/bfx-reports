<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\PreviewReader;

use Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer;

interface BladeFxPreviewReaderInterface
{
    /**
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportsPreview(BladeFxParameterTransfer $parameterTransfer): BladeFxGetReportPreviewResponseTransfer;
}
