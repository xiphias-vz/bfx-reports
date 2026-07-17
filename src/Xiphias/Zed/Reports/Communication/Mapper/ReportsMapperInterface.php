<?php

namespace Xiphias\Zed\Reports\Communication\Mapper;

use Symfony\Component\HttpFoundation\Request;
use Xiphias\BladeFxApi\DTO\BladeFxParameterListTransfer;

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
    public function mapPreviewParametersToNewParameterListTransfer(Request $request): BladeFxParameterListTransfer;
}
