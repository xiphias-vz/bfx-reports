<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace BladeFx\Zed\Reports\Communication\Builder;

class DownloadHeadersBuilder implements DownloadHeadersBuilderInterface
{
    /**
     * @param string $fileFormat
     *
     * @return array
     */
    public function buildDownloadHeaders(string $fileFormat): array
    {
        return [
            'Content-Type' => $this->getApplicationType($fileFormat),
            'Content-Disposition' => 'attachment; filename=' . 'filename.' . $fileFormat,
            'Pragma' => 'Public',
        ];
    }

    /**
     * @param string $fileFormat
     *
     * @return string|null
     */
    protected function getApplicationType(string $fileFormat): string|null
    {
        switch ($fileFormat) {
            case 'pdf':
                return 'application/pdf';
            case 'csv':
                return 'application/csv';
            case 'pptx':
                return 'application/pptx';
            case 'docx':
                return 'application/docs';
            case 'xlsx':
                return 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            case 'mht':
                return 'application/mht';//provjeriti
            case 'rtf':
                return 'application/rtf';
            case 'jpg':
                return 'application/jpg';//točan format?
        }
    }
}
