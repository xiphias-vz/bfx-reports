<?php


namespace Xiphias\Client\ReportsApi\Request\Formatter;

use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

interface RequestBodyFormatterInterface
{
    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $requestTransfer
     *
     * @return array
     */
    public function formatDataBeforeEncoding(AbstractTransfer $requestTransfer): array;

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
