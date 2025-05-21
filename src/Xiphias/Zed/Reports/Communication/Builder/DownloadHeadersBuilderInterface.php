<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Communication\Builder;

interface DownloadHeadersBuilderInterface
{
    /**
     * @param string $fileFormat
     * @param int $reportId
     * @param string $reportName
     *
     * @return array<string, string>
     */
    public function buildDownloadHeaders(string $fileFormat, int $reportId, string $reportName): array;
}
