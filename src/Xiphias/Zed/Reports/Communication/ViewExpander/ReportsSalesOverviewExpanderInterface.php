<?php

namespace Xiphias\Zed\Reports\Communication\ViewExpander;

use Symfony\Component\HttpFoundation\Request;

interface ReportsSalesOverviewExpanderInterface
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function expandReportSalesViewData(Request $request): array;
}
