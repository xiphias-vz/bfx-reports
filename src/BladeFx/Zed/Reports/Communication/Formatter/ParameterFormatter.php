<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Zed\Reports\Communication\Formatter;

use Generated\Shared\Transfer\BladeFxParameterTransfer;

class ParameterFormatter
{
    /**
     * @param array $params
     *
     * @return array<array>
     */
    public function formatParameters(array $params): array
    {
        $params = ((new BladeFxParameterTransfer())->fromArray($params, true))->toArray(true, true);
        $longest = 0;

        foreach ($params as $key => $value) {
            $params[$key] = explode(',', $value);
            if (count($params[$key]) > $longest) {
                $longest = count($params[$key]);
            }
        }

        $formattedParams = [
            'params' => [
                [],
            ],
        ];

        for ($i = 0; $i <= $longest; $i++) {
            $formattedParams['params'][$i] = [];
        }

        foreach ($params as $key => $value) {
            for ($valuePosition = 0; $valuePosition < $longest; $valuePosition++) {
                if ($value[0] === null || count($value) < $valuePosition) {
                    continue;
                }
                $formattedParams['params'][$valuePosition][$key] = $value[$valuePosition];
            }
        }

        return $formattedParams;
    }
}
