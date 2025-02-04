<?php

namespace Xiphias\Zed\Reports\Communication\Plugins\Sales;

use Generated\Shared\Transfer\TabsViewTransfer;

interface ReportsSalesOverviewTabsExpanderPluginInterface
{
    public function expand(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer;
}
