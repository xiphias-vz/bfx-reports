<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\ViewExpander;

use Symfony\Component\HttpFoundation\Request;

class ReportsSalesOverviewExpander implements ReportsSalesOverviewExpanderInterface
{

    /**
     * @param \Xiphias\Zed\Reports\Communication\ViewExpander\ViewExpanderTableFactoryInterface $viewExpanderTableFactory
     */
    public function __construct(protected ViewExpanderTableFactoryInterface $viewExpanderTableFactory)
    {
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function expandReportSalesTableViewData(Request $request): array
    {
        $viewData = [];

        $reportsSalesTables = $this->viewExpanderTableFactory->createSalesReportsTable($this->viewExpanderTableFactory->createParameterFormatter()->formatRequestParameters($request));
        $viewData['reportsTable'] = $reportsSalesTables->render();

        return $viewData;
    }

    /**
     * @param string $resource
     *
     * @return array<string, string>
     */
    public function expandReportTabsViewData(string $resource): array
    {
        $viewData = [];
        $viewData['overviewTabs'] = $this->viewExpanderTableFactory->createOverviewTabs($resource)->createView();

        return $viewData;
    }
}
