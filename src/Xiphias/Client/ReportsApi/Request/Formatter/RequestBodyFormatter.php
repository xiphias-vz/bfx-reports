<?php


declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Request\Formatter;

use Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer;
use Generated\Shared\Transfer\BladeFxParameterTransfer;
use Xiphias\Client\ReportsApi\ReportsApiConfig;

class RequestBodyFormatter implements RequestBodyFormatterInterface
{
    /**
     * @var \Xiphias\Client\ReportsApi\ReportsApiConfig
     */
    private ReportsApiConfig $config;

    /**
     * @param \Xiphias\Client\ReportsApi\ReportsApiConfig $config
     */
    public function __construct(ReportsApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxGetReportPreviewRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function formatDataBeforeEncoding(BladeFxGetReportPreviewRequestTransfer $requestTransfer): array
    {
        $data = $requestTransfer->toArray(true, true);

        $data = $this->changeArrayFromCamelCaseToSnakeCase($data);
        if ($this->parameterTransferIsValid($requestTransfer->getParams())) {
            return $this->mergeParametersWithData($data, $requestTransfer->getParams());
        }

        return $data;
    }

    /**
     * @param \Generated\Shared\Transfer\BladeFxParameterTransfer|null $parameterTransfer
     *
     * @return bool
     */
    public function parameterTransferIsValid(?BladeFxParameterTransfer $parameterTransfer): bool
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
    public function mergeParametersWithData(array $data, ?BladeFxParameterTransfer $parameterTransfer): array
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
    public function changeArrayFromCamelCaseToSnakeCase(array $data): array
    {
        $changedData = [];
        $keysToChangeFromCamelCase = $this->config->getKeysToChangeFromCamelCaseToSnakeCase();

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
        $camelKeyLen = strlen($camelKey);

        for ($i = 0; $i < $camelKeyLen; $i++) {
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
