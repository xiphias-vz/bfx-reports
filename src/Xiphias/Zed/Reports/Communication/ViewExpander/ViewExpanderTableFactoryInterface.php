<?php

namespace Xiphias\Zed\Reports\Communication\ViewExpander;

use Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatterInterface;
use Xiphias\Zed\Reports\Communication\Table\SalesReportsTable;

interface ViewExpanderTableFactoryInterface
{
    /**
     * @param array $params
     *
     * @return SalesReportsTable
     */
    public function createSalesReportsTable(array $params = []): SalesReportsTable;

    /**
     * @return \Xiphias\Zed\Reports\Communication\Formatter\ParameterFormatterInterface
     */
    public function createParameterFormatter(): ParameterFormatterInterface;
}
