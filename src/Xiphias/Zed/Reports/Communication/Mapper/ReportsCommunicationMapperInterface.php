<?php

namespace Xiphias\Zed\Reports\Communication\Mapper;

use Generated\Shared\Transfer\BladeFxGetReportPreviewResponseTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Symfony\Component\HttpFoundation\Request;

interface ReportsCommunicationMapperInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\BladeFxParameterTransfer
     */
    public function mapDownloadParametersToNewParameterTransfer(Request $request): BladeFxParameterTransfer;
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
