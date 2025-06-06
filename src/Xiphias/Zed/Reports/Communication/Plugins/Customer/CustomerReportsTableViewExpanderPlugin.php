<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Plugins\Customer;

use Symfony\Component\HttpFoundation\Request;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Xiphias\Zed\Reports\Communication\Plugins\ReportsViewExpanderPluginInterface;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 */
class CustomerReportsTableViewExpanderPlugin extends AbstractPlugin implements ReportsViewExpanderPluginInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array<string, string>
     */
    public function expand(Request $request): array
    {
        return $this->getFactory()->createReportsSalesOverviewExpander()->expandReportSalesTableViewData($request);
    }
}
