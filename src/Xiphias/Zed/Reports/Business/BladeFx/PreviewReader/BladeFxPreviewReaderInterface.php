<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\PreviewReader;

use Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer;

interface BladeFxPreviewReaderInterface
{
    /**
     * @param \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer $parameterTransfer
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportsPreview(BladeFxParameterListTransfer $parameterTransfer): BladeFxGetReportPreviewResponseTransfer;
}
