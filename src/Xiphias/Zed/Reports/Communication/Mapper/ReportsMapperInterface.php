<?php

namespace Xiphias\Zed\Reports\Communication\Mapper;

use Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer;
use Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer;
use Symfony\Component\HttpFoundation\Request;

interface ReportsMapperInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer
     */
    public function mapDownloadParametersToNewParameterListTransfer(Request $request): BladeFxParameterListTransfer;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Xiphias\BladeFxApi\DTO\BladeFxParameterTransfer
     */
    public function mapPreviewParametersToNewParameterTransfer(Request $request): BladeFxParameterTransfer;

    /**
     * @param \Xiphias\BladeFxApi\DTO\BladeFxGetReportPreviewResponseTransfer $responseTransfer
     *
     * @return string
     */
    public function assemblePreviewUrl(BladeFxGetReportPreviewResponseTransfer $responseTransfer): string;
}
