<?php


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
