<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\ViewExpander;

use Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatterInterface;
use Xiphias\Zed\Reports\Communication\Table\SalesReportsTable;
use Xiphias\Zed\Reports\Communication\Tabs\OrderOverviewTabs;

interface ViewExpanderTableFactoryInterface
{
    /**
     * @param array $params
     *
     * @return \Xiphias\Zed\Reports\Communication\Table\SalesReportsTable
     */
    public function createSalesReportsTable(array $params = []): SalesReportsTable;

    /**
     * @return \Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatterInterface
     */
    public function createParameterFormatter(): ParameterFormatterInterface;

    /**
     * @param string $resource
     *
     * @return OrderOverviewTabs
     */
    public function createOverviewTabs(string $resource): OrderOverviewTabs;
}
