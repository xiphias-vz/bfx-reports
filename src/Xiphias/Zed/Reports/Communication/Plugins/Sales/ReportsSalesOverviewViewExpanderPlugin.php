<?php

namespace Xiphias\Zed\Reports\Communication\Plugins\Sales;

use Symfony\Component\HttpFoundation\Request;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 */
class ReportsSalesOverviewViewExpanderPlugin extends AbstractPlugin implements ReportsSalesOverviewViewExpanderPluginInterface
{
    public function expand(Request $request): array
    {
        return $this->getFactory()->createReportsSalesOverviewExpander()->expandReportSalesViewData($request);
    }
}
