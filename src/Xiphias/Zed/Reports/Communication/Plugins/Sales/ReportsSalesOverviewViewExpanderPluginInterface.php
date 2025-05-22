<?php

namespace Xiphias\Zed\Reports\Communication\Plugins\Sales;

use Symfony\Component\HttpFoundation\Request;

interface ReportsSalesOverviewViewExpanderPluginInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function expand(Request $request): array;
}
