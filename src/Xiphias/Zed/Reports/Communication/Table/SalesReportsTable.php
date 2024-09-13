<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Table;

use Generated\Shared\Transfer\BladeFxReportTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Xiphias\Shared\Reports\ReportsConstants;

class SalesReportsTable extends ReportsTable
{
    /**
     * @var string
     */
    protected const HEADER_ACTIONS = 'actions';

    /**
     * @var array
     */
    protected array $params;

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config): TableConfiguration
    {
        $config->setHeader($this->getCsvHeaders());
        $this->mapRawColumns($config);

        $queryParams = $this->generateQueryParams();

        $this->baseUrl = '/';
        $url = Url::generate('reports/index/sales-reports-table', $queryParams)->build();
        $config->setDefaultSortField(BladeFxReportTransfer::IS_FAVORITE, static::SORT_DESCENDING);
        $config->setUrl($url);
        $config->setSortable(
            [
                BladeFxReportTransfer::IS_FAVORITE,
                BladeFxReportTransfer::REP_NAME,
            ],
        );

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $reportList = $this
            ->reportsFacade
            ->getAllReports($this->params[ReportsConstants::ATTRIBUTE])
            ->getReportsList()
            ->getArrayCopy();

        return $this->processData($reportList);
    }

    /**
     * @return array<string>
     */
    public function getCsvHeaders(): array
    {
        return $this->reportsConfig->getSalesReportsTableColumnMap();
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return void
     */
    public function mapRawColumns(TableConfiguration $config): void
    {
        $rawColumns = $this->reportsConfig->getSalesReportsTableRawColumns();

        foreach ($rawColumns as $column) {
            $config->addRawColumn($column);
        }
    }

    /**
     * @param int $reportId
     * @param array|null $params
     *
     * @return string
     */
    public function getActionButtons(int $reportId, ?array $params = []): string
    {
        $buttons = [];
        $buttons[] = $this->createPreviewButton($reportId, $params);
        $buttons[] = $this->createDownloadPDFButton($reportId, $params);

        return implode(' ', $buttons);
    }

    /**
     * @param int $reportId
     * @param array|null $params
     *
     * @return string
     */
    protected function createPreviewButton(int $reportId, ?array $params): string
    {
        $previewUrl = Url::generate(
            '/reports/index/preview',
            [
                ReportsConstants::REPORT_ID => $reportId,
                ReportsConstants::PARAMETER_NAME => $params[ReportsConstants::PARAMETER_NAME],
                ReportsConstants::PARAMETER_VALUE => $params[ReportsConstants::PARAMETER_VALUE],
            ],
        );

        return $this->generatePreviewButton($previewUrl->build(), 'Preview');
    }

    /**
     * @param string $url
     * @param string $title
     * @param array $options
     *
     * @return string
     */
    protected function generatePreviewButton(string $url, string $title, array $options = []): string
    {
        $defaultOptions = [
            'class' => 'btn-preview',
        ];

        return $this->generateButton($url, $title, $defaultOptions, $options);
    }

    /**
     * @param int $reportId
     * @param array|null $params
     *
     * @return string
     */
    protected function createDownloadPDFButton(int $reportId, ?array $params): string
    {
        $downloadUrl = Url::generate(
            '/reports/index/download',
            [
                ReportsConstants::REPORT_ID => $reportId,
                'format' => 'pdf',
                ReportsConstants::PARAMETER_NAME => $params[ReportsConstants::PARAMETER_NAME],
                ReportsConstants::PARAMETER_VALUE => $params[ReportsConstants::PARAMETER_VALUE],
            ],
        );

        return $this->generateDownloadPDFButton($downloadUrl->build(), 'Download as PDF');
    }

    /**
     * @param string $url
     * @param string $title
     * @param array $options
     *
     * @return string
     */
    protected function generateDownloadPDFButton(string $url, string $title, array $options = []): string
    {
        $defaultOptions = [
            'class' => 'btn-download',
        ];

        return $this->generateButton($url, $title, $defaultOptions);
    }

    /**
     * @param int $repId
     * @param bool|null $isFavorite
     * @param string $tab
     *
     * @return string
     */
    protected function formatIsFavoriteField(int $repId, ?bool $isFavorite = null, string $tab = '#tab-content-report'): string
    {
        return parent::formatIsFavoriteField($repId, $isFavorite, $tab);
    }
}
