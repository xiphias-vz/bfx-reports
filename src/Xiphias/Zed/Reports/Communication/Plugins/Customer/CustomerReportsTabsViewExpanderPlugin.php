<?php

declare(strict_types=1);

namespace Xiphias\Zed\Reports\Communication\Plugins\Customer;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Symfony\Component\HttpFoundation\Request;
use Xiphias\Shared\Reports\ReportsConstants;
use Xiphias\Zed\Reports\Communication\Plugins\ReportsViewExpanderPluginInterface;


/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 */
class CustomerReportsTabsViewExpanderPlugin extends AbstractPlugin implements ReportsViewExpanderPluginInterface
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param array $viewData
     *
     * @return array<string, string>
     */
    public function expand(Request $request, array $viewData): array
    {
        return $this
            ->getFactory()
            ->createReportsSalesOverviewExpander()
            ->expandReportTabsViewData(ReportsConstants::BLADE_FX_CUSTOMER_PARAM_NAME, $viewData);
    }
}
