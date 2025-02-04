<?php

namespace Xiphias\Zed\Reports\Communication\Plugins\Sales;

use Generated\Shared\Transfer\TabsViewTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Xiphias\Zed\Reports\Communication\ReportsCommunicationFactory getFactory()
 */
class ReportsSalesOverviewTabsExpanderPlugin extends AbstractPlugin implements ReportsSalesOverviewTabsExpanderPluginInterface
{
    public function expand(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer
    {
        return $this->getFactory()->createTabCreator()->createReportListTabForOrderOverview($tabsViewTransfer);
    }
}
