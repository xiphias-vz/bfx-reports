<?php


declare(strict_types=1);

namespace Xiphias\Client\ReportsApi\Plugins\Formatter;

interface AuthenticationRequestFormatterPluginInterface
{
    /**
     * @param array $requestData
     *
     * @return array
     */
    public function format(array $requestData): array;
}
