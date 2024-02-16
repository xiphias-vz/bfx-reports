<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Client\ReportsApi\Request\Formatter;

use Generated\Shared\Transfer\BladeFxParameterTransfer;

interface RequestBodyFormatterInterface
{
    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return array
     */
    public function formatDataBeforeEncoding(array $data, ?BladeFxParameterTransfer $parameterTransfer): array;
}
