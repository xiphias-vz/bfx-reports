<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\ViewExpander;

use Symfony\Component\HttpFoundation\Request;

interface ReportsSalesOverviewExpanderInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<string, string>
     */
    public function expandReportSalesTableViewData(Request $request): array;

    /**
     * @param string $resource
     *
     * @return array<string, string>
     */
    public function expandReportTabsViewData(string $resource): array;
}
