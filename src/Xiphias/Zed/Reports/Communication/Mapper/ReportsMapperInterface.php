<?php

namespace Xiphias\Zed\Reports\Communication\Mapper;

use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Generated\Shared\Transfer\BladeFxParameterListTransfer;
use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Symfony\Component\HttpFoundation\Request;

interface ReportsMapperInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return BladeFxParameterListTransfer
     */
    public function mapDownloadParametersToNewParameterListTransfer(Request $request): BladeFxParameterListTransfer;
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\BladeFxParameterTransfer
     */
    public function mapPreviewParametersToNewParameterTransfer(Request $request): BladeFxParameterTransfer;

    /**
     * @param BladeFxGetReportPreviewResponseTransfer $responseTransfer
     *
     * @return string
     */
    public function assembleUrl(BladeFxGetReportPreviewResponseTransfer $responseTransfer): string;
}
