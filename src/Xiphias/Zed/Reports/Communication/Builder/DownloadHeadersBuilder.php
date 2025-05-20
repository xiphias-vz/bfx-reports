<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Xiphias\Zed\Reports\Communication\Builder;

class DownloadHeadersBuilder implements DownloadHeadersBuilderInterface
{
    /**
     * @param string $fileFormat
     *
     * @return array<string, string>
     */
    public function buildDownloadHeaders(string $fileFormat, int $reportId, string $reportName): array
    {
        return [
            'Content-Type' => $this->getApplicationType($fileFormat),
            'Content-Disposition' => 'attachment; filename=' . $this->buildFilename($reportId, $reportName) . $fileFormat,
            'Pragma' => 'Public',
        ];
    }

    /**
     * @param int $reportId
     * @param string $reportName
     *
     * @return string
     */
    protected function buildFilename(int $reportId, string $reportName): string
    {
        return 'ID ' . $reportId . '-' . $reportName . ' (Date ' . date('d-m-y') . ').';
    }

    /**
     * @param string $fileFormat
     *
     * @return string
     */
    protected function getApplicationType(string $fileFormat): string
    {
        return match ($fileFormat) {
            'pdf' => 'application/pdf',
            'csv' => 'application/csv',
            'pptx' => 'application/pptx',
            'docx' => 'application/docs',
            'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'mht' => 'application/mht',
            'rtf' => 'application/rtf',
            'jpg' => 'application/jpg',
            default => 'error',
        };
    }
}
