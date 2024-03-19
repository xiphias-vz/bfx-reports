<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Zed\Reports\Communication\Formatter;

use BladeFx\Shared\Reports\ReportsConstants;
use Spryker\Zed\Sales\SalesConfig;
use Symfony\Component\HttpFoundation\Request;

class ParameterFormatter implements ParameterFormatterInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function formatRequestParameters(Request $request): array
    {
        return [
            ReportsConstants::ATTRIBUTE => ReportsConstants::BLADE_FX_ORDER_ATTRIBUTE,
            ReportsConstants::PARAMETER_NAME => ReportsConstants::BLADE_FX_ORDER_PARAM_NAME,
            ReportsConstants::PARAMETER_VALUE => (int)$request->query->getInt(SalesConfig::PARAM_ID_SALES_ORDER),
        ];
    }
}
