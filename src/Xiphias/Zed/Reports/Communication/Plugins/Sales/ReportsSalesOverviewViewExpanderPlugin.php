<?php

namespace Xiphias\Zed\Reports\Communication\Plugins\Sales;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 */
class ReportsSalesOverviewViewExpanderPlugin extends AbstractPlugin implements ReportsSalesOverviewViewExpanderPluginInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function expand(Request $request): array
    {
        return $this->getFactory()->createReportsSalesOverviewExpander()->expandReportSalesViewData($request);
    }
}
