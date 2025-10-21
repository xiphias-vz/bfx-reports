<?php


declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Table;

use Generated\Shared\Transfer\BladeFxReportTransfer;
use InvalidArgumentException;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;
use Xiphias\Shared\Reports\ReportsConstants;
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
    protected const PREVIEW_BUTTON_NAME = 'Preview';

    /**
     * @var string
     */
    protected const PREVIEW_URL_FORMAT = '/reports/index/report-iframe?repId=%s';

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
    protected const HEADER_ACTIONS = 'actions';

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
     * @var array
     */
    protected array $params;

    /**
     * @param \Xiphias\Zed\Reports\Business\ReportsFacadeInterface $reportsFacade
     * @param \Xiphias\Zed\Reports\ReportsConfig $reportsConfig
     * @param array|null $params
     */
    public function __construct(ReportsFacadeInterface $reportsFacade, ReportsConfig $reportsConfig, ?array $params = [])
    {
        $this->reportsFacade = $reportsFacade;
        $this->reportsConfig = $reportsConfig;
        $this->params = $params;
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
            ->processGetReportsRequest($this->request, ReportsConstants::BLADE_FX_ALL_REPORTS);

        return $this->processData($reportList);
    }

    /**
     * @param array $reportList
     *
     * @return array
     */
    public function processData(array $reportList): array
    {
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
                static::HEADER_ACTIONS => $this->getActionButtons($reportListItem, $this->params),
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
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function sortResults(array $results, string $columnIndex, string $sortDirection): array
    {
        $columns = $this->getCsvHeaders();

        if (is_numeric($columnIndex)) {
            $columnIndex = (int)$columnIndex;
        }

        if (!isset(array_keys($columns)[$columnIndex])) {
            throw new InvalidArgumentException("Invalid column index: $columnIndex");
        }

        usort($results, function ($a, $b) use ($sortDirection, $columns, $columnIndex) {
            if (!array_key_exists(array_keys($columns)[$columnIndex], $a) || !array_key_exists(array_keys($columns)[$columnIndex], $b)) {
                return 0;
            }

            if ($sortDirection === static::SORT_DESCENDING) {
                /** @var array<array<int|string>> $b*/

                /** @var array<array<int|string>> $a*/
                return $b[array_keys($columns)[$columnIndex]] <=> $a[array_keys($columns)[$columnIndex]];
            }
            /** @var array<array<int|string>> $b*/

            /** @var array<array<int|string>> $a*/
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
     * @param \Generated\Shared\Transfer\BladeFxReportTransfer $reportListItem
     * @param array|null $params
     *
     * @return string
     */
    public function getActionButtons(BladeFxReportTransfer $reportListItem, ?array $params = []): string
    {
        return $this->generateEditButton(
            $this->buildEditUrl($reportListItem),
            static::PREVIEW_BUTTON_NAME,
        );
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
     * @param \Generated\Shared\Transfer\BladeFxReportTransfer $reportListItem
     *
     * @return string
     */
    protected function buildEditUrl(BladeFxReportTransfer $reportListItem): string
    {
        return sprintf(static::PREVIEW_URL_FORMAT, $reportListItem->getRepId());
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
