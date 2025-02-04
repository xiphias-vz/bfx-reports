<?php

namespace Xiphias\Zed\Reports\Communication\Plugins\Sales;

use Symfony\Component\HttpFoundation\Request;

interface ReportsSalesOverviewViewExpanderPluginInterface
{
    public function expand(Request $request): array;
}
