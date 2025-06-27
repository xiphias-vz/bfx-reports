<?php


namespace Xiphias\Client\ReportsApi\Request\Formatter;

use Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;

interface RequestBodyFormatterInterface
{
    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function formatDataBeforeEncoding(BladeFxGetReportPreviewRequestTransfer $requestTransfer): array;

    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return array
     */
    public function mergeParametersWithData(array $data, ?BladeFxParameterTransfer $parameterTransfer): array;

    /**
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return bool
     */
    public function parameterTransferIsValid(?BladeFxParameterTransfer $parameterTransfer): bool;

    /**
     * @param array $data
     *
     * @return array
     */
    public function changeArrayFromCamelCaseToSnakeCase(array $data): array;
}
