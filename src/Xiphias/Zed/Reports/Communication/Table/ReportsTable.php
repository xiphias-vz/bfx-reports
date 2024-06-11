<?php

/**
 * This file is part of the Spryker Commerce OS.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Table;

use Generated\Shared\Transfer\BladeFxReportTransfer;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Xiphias\Zed\Reports\Business\ReportsFacadeInterface;
use Xiphias\Zed\Reports\ReportsConfig;

class ReportsTable extends AbstractTable
{
    /**
     * @var string
     */
    protected const ACTIVE_MODIFIER = 'active';

    /**
     * @var string
     */
    protected const MODIFIER_PREFIX = '--';

    /**
     * @var string
     */
    protected const FAVORITE_URL = '/reports/index/favorite-report';

    /**
     * @var string
     */
    protected const ELEMENT_PROPERTY_CHECKED = 'checked';

    /**
     * @var string
     */
    protected const URL_PARAM_REPORT_ID = 'rep_id';

    /**
     * @var string
     */
    protected const URL_PARAM_IS_FAVORITE = 'is_favorite';

    /**
     * @var string
     */
    protected const EDIT_BUTTON_NAME = 'Preview';

    /**
     * @var string
     */
    protected const EDIT_URL_FORMAT = '/reports/index/report-iframe?repId=%s';

    /**
     * @var string
     */
    protected const KEY_COLUMN = 'column';

    /**
     * @var string
     */
    protected const KEY_DIRECTION = 'dir';

    /**
     * @var string
     */
    protected const HEADER_ACTION = 'action';

    /**
     * @var string
     */
    protected const SORT_DESCENDING = 'desc';

    /**
     * @var \Xiphias\Zed\Reports\Business\ReportsFacadeInterface
     */
    protected ReportsFacadeInterface $reportsFacade;

    /**
     * @var \Xiphias\Zed\Reports\ReportsConfig
     */
    protected ReportsConfig $reportsConfig;

    /**
     * @param \Xiphias\Zed\Reports\Business\ReportsFacadeInterface $reportsFacade
     * @param \Xiphias\Zed\Reports\ReportsConfig $reportsConfig
     */
    public function __construct(ReportsFacadeInterface $reportsFacade, ReportsConfig $reportsConfig)
    {
        $this->reportsFacade = $reportsFacade;
        $this->reportsConfig = $reportsConfig;
    }

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

        $url = Url::generate('reports-table', $queryParams)->build();
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
     * @return array<string>
     */
    public function getCsvHeaders(): array
    {
        return $this->reportsConfig->getReportsTableColumnMap();
    }

    /**
     * @param array $item
     *
     * @return array
     */
    protected function createActionUrls(array $item): array
    {
        $urls = [];

        $urls[] = $this->generateViewButton(
            (string)Url::generate('/reports/detail', [
                'rep_id' => $item[''],
            ]),
            'View',
        );

        return $urls;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return void
     */
    public function mapRawColumns(TableConfiguration $config): void
    {
        $rawColumns = $this->reportsConfig->getReportsTableRawColumns();

        foreach ($rawColumns as $column) {
            $config->addRawColumn($column);
        }
    }

    /**
     * @return array
     */
    protected function generateQueryParams(): array
    {
        $queryParams = [];

        $urlParams = $this->request->query->all();

        foreach ($urlParams as $key => $value) {
            $queryParams[$key] = $value;
        }

        return $queryParams;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config): array
    {
        $reportList = $this->reportsFacade
            ->processGetReportsRequest($this->request);

        $results = [];
        $searchTerm = $this->getSearchTerm()['value'];

        /**
         * @var \Generated\Shared\Transfer\BladeFxReportTransfer $reportListItem
         */
        foreach ($reportList as $reportListItem) {
            if ($searchTerm) {
                if (!$this->isSearchTermFound($reportListItem->getRepName(), $searchTerm)) {
                    continue;
                }
            }

            $results[] = [
                BladeFxReportTransfer::IS_FAVORITE => $reportListItem->getIsFavorite(),
                BladeFxReportTransfer::REP_ID => $reportListItem->getRepId(),
                BladeFxReportTransfer::REP_NAME => $reportListItem->getRepName(),
                BladeFxReportTransfer::REP_DESC => $reportListItem->getRepDesc(),
                BladeFxReportTransfer::CAT_NAME => $reportListItem->getCatName(),
                static::HEADER_ACTION => $this->generateEditButton(
                    $this->buildEditUrl($reportListItem->getRepId()),
                    static::EDIT_BUTTON_NAME,
                ),
            ];
        }

        $this->filtered = count($results);
        $this->total = count($reportList);

        $sortingParameters = $this->createSortingParameters($this->getOrderParameter())[0];
        if ($sortingParameters) {
            $results = $this->sortResults($results, $sortingParameters[static::KEY_COLUMN], $sortingParameters[static::KEY_DIRECTION]);
        }

        foreach ($results as &$result) {
            $result[BladeFxReportTransfer::IS_FAVORITE] = $this->formatIsFavoriteField(
                $result[BladeFxReportTransfer::REP_ID],
                $result[BladeFxReportTransfer::IS_FAVORITE],
            );
        }

        return $this->paginateResults($results);
    }

    /**
     * @param array $results
     * @param string $columnIndex
     * @param string $sortDirection
     *
     * @return array
     */
    protected function sortResults(array $results, string $columnIndex, string $sortDirection): array
    {
        $columns = $this->getCsvHeaders();
        usort($results, function ($a, $b) use ($sortDirection, $columns, $columnIndex) {
            if ($sortDirection === static::SORT_DESCENDING) {

                return $b[array_keys($columns)[$columnIndex]] <=> $a[array_keys($columns)[$columnIndex]];
            }

            return $a[array_keys($columns)[$columnIndex]] <=> $b[array_keys($columns)[$columnIndex]];
        });

        return $results;
    }

    /**
     * @param array $results
     *
     * @return array
     */
    protected function paginateResults(array $results): array
    {
        return array_slice($results, $this->getOffset(), $this->getLimit());
    }

    /**
     * @param int $repId
     * @param bool|null $isFavorite
     * @param string $tab
     *
     * @return string
     */
    protected function formatIsFavoriteField(int $repId, ?bool $isFavorite = null, string $tab = ''): string
    {
        $categoryKey = $this->reportsConfig->getCategoryQueryKey();
        $categoryId = $this->request->query->getInt(
            $categoryKey,
            $this->reportsConfig->getDefaultCategoryIndex(),
        );

        $activeClass = $isFavorite ? $this->generateActiveModifier() : '';

        $url = Url::generate(static::FAVORITE_URL, [
            static::URL_PARAM_REPORT_ID => $repId,
            static::URL_PARAM_IS_FAVORITE => $isFavorite ?? false,
            $categoryKey => $categoryId,
        ]);

        return sprintf('<a href="%s"><i class="fa fa-star toggle-icon%s"></i></a>', $url . $tab, $activeClass);
    }

    /**
     * @return string
     */
    protected function generateActiveModifier(): string
    {
        return sprintf('%s%s', static::MODIFIER_PREFIX, static::ACTIVE_MODIFIER);
    }

    /**
     * @param int $repId
     *
     * @return string
     */
    protected function buildEditUrl(int $repId): string
    {
        return sprintf(static::EDIT_URL_FORMAT, $repId);
    }

    /**
     * @param string $haystack
     * @param string $needle
     *
     * @return bool
     */
    protected function isSearchTermFound(string $haystack, string $needle): bool
    {
        if (str_contains(strtolower($haystack), strtolower($needle))) {
            return true;
        }

        return false;
    }
}
