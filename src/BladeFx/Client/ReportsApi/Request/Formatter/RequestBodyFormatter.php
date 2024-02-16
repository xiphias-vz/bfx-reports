<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace BladeFx\Client\ReportsApi\Request\Formatter;

use Generated\Shared\Transfer\BladeFxParameterTransfer;

class RequestBodyFormatter implements RequestBodyFormatterInterface
{
    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return array
     */
    public function formatDataBeforeEncoding(array $data, ?BladeFxParameterTransfer $parameterTransfer): array
    {
        $data = $this->changeArrayFromCamelCaseToSnakeCase($data);
        if ($this->parameterTransferIsValid($parameterTransfer)) {
            return $this->mergeParametersWithData($data, $parameterTransfer);
        }

        return $data;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return bool
     */
    protected function parameterTransferIsValid(?BladeFxParameterTransfer $parameterTransfer): bool
    {
        if ($parameterTransfer) {
            if ($parameterTransfer->getParamName() && $parameterTransfer->getParamValue()) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $data
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return array
     */
    protected function mergeParametersWithData(array $data, ?BladeFxParameterTransfer $parameterTransfer): array
    {
        $params = $parameterTransfer->toArray(true, true);
        $data['params'] = [$this->changeArrayFromCamelCaseToSnakeCase($params)];
        $data['imageFormat'] = '';

        return $data;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function changeArrayFromCamelCaseToSnakeCase(array $data): array
    {
        $changedData = [];
        $keysToChangeFromCamelCase = [
            'repId' => 1, 'layoutId' => 1, 'paramId' => 1, 'hostAddress' => 1, 'userId' => 1, 'connId' => 1, //u getUserEntity UserId treba biti u camel caseu ali otom potom
        ];

        foreach ($data as $camelKey => $value) {
            if (array_key_exists($camelKey, $keysToChangeFromCamelCase)) {
                $changedData[$this->changeKeyFromCamelCaseToSnakeCase($camelKey)] = $value;
            } else {
                $changedData[$camelKey] = $value;
            }
        }

        return $changedData;
    }

    /**
     * @param string $camelKey
     *
     * @return string
     */
    private function changeKeyFromCamelCaseToSnakeCase(string $camelKey): string
    {
        $result = '';

        for ($i = 0; $i < strlen($camelKey); $i++) {
            $char = $camelKey[$i];

            if (ctype_upper($char)) {
                $result .= '_' . strtolower($char);
            } else {
                $result .= $char;
            }
        }

        return ltrim($result, '_');
    }
}
