<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Business\BladeFx\PreviewReader;

use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;

interface BladeFxPreviewReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer $parameterTransfer
     *
     * @return \Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer
     */
    public function getReportsPreview(BladeFxParameterTransfer $parameterTransfer): BladeFxGetReportPreviewResponseTransfer;
}
