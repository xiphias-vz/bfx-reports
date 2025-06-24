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
     * @param array $viewData
     *
     * @return array<string, string>
     */
    public function expandReportSalesTableViewData(Request $request, array $viewData): array
    {
        $reportsSalesTables = $this->viewExpanderTableFactory->createSalesReportsTable($this->viewExpanderTableFactory->createParameterFormatter()->formatRequestParameters($request));
        $viewData['bfxReportsTable'] = $reportsSalesTables->render();

        return $viewData;
    }

    /**
     * @param string $resource
     * @param array $viewData
     *
     * @return array<string, string>
     */
    public function expandReportTabsViewData(string $resource, array $viewData): array
    {
        $viewData['bfxOverviewTabs'] = $this->viewExpanderTableFactory->createOverviewTabs($resource)->createView();

        return $viewData;
    }
}
