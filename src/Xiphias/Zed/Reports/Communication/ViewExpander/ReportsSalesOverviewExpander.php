<?php

namespace Xiphias\Zed\Reports\Communication\ViewExpander;

use Symfony\Component\HttpFoundation\Request;

class ReportsSalesOverviewExpander implements ReportsSalesOverviewExpanderInterface
{
    /**
     * @var string
     */
    protected const SALES_REPORTS_TABLE = 'reports_sales_table';

    /**
     * @var \Xiphias\Zed\Reports\Communication\ViewExpander\ViewExpanderTableFactoryInterface
     */
    protected $viewExpanderTableFactory;

    /**
     * @param \Xiphias\Zed\Reports\Communication\ViewExpander\ViewExpanderTableFactoryInterface $viewExpanderTableFactory
     */
    public function __construct(
        ViewExpanderTableFactoryInterface $viewExpanderTableFactory
    ) {
        $this->viewExpanderTableFactory = $viewExpanderTableFactory;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function expandReportSalesViewData(Request $request): array
    {
        $viewData = [];

        $reportsSalesTables = $this->viewExpanderTableFactory->createSalesReportsTable($this->viewExpanderTableFactory->createParameterFormatter()->formatRequestParameters($request));
        $viewData[static::SALES_REPORTS_TABLE] = $reportsSalesTables->render();

        return $viewData;
    }
}
