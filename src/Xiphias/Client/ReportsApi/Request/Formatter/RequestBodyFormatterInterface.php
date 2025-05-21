<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Client\ReportsApi\Request\Formatter;

use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;


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
