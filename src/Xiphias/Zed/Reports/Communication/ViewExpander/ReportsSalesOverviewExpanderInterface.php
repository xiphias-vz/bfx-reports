<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\ViewExpander;

use Symfony\Component\HttpFoundation\Request;

interface ReportsSalesOverviewExpanderInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param array $viewData
     *
     * @return array<string, string>
     */
    public function expandReportSalesTableViewData(Request $request, array $viewData): array;

    /**
     * @param string $resource
     * @param array $viewData
     *
     * @return array<string, string>
     */
    public function expandReportTabsViewData(string $resource, array $viewData): array;
}
